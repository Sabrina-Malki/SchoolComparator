<!DOCTYPE html>

<link href="stylePage.css" rel="stylesheet"/>
<script src="jquery-3.3.1.js"></script>

<div>
<div id="ecoles" class="formulaire">
<label>Ecoles : </label>
<div id="ajoutFormaLoad">
<?php
require_once("connBDD.php");
global $db;
echo '<ul>';
 $req = $db->query("SELECT ID,Nom,Catégorie,Domaine,Wilaya,Commune,Adresse,Téléphone FROM ecole");
 while ($data=$req->fetch())
 {   echo '<li><strong>'.$data['Nom'].'</strong><br/>'.$data['Catégorie'].'<br/>'.$data['Domaine'].'<br/>'.$data['Wilaya'].'<br/>'.$data['Commune'].'<br/>'.$data['Adresse'].'<br/>'.
$data['Téléphone'].'<br/>'.'<form method="post"> <input type="submit" name="supp'.$data["Nom"].'" value="Supprimer l ecole"/>
	 <input type="submit" name="modif'.$data["Nom"].'" value="Modifier les informations de l école"/>
	 </form>';
	 
	 //Traitement de la modification d une ecole
	 $k = 'modif'.$data["Nom"];
	 if (isset($_POST[$k]))
	 {
		 header('Location:modifType.php?form='.$data["Nom"]);
	 }

	 //Traitement de la suppression d'un type de formation
	 $s = 'supp'.$data["Nom"];
	 if (isset($_POST[$s]))
	 {
	 	$req = $db->prepare("DELETE FROM ecole WHERE Nom = ?");
        $req->execute(array($data["Nom"]));
	 };
	 
	echo '</li>';
	 
 }
 $req->closeCursor();
 echo "</ul>";
 
?>
</div>

<div class="formulaire">

<form name="typeForm" id="form" method="post">
<label><bold>- Ajout d'un type de formation : </bold></label> <br/><br/>
<label>Nom de l'ecole :</label> <input type="text" id="nom" name="nom" required /> <br/><br/>
<label>Catégorie :</label> <input type="text" id="vh" name="cat" required /><br/><br/>
<label>Domaine :</label> <input type="text" id="ht" name="dom" required /><br/><br/>
<label>Wilaya :</label> <input type="text" id="tauxt" name="wil" required /><br/><br/>
<label>Commune :</label> <input type="text" name="com" required /><br/><br/>
<label>Adresse :</label> <input type="text" name="adr" required /><br/><br/>
<label>Téléphone :</label> <input type="number" name="tel" required /><br/><br/>
<input type="submit" value="Valider" name="ajoutType" class="envoi" id="ajoutType"/>
</form>

</div>
</div>

<div id="membrecom" class="formulaire">
<label>Commentaires : </label>
<?php require("../Model/model.php");
$req = getAllComments();

 while ($comments = $req->fetch())
 {
	 ?>
	 <p><strong><?php echo $comments['Auteur']?> </strong>le <?php echo $comments['Date']?> </p>
	 <p style="font-style:italic;"><?php echo $comments['Contenu']?></p>
	 
 <?php
 }
 ?>
</div>
</div>

<?php
//Traitement de l'ajout d'un type de formation 
 if (isset($_POST["ajoutType"]))
 {
  $req5 = $db->prepare("SELECT * FROM ecole WHERE Nom = ?");
  $req5->execute(array($_POST["nom"]));
  $data = $req5->fetch();
   // Vérifier si cette ecole existe déjà  
  if (!empty($data)) echo '<script type="text/javascript">' . 'alert(" Cette école existe déja existe déjà!");' . '</script>';
  else
  {
  // Insertion de l ecole 
	$req6 = $db->prepare("INSERT INTO ecole(Nom,Catégorie,Domaine,Wilaya,Commune,Adresse,Téléphone) VALUES(:nom,:cat,:dom,:wil,:com,:adr,:tel)");
	$req6->execute(array(
	"nom"=>$_POST["nom"],
	"cat"=>$_POST["cat"],
	"dom"=>$_POST["dom"],
	"wil"=>$_POST["wil"],
	"com"=>$_POST["com"],
	"adr"=>$_POST["adr"],
	"tel"=>$_POST["tel"]
	));
  }
  
 }
?>









</html>