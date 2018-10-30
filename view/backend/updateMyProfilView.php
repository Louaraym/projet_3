      
<?php $title = 'Mon blog'; ?>
        <?php ob_start(); ?>
<?php
if (isset($_SESSION['pseudo'])) 
{
   
?>   

<div class="adminForm">
     <h2>Changer votre identifiant</h2>
        <form action="admin.php?action=updateMyProfil" method="post">
            <p>Votre nouveau identifiant <br> <input type="text" name="pseudo" size="45"/></p>
            <p> <input type="submit" name="submit" value="Changer"/></p>
        </form>
          <h2>Changer votre mot de passe</h2>
        <form action="admin.php?action=updateMyProfil" method="post">
                <p>Votre ancien mot de passe <br> <input type="password" name="ancien_pass" size="45" /></p> 
                <p>Votre nouveau mot de passe <br><input type="password" name="nouveau_pass" size="45" /></p>  
                <p> Confirmez Votre nouveau mot de passe<br><input type="password" name="re_nouveau_pass" id="re_nouveau_pass" size="45" /></p>
                <input type="submit" name="pass_submit" value="Changer"/><br>
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
