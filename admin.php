<?php
namespace loray\projet_3;
try
{   
    require_once('controller/backend.php');
    $postManager = new PostManager();   
    $idValid = $postManager->getIdValid();

    if (isset($_GET['page'])) 
    {
        // Affichage de la liste des articles sur le tableau de bord
        if ($_GET['page'] === 'listPosts')
        {
            listPosts();
        }
        // Affichage des commentaires
        elseif ($_GET['page'] === 'listComments')
        {
           listComments();
        }
         // Moderation d'un commentaire
        elseif ($_GET['page'] === 'moderateComment')
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
        elseif ($_GET['page'] === 'addView')
        {
           addView();
        }
        //Ajout d'un article
        elseif ($_GET['page'] === 'addPost')
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
        elseif ($_GET['page'] === 'deletePost')
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
        // Suppression d'un commentaire
        elseif ($_GET['page'] === 'deleteComment')
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                deleteComment($_GET['id']);
            }
            else 
            {
                throw new \Exception('Le document auquel vous tentez d\'accéder est introuvable. <br>
                    Vous pouvez contacter l\'administrateur du site si vous pensez qu\'il s\'agit d\'un bug.');
            }
        }
        // Affichage page de mise à jour
        elseif ($_GET['page'] === 'updatePostView')
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
        elseif ($_GET['page'] === 'updatePost')
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
        elseif ($_GET['page'] === 'logOut')
        {
           logOut();
        }
        // Affichage page changement de profil
        elseif ($_GET['page'] === 'updateMyProfil')
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


