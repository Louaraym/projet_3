     
<?php $title = 'Mon blog'; ?>

    <?php ob_start(); ?>

    <p>Il y a actuellement <?= $nbre_total_articles ?> articles publiés sur le site. En voici la liste :</p>    
<table>
      <tr><th>Auteur</th><th>Titre</th><th>Date de publication</th><th>Dernière modification</th><th>Action</th></tr>  
    <?php 

        foreach ($listPosts as $post)
        {
             echo '<tr><td>' .$post->getAuthor(). '</td><td>' .$post->getTitle(). '</td><td>' .$post->getCreation_date()->format('d/m/Y à H\hi'). '</td><td>' .($post->getCreation_date() == $post->getUpdate_date() ? '-' : $post->getUpdate_date()->format('d/m/Y à H\hi')). '</td><td><a href="index.php?action=post&amp;id=' .$post->getId(). '">Voir</a> | <a href="admin.php?action=updatePostView&amp;id=' .$post->getId(). '"> Modifier </a> | <a href="admin.php?action=deletePost&amp;id=' .$post->getId(). '">Supprimer</a></td></tr>' ."\n";
        } 

    ?>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
