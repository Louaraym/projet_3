<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/styleblog.css" rel="stylesheet" /> 
    </head>   
    <body>
        <?php
        if (isset($_SESSION['pseudo'])) 
        { 
          ?>
              <div class="wrap_public">
                  <nav class="navigation_public">
                    <ul>
                      <li><a href="admin.php">Retour au tableau de bord</a></li>
                    </ul>
                  </nav>
                  <header><h1>Billet simple pour l'Alaska</h1></header>
                <!--   <div class="admin_title"><header><h1>Billet simple pour l'Alaska</h1></header></div> -->
                 
                  <nav class="logout">
                    <ul>
                      <li>Bonjour <?= $_SESSION['pseudo']; ?></li>
                      <li><a href="admin.php?action=logOut">Se déconnecter</a></li>
                    </ul>
                  </nav>
              </div>
              <?= $content ?>
              <footer></footer>
          <?php
        }
        else
        {
           ?>
            <header>
              <h1>Billet simple pour l'Alaska</h1>
            </header>
            <?= $content ?>
            <footer></footer>
           <?php    
        }
        ?>
    </body>
</html>