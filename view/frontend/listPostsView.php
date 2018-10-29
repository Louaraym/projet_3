      
<?php $title = 'Mon blog'; ?>
        <?php ob_start(); ?>
        <p>Il y a actuellement <?= $nbre_total_articles ?> articles publiés sur le site. En voici la liste :</p>       
    <?php
        foreach ($listPosts as $post)
        {
             if (strlen($post->getContent()) <= 400)
            {
              $content = $post->getContent();
            }
            else
            {
              $debut = substr($post->getContent(), 0, 400);
              $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
              
              $content = $debut;
            }
        ?>
            <div class="news">
                <h3>
                    <?= $post->getTitle() ?>
                    <em>, publié le <?= $post->getCreation_date()->format('d/m/Y à H\hi') ?></em>
                    <?php echo ' par ' .$post->getAuthor() ?>
                </h3>          
                <div class="postExtrait"> 
                    <?= $content ?> 
                </div>
                <div class="continuer">
                    <a href="index.php?action=post&amp;id=<?= $post->getId() ?>">Continuer la lecture ...</a> 
                </div>
            </div>
        <?php
        } 
        
        echo '<div class="pagination">' .$pagination. '</div>';
    ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>