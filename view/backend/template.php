<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/styleblog.css" rel="stylesheet" /> 
        <script type="text/javascript" src="vendors/js/jquery.min.js"></script>
        <script type="text/javascript" src="vendors/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="vendors/tinymce/init_tinymce.js"></script>
    </head>   
    <body>
        <?php
        if (isset($_SESSION['pseudo'])) 
        { 
          ?>
        <div class="admin_wrap"> 
            <nav class="navigation">
            <ul>
                <li><a href="index.php">Accueil du site</a></li>
                <li><a href="admin.php">Tableau de bord</a></li>
                <li><a href="admin.php?action=addView">Ajouter un article</a></li>
                <li><a href="admin.php?action=listComments">Les commentaires</a></li>
                <li><a href="admin.php?action=updateMyProfil">Modifier mon profil</a></li>
                <li><a href="admin.php?action=logOut">Se déconnecter</a></li>
            </ul>
            </nav>

            <div class="main_content">
                <P>Bonjour <?= $_SESSION['pseudo']; ?></P> 
                            <?= $content ?>  
            </div> 
        </div>
        <?php
        }
        else
        {
            header('location: index.php?action=login');
        }
        ?>
         
    </body>
</html>