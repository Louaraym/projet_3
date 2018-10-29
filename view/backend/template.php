<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
    </head>   
    <body>
         <div class="admin_wrap"> 
            <nav class="navigation">
            <ul>
                <li><a href="index.php">Accueil du site</a></li>
                <li><a href="admin.php">Tableau de bord</a></li>
                <li><a href="admin.php?action=addView">Ajouter un article</a></li>
                <li><a href="admin.php?action=listComments">Les commentaires</a></li>
            </ul>
            </nav>

            <div class="main_content"> 
                    <?= $content ?>  
            </div> 
        </div>
    </body>
</html>