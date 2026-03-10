<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class Post{
    public function __construct(private string $title, private string $excerpt, private string $content, private string $author, private string $created_at = new DateTime(), private ? int $id=NULL)
    {
        
    }
    public function getTitle():string
    {
        return $this->title;
    }
    public function setTitle(string $title):void
    {
        $this->title = $title;
    }
    
    public function getExcerpt():string
    {
        return $this->excerpt;
    }
    public function setExcerpt(string $excerpt):void
    {
        $this->excerpt = $excerpt;
    }
    
    public function getContent():string
    {
        return $this->content;
    }
    public function setContent(string $content):void
    {
        $this->title = $content;
    }
    
    public function getAuthor():string
    {
        return $this->author;
    }
    public function setAuthor(string $author):void
    {
        $this->title = $author;
    }
    
    public function getCreatedAt():string
    {
        return $this->created_at;
    }
    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
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
