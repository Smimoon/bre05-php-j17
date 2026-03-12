<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class CategoryManager extends AbstractManager{
    public function __construct()
    {
        Parent::__construct();
    }
    
    public function findOne(int $id):Category
    {
        $query = $this->db->prepare('SELECT * FROM categories WHERE id = :id');
        $parameters = [
            'id'=>$id    
        ];
        
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if($result !== false){
            $category = new Category($result["title"], $result["description"], $result["id"]);
            return $category;
        }
        else {
            return NULL;
        }
    }
    
    public function findAll():array
    {
        $query = $this->db->prepare('SELECT * FROM categories');
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];
        if($results !== false ){
            foreach($results as $result){
                $categories[] = new Category($result["title"], $result["description"], $result["id"]);
            }
            return $categories;
        }
        
        else {
            return NULL;
        }
    }
    
    public function findByPost(int $postId):array
    {
        $query = $this->db->prepare(
        'SELECT categories.* FROM categories
        JOIN posts_categories
        ON categories.id = posts_categories.category_id
        WHERE posts_categories.post_id = :id'    
        );
        $parameters = [
            'id' => $postId
        ];
        
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];
        if($results !== false ){
            foreach($results as $result){
                $categories[] = new Category($result["title"], $result["description"], $result["id"]);
            }
            return $categories;
        }
        
         else {
            return NULL;
        }
    }
}