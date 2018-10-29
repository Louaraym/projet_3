       
<?php $title = 'Mon blog'; ?>
        <?php ob_start(); ?>

<p>Ajouter un nouveau article</p>    
    <form action="admin.php?action=addPost" method="POST">
        <p>Auteur<br><input class="my_form" type="text" size="65" name="author" required></p>
        <p>Titre<br><input class="my_form" type="text" size="65" name="title" required></p>
        <p>Contenu<br><textarea name="content" class="tinymce" placeholder="Rédiger le contenu de votre article ici" rows="25" cols="95" ></textarea></p>
        <p><input type="submit" name="ajouter" value="Ajouter l'article"></p>
    </form>
    
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
