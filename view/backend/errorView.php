<?php
session_start();
?>  
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page d'erreur</title>
        <link href="public/css/styleblog.css" rel="stylesheet" /> 
        <style type="text/css"> body{ background-color:#CCCCCC;}</style>
    </head>   
    <body>

    <?php
    if (isset($_SESSION['pseudo'])) 
    {
      ?>
       <div class="error">
         <h1>Page d'erreur !</h1>
         <?=  '<p style="color: red">'.$errorMessage.'</p>' ?>
         <p><a href="admin.php">Retour sur le tableau de bord</a></p>
        </div>
      <?php
     }
    else
    {
        header('location: index.php?pagelogin');
    }

    ?>

    </body>
</html>          

            
 			