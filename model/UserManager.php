<?php
namespace loray\projet_3;
require_once('DaoManager.php');

class UserManager extends DaoManager
{
    
    public function getUser($pseudo)
    {
        $req = $this->dao->prepare('SELECT pass FROM user WHERE pseudo = :pseudo');
        $req->execute(array('pseudo' => $pseudo));
        $resultat = $req->fetch();

        return $resultat;
    }

    public function updateProfil($pseudo)
    {
    	$req = $this->dao->prepare("UPDATE  user SET pseudo = :pseudo WHERE pseudo = '{$_SESSION['pseudo']}'");
                $req->execute(array('pseudo' => $pseudo));

        return $req; 
    }

    public function getFormerPwd()
    {
    	$req = $this->dao->query("SELECT pass FROM user WHERE pseudo = '{$_SESSION['pseudo']}'");
        $formerPwd = $req->fetch();

        return $formerPwd;

    }

    public function updatePwd($nouveau_pass_hache)
    {
    	$req = $this->dao->prepare("UPDATE  user SET pass = :pass WHERE pseudo =  '{$_SESSION['pseudo']}'"); 
                $req->execute(array('pass' => $nouveau_pass_hache));
                
        return $req;  
    }

}