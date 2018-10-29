<?php
namespace loray\projet_3;
require('model/Autoloader.php');
Autoloader::register();


function listPosts()
{
    $postManager = new PostManager();
    $listPosts = $postManager->getAllPosts(); 
    $nbre_total_articles = $postManager->count();

    require('view/backend/listPostsView.php');
}

function listComments()
{
    $commentManager = new CommentManager();
    $commentsToModerate =  $commentManager->getCommentsToModerate();
    $listComments = $commentManager->getAllComments(); 

    require('view/backend/listCommentsView.php');
}

function moderateComment($commentId)
{
    $commentManager = new commentManager();
    $modif = $commentManager->moderate($_GET['id']);
     
    if ($modif === false) 
    {
        throw new \Exception('Impossible de moderer le commentaire !');
    }
    else 
    {
        header('Location: admin.php?action=listComments');
    }
}

function addView()
{
    require('view/backend/addView.php');
}

function addNewPost($author, $title, $content)
{
    $postManager = new PostManager();
    $ajout = $postManager->addPost($author, $title, $content);

    if ($ajout === false) 
    {
        throw new \Exception('Impossible d\'ajouter l\'article !');
    }
    else 
    {
        header('Location: admin.php');
    }
}

function updatePost($author, $title, $content, $postId)
{
    $postManager = new PostManager();
    $modif = $postManager->update($author, $title, $content, $_GET['id']);
     
    if ($modif === false) 
    {
        throw new \Exception('Impossible de modifier l\'article !');
    }
    else 
    {
        header('Location: admin.php');
    }
}

function post()
{
    $postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);

    require('view/backend/updatePostView.php');
}

function delete($postId)
{
    $postManager = new PostManager();
    $post = $postManager->deletePost($_GET['id']);
    
    header('Location: admin.php');
   
} 

function deleteComment($commentId)
{
    $postManager = new CommentManager();
    $post = $postManager->deleteComments($_GET['id']);
    
    header('Location: admin.php?action=listComments');
   
} 

