<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class PostManager extends AbstractManager{
    public function __construct()
    {
        Parent::__construct();
    }
    
    public function findLatest():array
    {
        $query = $this->db->prepare(
            'SELECT posts.* FROM posts
            ORDER BY created_at
            LIMIT 4'
        );
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $posts = [];
        if($results !== false){
            foreach($results as $result){
                $userManager = new UserManager();
                $user = $userManager->findOne($result["author"]);
                
                $categoryManager = new CategoryManager();
                $categories = $categoryManager->findByPost($result["id"]);
                $posts[] = new Post($result["title"], $result["excerpt"], $result["content"], $user, DateTime::createFromFormat('Y-m-d H:i:s', $result["created_at"]), $categories, $result["id"]);
            }
            return $posts;
        }
        else {
            return NULL;
        }
    }
    
    public function findOne(int $postId):Post
    {
        $query = $this->db->prepare(
            'SELECT posts.* FROM posts
            WHERE posts.id = :id'
        );
        $parameters = [
            'id' => $postId
        ];
        
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if($result !== false){
            $userManager = new UserManager();
            $user = $userManager->findOne($result["author"]);
            
            $categoryManager = new CategoryManager();
            $categories = $categoryManager->findByPost($result["id"]);
            
            $post = new Post($result["title"], $result["excerpt"], $result["content"], $user, DateTime::createFromFormat('Y-m-d H:i:s', $result["created_at"]), $categories, $result["id"]);
            return $post;
        }
        else {
            return NULL;
        }
    }
    
    public function findByCategory(int $categoryId):array
    {
        $query = $this->db->prepare(
            'SELECT posts.*
            FROM posts
            JOIN posts_categories
            ON posts.id = posts_categories.post_id
            WHERE posts_categories.category_id = :id'
        );
        $parameters = [
            'id' => $categoryId
        ];
        
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $posts = [];
        if($results !== false){
            foreach($results as $result){
                $userManager = new UserManager();
                $user = $userManager->findOne($result["author"]);
                
                $categoryManager = new CategoryManager();
                $categories = $categoryManager->findByPost($result["id"]);
                
                $posts[] = new Post($result["title"], $result["excerpt"], $result["content"], $user, DateTime::createFromFormat('Y-m-d H:i:s', $result["created_at"]), $categories, $result["id"]);
            }
            return $posts;
        }
        else {
            return NULL;
        }
        
    }
}