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


}

