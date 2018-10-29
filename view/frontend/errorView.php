<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page d'erreur</title>
        <link href="public/css/styleblog.css" rel="stylesheet" /> 
        <style type="text/css"> body{ background-color:#CCCCCC;}</style>
    </head>   
    <body>
    <div class="error">
      <h1>Page d'erreur !</h1>
     <?=  '<p style="color: red">'.$errorMessage.'</p>' ?>
      <p><a href="index.php">Retour à l'accueil du site</a></p>
 	</div>
    </body>
</html>          



 			