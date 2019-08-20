<form method="post">
<label> Modifier le nom de la formation :</label><input type="text" name="nom" placeholder="<?php echo $_GET["form"] ?>"/> <br/>
<input type="submit" value="Valider" name="valider"/>
</form>

<?php
require_once("connBDD.php");
global $db;

if (isset($_POST["valider"]))
{
	$req = $db->prepare("UPDATE formations SET Designation = ? WHERE Designation = ?");
	$req->execute(array($_POST["nom"],$_GET["form"]));
	header("Location:ajoutFormaAdmin.php");
}

?>

