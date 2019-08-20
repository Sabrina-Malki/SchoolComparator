<?php
require_once("connBDD.php");
session_start();
global $db;
?>

<!DOCTYPE html>
<head>
<link href="stylePage.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <script src="scriptPage.js"></script> -->
<script src="jquery-3.3.1.js"></script>
<script src="scriptPageJQ.js"></script> 


<meta charset="utf-8">
<title> <?php echo $_GET['nom']; ?> </title>
</head>

<!-- <body onload="calculTaxe()"> -->
<body>

<header>
<h1> <center> <?php echo $_GET['nom']; ?> </center></h1>
<h2> <center> مدرسة خاصة </center> </h2>
</header>

<a href="login.php?nom=<?php echo $_GET['nom'];?>"> Se connecter </a>

<!--Script JQuery pour actualiser la page chaque 5 secondes -->

<script>
setInterval('load_table()',5000);
function load_table() {
  $('#tableau').load('tableRefresh.php');
}
</script> 

<!-- <img src="imageAccueil.jpg" title="image accueil" alt="image d'accueil" width="100%" id="flou"> --> 



<div class="container">
  <div class="slideshow_wrapper">
    <div class="slideshow">
      <div class="slide">
        <img src="imageAccueil.jpg" />
      </div>
      
      <div class="slide">
        <img src="diapo2.jpg" />
      </div>
      
       <div class="slide">
        <img src="diapo3.jpg" />
      </div>
	 
    </div></div></div></div>


<?php

 
echo '<div id="menu"> <ul class="formation">';

$req = $db->query('SELECT ID,Designation FROM typeformations');

//Création des types formations 
while ($data = $req->fetch())
{
	echo '<li><a href="'.$data['Designation'].'.html" target="_blank">'.$data['Designation'].' </a>
	<ul class="sous-liste">';
	
    $req2 = $db->prepare('SELECT Designation FROM formations WHERE TypeID = ?');
    $req2->execute(array($data['ID']));
	//Création des formations (sous-menu)
    while ($data2 = $req2->fetch())	 
     {
      echo '<li>'.$data2['Designation'].'</li>';
     } 
    echo '</ul></li>';
} 

echo '</ul></div>';

$req->closeCursor();
$req2->closeCursor();

?>




<center>
<video width="500" height="300" controls>
<source src="Video accueil.mp4" type="video/mp4"> 
</video> </center>
 </br>

<!-- TABLEAU -->


<div id="tableau">
<center>
<table border="10" class="table" id="tableTax">
<thead>
<th>Formation </th>
<th>Volume horaires </th>
<th>Prix HT(DA) </th>
<th>Taux taxe(%) </th>
<th>Prix TTC(DA)</th>
</thead>
<tbody>


<?php

$req = $db->query('SELECT * FROM typeformations');
while ($data=$req->fetch())
{
	$taux = $data['TauxT']*100;
	echo '<tr> <td>'.$data['Designation'].'</td>
	      <td> '.$data['VolumeH'].'h </td>
		  <td>'.$data['PrixHT'].'</td>
		  <td>'.$taux.'</td> 
		  <td></td> </tr>';
}

?>



</tbody>
</table>
</center>

</div>



<!-- TABLEAU -->

<?php

if (isset($_SESSION["droits"])) {
if ($_SESSION["droits"] == 'admin') 
// Ajout formation 
	echo '<form name="formaForm" id="form" method="POST" action="ajoutForma_post.php">
<label>Nom de la formation :</label> <input type="text" id="nom" name="nom" required /> <br/><br/>
<label>Volume horaires :</label> <input type="number" min="1" max="24" id="vh" name="volH" required /><br/><br/>
<label>Prix HT :</label> <input type="number" id="ht" name="prixHT" required /><br/><br/>
<label>Taux taxe :</label> <input type="floatval" id="tauxt" name="tauxT" required /><br/><br/>
<input type="submit" value="Valider" id="valid"/>
</form>';

// ou faire le formulaire à part et le cacher, puis l'afficher dans le cas d'un administrateur
// <button class="btn" type="submit" value="Valider" id="valid"><span class="fa fa-home"></span></button>
}

session_destroy();
?>



<footer>
<a href="mailto:fs_malki@esi.dz">Contactez nous</a>
</footer>

</body>





</html>
