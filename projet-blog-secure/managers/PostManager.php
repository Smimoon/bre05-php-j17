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
            'SELECT posts.*, users.username FROM posts
            JOIN users
            ON posts.author = users.id
            ORDER BY created_at
            DESC LIMIT 4'
        );
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $posts = [];
        if($results !== false){
            foreach($results as $result){
                $posts[] = new Post($result["title"], $result["excerpt"], $result["content"], $result["username"], $result["created_at"], $result["id"]);
            }
            return $posts;
        }
        else {
            return NULL;
        }
    }
    
    public function findOne(int $id):Post
    {
        $query = $this->db->prepare(
            'SELECT posts.*, users.username FROM posts
            JOIN users
            ON posts.author = users.id
            WHERE posts.id = :id'
        );
        $parameters = [
            'id' => $id
        ];
        
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if($result !== false){
            $post = new Post($result["title"], $result["excerpt"], $result["content"], $result["username"], $result["created_at"], $result["id"]);
            return $post;
        }
        else {
            return NULL;
        }
    }
    
    public function findByCategory(int $categoryId):array
    {
        $query = $this->db->prepare(
            'SELECT posts.*, users.username
            FROM posts
            JOIN users
            ON posts.author = users.id
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
                $posts[] = new Post($result["title"], $result["excerpt"], $result["content"], $result["username"], $result["created_at"], $result["id"]);
            }
            return $posts;
        }
        else {
            return NULL;
        }
        
    }
}