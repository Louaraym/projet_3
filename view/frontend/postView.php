
<?php $title = htmlspecialchars($post->getTitle()); ?>
<?php ob_start(); ?>
        <p><a href="index.php">Accueil du site</a></p>

        <div class="news">
            <h3>
                <?= $post->getTitle() ?>
                <em>, publié le <?= $post->getCreation_date()->format('d/m/Y à H\hi') ?></em>
                <?php echo ' par ' .$post->getAuthor() ?>
                <?php echo ($post->getCreation_date() == $post->getUpdate_date() ? '' : ' | Mis à jour le '.$post->getUpdate_date()->format('d/m/Y à H\hi')) ?>
            </h3>
            <div class="postUnique">
                <?= $post->getContent() ?>
            </div >
        </div>
       
        <h2>Commentaires</h2>

        <?php
        if (empty($listComments))
        {
        ?>
        <p  class="emptyComment">Soyez le premier à laisser un commentaire !</p>
        <?php
        }

        foreach ($listComments as $comment)
        {   
        ?>
      
       <div class="comment">
            <h3>
                Publié le <?= $comment->getComment_date()->format('d/m/Y à H\hi') ?> par
                <strong> <?= htmlspecialchars($comment->getAuthor()) ?></strong>
            </h3>
            <p>
                <?= nl2br(htmlspecialchars($comment->getComment())) ?>
            </p>
            <div class="signaler">
                <a href="index.php?action=alertComment&amp;id=<?= $comment->getId() ?>&amp;
                post_id=<?= $comment->getPost_id() ?>">Signaler</a>
            </div>
        </div> 

        <?php
        }

         ?>
         <div class="commentForm">
            <h2> Commenter cet épisode </h2>
            <form action="index.php?action=addComment&amp;id=<?= $post->getId() ?>" method="post">
                <p><label for="pseudo">Votre pseudo*</label> <br><input type="text" name="author" id="pseudo" size="30" required class="my_form" /> </p>
                <p><label for="message">Votre commentaire*</label> <br><textarea name="comment" rows="15" cols="60" id="message" required class="my_form"></textarea></p> 
                 <p>Votre commentaire sera publié dans les plus brefs délais après modération</p>      
                <p><input type="submit" value="Publier"/> </p>    
            </form>
         </div>   

        <?php
        ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>