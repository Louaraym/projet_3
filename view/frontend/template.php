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
              <div class="public_wrap">

                  <nav>
                    <ul>
                      <li class="user">Bonjour <?= $_SESSION['pseudo']; ?></li>
                      <li><a href="admin.php">Tableau de bord</a></li>
                      <li><a href="admin.php?action=logOut">Se déconnecter</a></li>
                    </ul>
                  </nav> 
            
                  <h1>Billet simple pour l'Alaska</h1>
                  <?= $content ?>
                  <footer></footer>

              </div> 
          <?php
        }
        else
        {
           ?>
            <div class="public_wrap">

                <h1>Billet simple pour l'Alaska</h1>
                <?= $content ?>
                <footer></footer>

              </div> 
           <?php    
        }
        ?>
    </body>
</html>