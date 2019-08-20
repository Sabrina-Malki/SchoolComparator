<?php require("../Model/model.php");



if (login($_POST['nom'],$_POST['mdp']))
	{
	if ($_SESSION["droits"]=='admin') header("Location:../projet/ajoutFormaAdmin.php");
	else header("Location:../View/index.php");
	}
else {
		echo '<script type="text/javascript">' . 'alert("Nom d\'utilisateur ou mot de passe incorrect(s) !");' . '</script>';
		header("Location:../View/loginView.php");
	 }
	





