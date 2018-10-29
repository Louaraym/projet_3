<?php
namespace loray\projet_3;

class Comment
{
  protected $errors = [],
            $id,
            $post_id,
            $moderation,
            $alert,
            $author,
            $comment,
            $title,
            $comment_date;
           

  const AUTHOR_INVALID = 1;
  const COMMENT_INVALID = 2;
  
  
  public function __construct($values = [])
  {
    if (!empty($values)) // Si on a spécifié des valeurs, alors on hydrate l'objet.
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

  public function setPost_id($post_id)
  {
    $this->post_id = (int) $post_id;
  }
  
  public function setModeration($moderation)
  {
    $this->moderation = (int) $moderation;
  }

  public function setAlert($alert)
  {
    $this->alert = $alert;
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
  
  public function setComment($comment)
  {
    if (!is_string($comment) || empty($comment))
    {
      $this->errors[] = self::COMMENT_INVALID;
    }
    else
    {
      $this->comment = $comment;
    }
  }
  
  public function setComment_date(\DateTime $comment_date)
  {
    $this->comment_date = $comment_date;
  }
  

  // GETTERS
  
   public function getTitle()
  {
    return $this->title;
  }
  
  public function getErrors()
  {
    return $this->errors;
  }
  
  public function getId()
  {
    return $this->id;
  }

   public function getPost_id()
  {
    return $this->post_id;
  }
  
   public function getModeration()
  {
    return $this->moderation;
  }

   public function getAlert()
  {
    return $this->alert;
  }

  public function getAuthor()
  {
    return $this->author;
  }
  
  public function getComment()
  {
    return $this->comment;
  }
  
  public function getComment_date()
  {
    return $this->comment_date;
  }
  
}