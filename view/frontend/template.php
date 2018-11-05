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

                   <div class="banniere_image"></div>

                  <nav>
                    <ul>
                      <li class="user">Bonjour <?= $_SESSION['pseudo']; ?></li>
                      <li><a href="admin.php">Tableau de bord</a></li>
                      <li><a href="admin.php?page=logOut">Se déconnecter</a></li>
                    </ul>
                  </nav> 
            
                  <h1>Billet simple pour l'Alaska</h1>
                  <?= $content ?>

                  <footer>
                   <nav>
                    <ul>
                      <li><a href="index.php">Accueil</a></li>
                       <li><a href="index.php?page=apropos"">A propos de Jean Forteroche</a></li>
                      <li class="mentionsLegales"><a href="index.php?page=mentionsLegales">Mentions légales</a></li>
                    </ul>
                  </nav> 
                </footer>

              </div> 
          <?php
        }
        else
        {
           ?>
            <div class="public_wrap">
                <div class="banniere_image"></div>
                <h1>Billet simple pour l'Alaska</h1>
                <?= $content ?>
                <footer>
                   <nav>
                    <ul>
                      <li><a href="index.php">Accueil</a></li>
                      <li><a href="index.php?page=apropos"">A propos de Jean Forteroche</a></li>
                      <li class="mentionsLegales"><a href="index.php?page=mentionsLegales">Mentions légales</a></li>
                    </ul>
                  </nav> 
                </footer>

              </div> 
           <?php    
        }
        ?>
    </body>
</html>