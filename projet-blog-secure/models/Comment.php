<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class Comment{
    public function __construct(private string $content, private string $user_id, private string $post_id, private ? int $id=NULL)
    {
        
    }
    
     public function getContent():string
    {
        return $this->content;
    }
    public function setContent(string $content):void
    {
        $this->title = $content;
    }
    
     public function getUserId():string
    {
        return $this->user_id;
    }
    public function setUserId(string $user_id):void
    {
        $this->title = $user_id;
    }
    
     public function getPostId():string
    {
        return $this->post_id;
    }
    public function setPostId(string $post_id):void
    {
        $this->title = $post_id;
    }
    
    public function getId():id
    {
        return $this->id;
    }
    public function setId(int $id):void
    {
        $this->id = $id;
    }
}