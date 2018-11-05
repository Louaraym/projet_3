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
        header('Location: admin.php?page=listComments');
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
    
    header('Location: admin.php?page=listComments');
} 

function loginView()
{
    require('view/backend/loginView.php');
}

function logOut()
{
    require('view/backend/logout.php');
}


function updateMyProfil()
{
    session_start();
    $userManager = new UserManager();
    if (isset($_POST['submit'])) 
        {
             $pseudo = trim($_POST['pseudo']);
             if (empty($pseudo)) 
             {
                 $erreur = "Veuillez saisir votre nouveau identifiant !";
             }
             else
             {              
                //  Mise à jour du pseudo
                $resultat =  $userManager->updateProfil($pseudo);

                if ($resultat === false) 
                {
                    $erreur = "La mise à jour a échoué !";
                }
                else 
                {
                    header('location: index.php?page=login');
                }
                
             }              
        } 

        if (isset($_POST['pass_submit'])) 
        {
            $ancien_pass = trim($_POST['ancien_pass']);
            $nouveau_pass = trim($_POST['nouveau_pass']);
            $re_nouveau_pass = trim($_POST['re_nouveau_pass']);
            $ancien_pass_hache = password_hash($ancien_pass, PASSWORD_DEFAULT);

            //  Récupération de l'ancien pass hashé
             $formerPwd =  $userManager->getFormerPwd();

            // Comparaison du pass envoyé via le formulaire avec la base
            $isPasswordCorrect = password_verify($ancien_pass, $formerPwd['pass']);

            if (empty($ancien_pass) || empty($nouveau_pass) || empty($re_nouveau_pass)) 
            {
                $erreur = 'Veuillez saisir tous les champs !';
            }
            elseif (!$isPasswordCorrect) 
            {
               $erreur = 'L\'ancien mot de passe est incorrect !';
            }
            elseif ($nouveau_pass != $re_nouveau_pass) 
            {
               $erreur = 'Vos nouveaux mots de passe sont différents !';
            }           
            else
            {
                $nouveau_pass_hache = password_hash($nouveau_pass, PASSWORD_DEFAULT);
                $newPwd = $userManager->updatePwd($nouveau_pass_hache);

                if ($newPwd === false) 
                {
                    $erreur = "<p>La mise à jour a échoué !</p>";
                }
                else 
                {
                    header('location: index.php?page=login');
                }
                
            }
            
        } 

    require('view/backend/updateMyProfilView.php');

    if(isset($erreur))
     {
        echo  '<p style="color: red; text-align: center"*/>'.$erreur.'</p>';
     }
}

