<?php
namespace loray\projet_3;
require_once('DaoManager.php');

class PostManager extends DaoManager 
{

     public function count()
    {
      $nbre_total_articles = $this->dao->query('SELECT COUNT(id) FROM posts')->fetchColumn();
      return  $nbre_total_articles;
    }

    public function getIdValid()
    {
        $data_id = [];
        $req = $this->dao->query('SELECT id FROM posts');

        while ($data_id = $req->fetch(\PDO::FETCH_ASSOC))
        {
          $idValid[] = $data_id['id'];
        }

        return $idValid;
    }
  
     public function getPost($postId)
    {
        $req = $this->dao->prepare('SELECT id, author, title, content, creation_date, update_date FROM posts WHERE id = ?');
        $req->execute(array($postId));

       $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,  '\loray\projet_3\Post');

        $post = $req->fetch();

        $post->setCreation_date(new \DateTime($post->getCreation_date()));
        $post->setUpdate_date(new \DateTime($post->getUpdate_date()));

        return $post;
    }


     public function getAllPosts()
    {
        $req = $this->dao->query('SELECT id, author, title, content, creation_date, update_date FROM posts ORDER BY id DESC ');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\loray\projet_3\Post');
    
        $listPosts = $req->fetchAll();
        
        foreach ($listPosts as $post)
        {
          $post->setCreation_date(new \DateTime($post->getCreation_date()));
          $post->setUpdate_date(new \DateTime($post->getUpdate_date()));
        }

        return $listPosts;
    }
 
    public function addPost($author, $title, $content)
    {
        $post = $this->dao->prepare('INSERT INTO posts(author, title, content, creation_date, update_date) 
                VALUES(?, ?, ?, NOW(), NOW())');
        $ajout = $post->execute(array($author, $title, $content));

        return $ajout;
    }

     public function deletePost($postId)
    {
        $req = $this->dao->prepare('DELETE p, c FROM posts p LEFT JOIN comments c  ON p.id = c.post_id WHERE p.id = ?');
        $req->execute(array($postId));

        return $req;
    }

     public function update($author, $title, $content, $postId)
    {
       $req = $this->dao->prepare('UPDATE  posts SET author = ?,title = ?, content = ?, update_date = NOW() WHERE id = ?');
       $modif = $req->execute(array($author, $title, $content, $postId));

      return $modif;
    }

     public function paginationInfo()
    {
        $nbre_total_articles = $this->dao->query('SELECT COUNT(id) FROM posts')->fetchColumn();
        $nbre_articles_par_page = 10;
        $nbre_pages_max_gauche_et_droite = 5;
        $nbre_de_page = ceil($nbre_total_articles/$nbre_articles_par_page);

        if (isset($_GET['Page']) && is_numeric($_GET['Page'])) 
        {
            $page_num = $_GET['Page'];
        }
        else
        {
            $page_num = 1;
        }

        if ($page_num<1) 
        {
            $page_num = 1;
        }
        else if($page_num > $nbre_de_page)
        {
            $page_num = $nbre_de_page;
        }
        
        return [
                "nbre_articles_par_page" => $nbre_articles_par_page,
                "nbre_pages_max_gauche_et_droite" => $nbre_pages_max_gauche_et_droite,
                "nbre_de_page" => $nbre_de_page,
                "page_num" => $page_num,
            ];
    }

    public function getPosts()
    {

      $pagination_info = $this->paginationInfo();
      $page_num = $pagination_info['page_num'];
      $nbre_articles_par_page = $pagination_info['nbre_articles_par_page'];

      $limit = ' LIMIT ' .($page_num-1)*$nbre_articles_par_page.' , ' .$nbre_articles_par_page;
      $sql = 'SELECT id, author, title, content, creation_date, update_date FROM posts ORDER BY id DESC'.$limit;
    
      $req = $this->dao->query($sql);
      $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\loray\projet_3\Post');
    
      $listPosts = $req->fetchAll();
        
      foreach ($listPosts as $post)
      {
        $post->setCreation_date(new \DateTime($post->getCreation_date()));
        $post->setUpdate_date(new \DateTime($post->getUpdate_date()));
      }

      return $listPosts;
          
    }


    public function maPagination()
    {
      $pagination_info = $this->paginationInfo();
      $page_num = $pagination_info['page_num'];
      $nbre_de_page = $pagination_info['nbre_de_page'];
      $nbre_pages_max_gauche_et_droite = $pagination_info['nbre_pages_max_gauche_et_droite'];

      $pagination = '';

      if ($nbre_de_page != 1) 
      {
        if ($page_num>1) 
        {
          $previous = $page_num - 1;
          $pagination .= '<a href="index.php?Page=' .$previous. '"> < Précédent </a> &nbsp; &nbsp;';
          for ($i= $page_num - $nbre_pages_max_gauche_et_droite; $i < $page_num; $i++) 
          { 
            if ($i>0)
            {
              $pagination .= '<a href="index.php?Page=' .$i. '">' .$i. '</a> &nbsp; &nbsp; ';
            }
          }
        }

        $pagination .= '<span class="page_num_active">' .$page_num. '</span> &nbsp; &nbsp;';
        for ($i= $page_num+1; $i <= $nbre_de_page ; $i++) 
        { 
          $pagination .= '<a href="index.php?Page=' .$i. '">' .$i. '</a>&nbsp; &nbsp; ';
          if ($i>=$page_num + $nbre_pages_max_gauche_et_droite) 
          {
            break;
          }
        }

        if ($page_num != $nbre_de_page) 
        {
          $next = $page_num +1;
          $pagination .= '<a href="index.php?Page=' .$next. '"> Suivant ></a> ';
        }

      }

      return $pagination;
          
    }
    

}