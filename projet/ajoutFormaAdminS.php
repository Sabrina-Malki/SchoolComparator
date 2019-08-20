<?php
session_start();
if (empty($_SESSION)) header("Location:login.php"); 
?>

<!DOCTYPE html>

<link href="stylePage.css" rel="stylesheet"/>
<script src="jquery-3.3.1.js"></script>


<div id="ajoutFormaLoad">
<?php
require_once("connBDD.php");
global $db;
echo '<ul>';
 $req = $db->query("SELECT ID,Designation,VolumeH,PrixHT,TauxT FROM typeformations ORDER BY Designation");
 while ($data=$req->fetch())
 {   echo '<li>'.$data['Designation'].'<form method="post"> <input type="submit" name="supp'.$data["Designation"].'" value="Supprimer le type de formation"/>
	 <input type="submit" name="modif'.$data["Designation"].'" value="Modifier le type de formation"/>
	 </form>
	 <ul class="submenu">';
	 
	 //Traitement de la modification d'un type de formation 
	 $k = 'modif'.$data["Designation"];
	 if (isset($_POST[$k]))
	 {
		 header('Location:modifType.php?form='.$data["Designation"]);
	 }

	 //Traitement de la suppression d'un type de formation
	 $s = 'supp'.$data["Designation"];
	 if (isset($_POST[$s]))
	 {
	 	$req = $db->prepare("DELETE FROM typeformations WHERE Designation = ?");
        $req->execute(array($data["Designation"]));
	 }
	 
	 $req2 = $db->prepare("SELECT Designation from formations WHERE TypeID = ? ORDER BY Designation");
	 $req2->execute(array($data['ID']));
	 while ($data2 = $req2->fetch())
	 {
		 
    echo '<li>'.$data2["Designation"].' : <br/> '.$data["VolumeH"].'h - '.$data["PrixHT"].'DA - '.$data["TauxT"].' 
	<form method="post"> <input type="submit" name="supp'.$data2["Designation"].'" value="Supprimer"/> 
	<input type="submit" name="modif'.$data2["Designation"].'" value="Modifier"/>
	</form></li> ';
	
	//Traitement de la suppression d'une formation
	$l = 'supp'.$data2["Designation"];
	if (isset($_POST[$l])) 
	{	
	  $req3 = $db->prepare("DELETE FROM formations WHERE Designation = ? ");
	  $req3->execute(array($data2["Designation"]));
	  echo '<script type="text/javascript">' . 'alert(" Formation supprimée !");' . '</script>';  
	}
	//
	//Traitement de la modification d'une formation
	$j = 'modif'.$data2["Designation"];
	if (isset($_POST[$j]))
    {
	header('Location:modifForm.php?form='.$data2["Designation"]);
    }
	
	 }
	 
	 echo '</ul> </li>';
	 
 }
 $req->closeCursor();
 echo "</ul>";
 
?>
</div>

<div class="formulaire">

<form name="typeForm" id="form" method="post">
<label><bold>- Ajout d'un type de formation : </bold></label> <br/><br/>
<label>Nom du type de la formation :</label> <input type="text" id="nom" name="nom" required /> <br/><br/>
<label>Volume horaire :</label> <input type="number" min="1" max="24" id="vh" name="volH" required /><br/><br/>
<label>Prix HT :</label> <input type="number" id="ht" name="prixHT" required /><br/><br/>
<label>Taux taxe :</label> <input type="floatval" id="tauxt" name="tauxT" required /><br/><br/>
<label>Nom de la formation :</label> <input type="text" name="nomForm" required /><br/><br/>
<input type="submit" value="Valider" name="ajoutType" class="envoi" id="ajoutType"/>
</form>

<form name="formaForm" id="form2" method="post">
<label>- Ajout d'une formation : </label> <br/><br/>
<label>Nom de la formation :</label> <input type="text" id="nom2" name="nom2" required /> <br/><br/>
<label>Type de la formation :</label> <input type="text" id="type" name="typef" required /> <br/><br/>
<input type="submit" value="Valider" name="ajoutForm" class="envoi"/>
</form>

</div>

<?php
 //Traitement de l'ajout d'une formation 
 if (isset($_POST["ajoutForm"]))
 {
	$req = $db->prepare("SELECT ID FROM typeformations WHERE Designation = ?");
	$req->execute(array($_POST["typef"]));
	$data = $req->fetch();
	//Vérifier si ce type de formation existe
	if (empty($data)) echo '<script type="text/javascript">' . 'alert(" Ce type de formation n\'existe pas!");' . '</script>';
	else 
	{
		$req9 = $db->prepare("SELECT * FROM formations WHERE Designation = ?");
		$req9->execute(array($_POST["nom2"]));
		$data3 = $req9->fetch();
		//Vérifier si cette formation existe déjà
		if (!empty($data3)) echo '<script type="text/javascript">' . 'alert(" Cette formation existe déjà!");' . '</script>';
		else 
		{
		$req4 = $db->prepare("INSERT INTO formations(TypeID,Designation) VALUES(:tid,:des)");
		$req4->execute(array(
		"tid"=>$data["ID"],
		"des"=>$_POST["nom2"]
		));
			//echo '<script type="text/javascript">' . 'alert(" Formation ajoutée !");' . '</script>';
		//header("Location:ajoutFormaAdmin.php");
		}
	
	}
 }
 
//Traitement de l'ajout d'un type de formation 
 if (isset($_POST["ajoutType"]))
 {
  $req5 = $db->prepare("SELECT * FROM typeformations WHERE Designation = ?");
  $req5->execute(array($_POST["nom"]));
  $data = $req5->fetch();
   // Vérifier si ce type de formation existe déjà  
  if (!empty($data)) echo '<script type="text/javascript">' . 'alert(" Ce type de formation existe déjà!");' . '</script>';
  else
  {
  // Insertion du nouveau type 
	$req6 = $db->prepare("INSERT INTO typeformations(Designation,VolumeH,PrixHT,TauxT) VALUES(:des,:vh,:ht,:tt)");
	$req6->execute(array(
	"des"=>$_POST["nom"],
	"vh"=>$_POST["volH"],
	"ht"=>$_POST["prixHT"],
	"tt"=>$_POST["tauxT"]
	));
    // Insertion de la nouvelle formation relative au nouveau type de formation	
	$req7 = $db->prepare("SELECT ID FROM typeformations WHERE Designation = ?");
	$req7->execute(array($_POST["nom"]));
	$data2 = $req7->fetch();
	
	$req8 = $db->prepare("INSERT INTO formations(TypeID,Designation) VALUES(:tid,:des)");
	$req8->execute(array(
	"tid"=>$data2["ID"],
	"des"=>$_POST["nomForm"]
	));
  }
  
 }
?>




</html>