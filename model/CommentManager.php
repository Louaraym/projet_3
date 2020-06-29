<?php
namespace loray\projet_3;
require_once('DaoManager.php');

class CommentManager extends DaoManager
{

    public function getComments($postId)
    {
        $req = $this->dao->prepare('SELECT id, post_id, author, comment, comment_date FROM comments WHERE post_id = ? && moderation = 1 ORDER BY id DESC');
        $req->execute(array($postId));

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'loray\projet_3\Comment');
    
        $listComments = $req->fetchAll();
        
        foreach ($listComments as $comment)
        {
          $comment->setComment_date(new \DateTime($comment->getComment_date()));
        }

        return $listComments;
    }

    public function getAllComments()
    {
        $req = $this->dao->query('SELECT c.id, c.alert, c.author, c.comment, c.comment_date, p.title FROM posts p RIGHT JOIN comments c ON c.post_id = p.id WHERE  moderation = 1 ORDER BY id DESC');

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'loray\projet_3\Comment');
    
        $listComments = $req->fetchAll();
        
        foreach ($listComments as $comment)
        {
           $comment->setComment_date(new \DateTime($comment->getComment_date()));
        }

        return $listComments;
    }

     public function getCommentsToModerate()
    {
        $req = $this->dao->query('SELECT c.id, c.author, c.comment, c.comment_date, p.title FROM posts p RIGHT JOIN comments c ON c.post_id = p.id WHERE  moderation = 0 ORDER BY id DESC');

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'loray\projet_3\Comment');
    
        $listComments = $req->fetchAll();
        
        foreach ($listComments as $comment)
        {
           $comment->setComment_date(new \DateTime($comment->getComment_date()));
        }

        return $listComments;
    }

     public function deleteComments($commentId)
    {             
        $req = $this->dao->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($commentId));

        return $req;
    }

    public function postComment($postId, $author, $comment)
    {
        $comments = $this->dao->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

     public function moderate($commentId)
    {
      $req = $this->dao->prepare('UPDATE  comments SET moderation = 1 WHERE id = ?');
      $modif = $req->execute(array($commentId));

      return $modif;
    }

     public function alert($commentId)
    {
      $req = $this->dao->prepare('UPDATE  comments SET alert = \'OUI\' WHERE id = ?');
      $alerte= $req->execute(array($commentId));

      return $alerte;
    }


}