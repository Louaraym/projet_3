<?php
namespace loray\projet_3;
try
{   
    require_once('controller/backend.php');
    $postManager = new PostManager();   
    $idValid = $postManager->getIdValid();

    if (isset($_GET['action'])) 
    {
        // Affichage de la liste des articles sur le tableau de bord
        if ($_GET['action'] == 'listPosts') 
        {
            listPosts();
        }
        
        // Affichage des commentaires
        elseif ($_GET['action'] == 'listComments') 
        {
           listComments();
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
    require('view/backend/errorView.php');
}


