<?php
namespace loray\projet_3;
try
{
    require_once('controller/frontend.php');

    if (isset($_GET['action'])) 
    {
        //Affichage de la liste des articles publiées
        if ($_GET['action'] == 'listPosts') 
        {
            listPosts();
        }
    }  
    else 
    {
        listPosts();
    }
}
catch(\Exception $e)
{
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}


