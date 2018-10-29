<?php
namespace loray\projet_3;

class Post
{
  protected $errors = [],
            $id,
            $author,
            $title,
            $content,
            $creation_date,
            $update_date;
  
  const AUTHOR_INVALID = 1;
  const TITLE_INVALID = 2;
  const CONTENT_INVALID = 3;
  
  
  public function __construct($values = [])
  {
    if (!empty($values))
    {
      $this->hydrate($values);
    }
  }
  
  public function hydrate($data)
  {
    foreach ($data as $attribut => $value)
    {
      $methode = 'set'.ucfirst($attribut);
      
      if (is_callable([$this, $methode]))
      {
        $this->$methode($value);
      }
    }
  }
  
  
  // SETTERS 
  
  public function setId($id)
  {
    $this->id = (int) $id;
  }
  
  public function setAuthor($author)
  {
    if (!is_string($author) || empty($author))
    {
      $this->errors[] = self::AUTHOR_INVALID;
    }
    else
    {
      $this->author = $author;
    }
  }
  
  public function setTitle($title)
  {
    if (!is_string($title) || empty($title))
    {
      $this->errors[] = self::TITLE_INVALID;
    }
    else
    {
      $this->title = $title;
    }
  }
  
  public function setContent($content)
  {
    if (!is_string($content) || empty($content))
    {
      $this->errors[] = self::CONTENT_INVALID;
    }
    else
    {
      $this->content = $content;
    }
  }
  
  public function setCreation_date(\DateTime $creation_date)
  {
    $this->creation_date = $creation_date;
  }
  
  public function setUpdate_date(\DateTime $update_date)
  {
    $this->update_date =  $update_date;
  }
  
  // GETTERS 
  
  public function getErrors()
  {
    return $this->errors;
  }
  
  public function getId()
  {
    return $this->id;
  }
  
  public function getAuthor()
  {
    return $this->author;
  }
  
  public function getTitle()
  {
    return $this->title;
  }
  
  public function getContent()
  {
    return $this->content;
  }
  
  public function getCreation_date()
  {
    return $this->creation_date;
  }
  
  public function getUpdate_date()
  {
    return $this->update_date;
  }
  
}