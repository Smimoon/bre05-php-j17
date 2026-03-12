<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class Comment{
    public function __construct(private string $content, private User $user_id, private Post $post_id, private ? int $id=NULL)
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
    
     public function getUserId():User
    {
        return $this->user_id;
    }
    public function setUserId(User $user_id):void
    {
        $this->title = $user_id;
    }
    
     public function getPostId():Post
    {
        return $this->post_id;
    }
    public function setPostId(Post $post_id):void
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