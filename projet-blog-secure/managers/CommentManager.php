<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class CommentManager extends AbstractManager{
    public function __construct()
    {
        Parent::__construct();
    }
    
    public function findByPost(int $postId):array
    {
        $query = $this->db->prepare(
            'SELECT comments.* FROM comments
            JOIN posts 
            ON comments.post_id = posts.id
            WHERE posts.id = :id'
        );
        
        $parameters = [
            'id' => $postId
        ];
        
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $comments = [];
        
        if($results !== false){
            foreach($results as $result){
                $postManager = new PostManager();
                $post = $postManager->findOne($result["post_id"]);
                
                $userManager = new UserManager();
                $user = $userManager->findOne($result["user_id"]);
                
                $comments[]= new Comment($result["content"], $user, $post, $result["id"]);
            }
            return $comments;
        }
        else {
            return NULL;
        }
    }
    
    public function create(Comment $comment):Comment
    {
        $query = $this->db->prepare(
            'INSERT INTO comments (content, user_id, post_id)
            VALUES (:content, :user_id, :post_id)'
        );
        $parameters = [
            'content' => $comment->getContent(),
            'user_id' => $comment->getUserId()->getId(),
            'post_id' => $comment->getPostId()->getId()
        ];
        
        $id = $this->db->lastInsertId();
        $comment->setId($id);
        $query->execute($parameters);
        
        return $comment;
        
    }
    
}