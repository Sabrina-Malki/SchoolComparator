<?php
require_once("connBDD.php");
global $db;

$req = $db->prepare("SELECT * FROM typeformations WHERE Designation = ?");
$req->execute(array($_GET["form"]));
$data = $req->fetch();
?>

<form method="post">

<label>Nom du type de la formation : </label><input type="text" name="nom" placeholder="<?php echo $data["Designation"]?>" required /><br/><br/>
<label>Volume horaire : </label><input type="text" name="vh" placeholder="<?php echo $data["VolumeH"] ?>" required /><br/><br/>
<label>Prix hors taxe : </label><input type="text" name="pht" placeholder="<?php echo $data["PrixHT"] ?>" required /><br/><br/>
<label>Taux taxe : </label><input type="text" name="taux" placeholder="<?php echo $data["TauxT"] ?>" required /><br/><br/>
<input type="submit" value="Valider" name="valider" />

</form>

<?php
if (isset($_POST["valider"]))
{
	$req2 = $db->prepare("UPDATE typeformations SET Designation=:des,VolumeH=:vol,PrixHT=:prix,TauxT=:taux WHERE Designation = :olddes");
	$req2->execute(array(
	'des'=>$_POST["nom"],
	'vol'=>$_POST["vh"],
	'prix'=>$_POST["pht"],
	'taux'=>$_POST["taux"],
	'olddes' => $_GET["form"],
	));
	header("Location:ajoutFormaAdmin.php");
}
?>