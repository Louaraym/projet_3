<?php
namespace loray\projet_3;
try
{
    require_once('controller/frontend.php');
    $postManager = new PostManager();  
    $idValid = $postManager->getIdValid();


    if (isset($_GET['action'])) 
    {
        //Affichage de la liste des articles publiées
        if ($_GET['action'] == 'listPosts') 
        {
            listPosts();
        }
         //Page: Affichage article unique avec ses commentaires
        elseif ($_GET['action'] == 'post') 
        {
            if (isset($_GET['id']) && in_array($_GET['id'], $idValid)) 
            {
                post();
            }
            else 
            {
                throw new \Exception('Le document auquel vous tentez d\'accéder est introuvable. <br>
                    Vous pouvez contacter l\'administrateur du site si vous pensez qu\'il s\'agit d\'un bug.');
            }
        }
        //Ajout d'un commentaire à un article
        elseif ($_GET['action'] == 'addComment') 
        {
            if (isset($_GET['id']) && in_array($_GET['id'], $idValid) )
            {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) 
                {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else 
                {
                    header('Location: index.php?action=post&id=' .$_GET['id']);
                }
            }
            else 
            {
                throw new \Exception('Le document auquel vous tentez d\'accéder est introuvable. <br>
                    Vous pouvez contacter l\'administrateur du site si vous pensez qu\'il s\'agit d\'un bug.');  
            }
        }
        // Signalement d'un commentaire par un utilisateur
        elseif ($_GET['action'] == 'alertComment') 
        {
            if (isset($_GET['id']) && $_GET['id'] >0) 
            {
               alertComment($_GET['id']);
            }
            else 
            {
                throw new \Exception('Le document auquel vous tentez d\'accéder est introuvable. <br>
                    Vous pouvez contacter l\'administrateur du site si vous pensez qu\'il s\'agit d\'un bug.');             
            }
        }
        //Affichage page Mentions légales
         elseif ($_GET['action'] == 'mentionsLegales') 
        {
            mentionsLegales();
        }
        //Affichage page A propos de l'auteur
         elseif ($_GET['action'] == 'apropos') 
        {
            apropos();
        }
        // Affichage page de connexion
         elseif ($_GET['action'] == 'login') 
        {
            loginForm();
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


