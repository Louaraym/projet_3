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
         // Moderation d'un commentaire
        elseif ($_GET['action'] == 'moderateComment') 
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
               moderateComment($_GET['id']);
            }
            else 
            {
                throw new \Exception('Le document auquel vous tentez d\'accéder est introuvable. <br>
                    Vous pouvez contacter l\'administrateur du site si vous pensez qu\'il s\'agit d\'un bug.');             
            }
        }
         // Affichage page édition article
        elseif ($_GET['action'] == 'addView') 
        {
           addView();
        }
        //Ajout d'un article
        elseif ($_GET['action'] == 'addPost') 
        {     
            if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['content'])) 
            {
                addNewPost($_POST['author'], $_POST['title'], $_POST['content']);
            }
            else 
            {
                throw new \Exception('Tous les champs ne sont pas remplis !');
            }        
        }
        // Suppression d'un article
        elseif ($_GET['action'] == 'deletePost') 
        {
            if (isset($_GET['id']) && in_array($_GET['id'],  $idValid)) 
            {
                delete($_GET['id']);
            }
            else 
            {
                throw new \Exception('Le document auquel vous tentez d\'accéder est introuvable. <br>
                    Vous pouvez contacter l\'administrateur du site si vous pensez qu\'il s\'agit d\'un bug.');
            }
        }
        // Affichage page de mise à jour
        elseif ($_GET['action'] == 'updatePostView') 
        {
            if (isset($_GET['id']) && in_array($_GET['id'],  $idValid) ) 
            {
                post();
            }
            else 
            {
                throw new \Exception('Le document auquel vous tentez d\'accéder est introuvable. <br>
                    Vous pouvez contacter l\'administrateur du site si vous pensez qu\'il s\'agit d\'un bug.');
            }
        }
        // Mise à jour d'un article
        elseif ($_GET['action'] == 'updatePost') 
        {
            if (isset($_GET['id']) && in_array($_GET['id'],  $idValid)) 
            {
                if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['content'])) 
                {
                    updatePost($_POST['author'], $_POST['title'], $_POST['content'], $_GET['id']);
                }
                else 
                {
                   throw new \Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else 
            {
                throw new \Exception('Le document auquel vous tentez d\'accéder est introuvable. <br>
                    Vous pouvez contacter l\'administrateur du site si vous pensez qu\'il s\'agit d\'un bug.');             
            }
        }
        // Déconnexion
        elseif ($_GET['action'] == 'logOut') 
        {
           logOut();
        }
        // Affichage page changement de profil
        elseif ($_GET['action'] == 'updateMyProfil') 
        {
           updateMyProfil();
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


