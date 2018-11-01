<?php
session_start();
?>        
<?php $title = 'Mon blog'; ?>
        <?php ob_start(); ?>
<?php
if (isset($_SESSION['pseudo'])) 
{

?> 
        
<h2>Voici la liste des commentaires en attente de moderation</h2>

<table>
      <tr><th>Auteur</th><th>Commentaire</th><th>Titre de l'article associé au commentaire</th><th class="comment_date">Date de publication</th><th>Action</th></tr>  
    <?php 

        foreach ($commentsToModerate as $comment)
        {
             echo '<tr><td>' .htmlspecialchars($comment->getAuthor()). '</td><td>' .htmlspecialchars($comment->getComment()). '</td><td>' .$comment->getTitle(). '</td><td class="comment_date">' .$comment->getComment_date()->format('d/m/Y à H\hi'). '</td><td><a href="admin.php?action=moderateComment&amp;id=' .$comment->getId(). '">Approuver</a> |<a href="admin.php?action=deleteComment&amp;id=' .$comment->getId(). '">Supprimer</a></td></tr>' ."\n";
        } 
    ?>
</table> 

        <h2>Voici la liste des commentaires qui ont été approuvés</h2>

<table>
      <tr><th>Auteur</th><th>Commentaire</th><th>Titre de l'article associé au commentaire</th><th class="comment_date">Date de publication</th><th>Signalé</th><th>Action</th></tr>  
    <?php 

       foreach ($listComments as $comment)
        {
             echo '<tr><td>' .htmlspecialchars($comment->getAuthor()). '</td><td>' .htmlspecialchars($comment->getComment()). '</td><td>' .$comment->getTitle(). '</td><td class="comment_date">' .$comment->getComment_date()->format('d/m/Y à H\hi'). '</td><td>' .$comment->getAlert(). '</td><td><a href="admin.php?action=deleteComment&amp;id=' .$comment->getId(). '">Supprimer</a></td></tr>' ."\n";
        } 
    ?>
</table> 
<?php
 }
else
{
    header('location: index.php?action=login');
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
