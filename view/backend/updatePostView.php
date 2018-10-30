<?php
session_start();
?>         
<?php $title = 'Mon blog'; ?>
        <?php ob_start(); ?>
 <?php
if (isset($_SESSION['pseudo'])) 
{

?>
<div class="adminForm">  
	<h2>Mise à jour d'un article</h2>
    <form action="admin.php?action=updatePost&amp;id=<?= $post->getId() ?>" method="POST">
        <p>Auteur<br><input class="my_form" type="text" size="65" name="author" value="<?= $post->getAuthor() ?>"></p>
        <p>Titre<br><input class="my_form" type="text" size="65" name="title" value="<?= $post->getTitle() ?>"></p>
        <p>Contenu<br><textarea name="content" class="tinymce" rows="25" cols="95"><?= $post->getContent() ?></textarea></p>
        <p><input type="submit" name="ajouter" value="Modifier l'article"></p>
    </form>
</div>
<?php
 }
else
{
    header('location: index.php?action=login');
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
