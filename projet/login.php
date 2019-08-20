<!DOCTYPE html>
<?php
require_once("connBDD.php");
global $db;
?>
<link href="stylePage.css" rel="stylesheet"/>

<div class="formulaire">
<form name="loginForm" method="post">


<center><label>Connexion</label></center><br/><br/>
<center><label>Nom d'utilisateur : </label></center> <center><input type="text" name="nom" required /></center><br/><br/>
<center><label>Mot de passe : </label></center> <center><input type="password" name="mdp" required /></center><br/><br/>
<center><input type="submit" value="Se connecter" /></center>
</form>
</div>


<?php

if (isset($_POST["nom"]) AND isset($_POST["mdp"]))
{

$req = $db->prepare("SELECT Name,Password,Rights FROM users WHERE Name = ?");
$req->execute(array($_POST["nom"]));
$data = $req->fetch();
if (empty($data) || $data["Password"] != $_POST["mdp"])
{
	echo '<script type="text/javascript">' . 'alert("Nom d\'utilisateur ou mot de passe incorrect(s) !");' . '</script>';
}

else { 
		 session_start();
		 $_SESSION["nom"] = $data["Name"];
		 $_SESSION["droits"] = $data["Rights"];
		 if ($_SESSION["nom"]=='admin') header("Location:ajoutFormaAdminS.php");
		 else 
		 {
			 $name =$_GET['nom'];
			 header("Location:accueil.php?nom=$name&type=pasvis");
		 }
}

}
?>

</html>