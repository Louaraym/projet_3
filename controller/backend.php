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

