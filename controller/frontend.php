<?php
namespace loray\projet_3;
require('model/Autoloader.php');
Autoloader::register();

function listPosts()
{
    $postManager = new PostManager(); 
    $listPosts = $postManager->getPosts(); 
    $pagination = $postManager->maPagination(); 
    $nbre_total_articles = $postManager->count();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new PostManager(); 
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $listComments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) 
    {
        throw new \Exception('Impossible d\'ajouter le commentaire !');
    }
    else 
    {
        header('Location: index.php?action=post&id=' .$postId);
    }
}



