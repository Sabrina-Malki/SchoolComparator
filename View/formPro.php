<?php
require("../Model/connBDD.php");
global $db;
require("templateHead.html"); 
?>
<!DOCTYPE html>	
<head>
<script src="jquery-3.3.1.js"></script>
<script src="javaProj.js"></script>
<script src="jquery.min.js"></script>
<link href="style.css" rel="stylesheet"/>
</head>
<body>
<center><input id="filtre" type="text" placeholder="Recherche.."> </center><br/><br/>

<div class="contenu">
<div id="tableau">
		<center>
		<table border="10" class="table" id="tableEco">
		<thead>
		<th onclick="sortTable(0)">Nom</th>
		<th>Catégorie </th>
		<th onclick="sortTable(2)">Domaine </th>
		<th onclick="sortTable(3)">Wilaya </th>
		<th onclick="sortTable(4)">Commune</th>
		<th onclick="sortTable(5)">Adresse</th>
		<th onclick="sortTable(6)">Téléphones</th>
		<th>Commentaires</th>
		</thead>
		<tbody id="tableBody">


		<?php
		
		require("../Model/model.php");
	    $req = getEcoles('Formations professionnelles'); 
		while ($data=$req->fetch())
		{
			echo '<tr> <td> <a href="../projet/accueil.php?nom='.$data['Nom'].'" target="_blank">'.$data['Nom'].' </a></td>
				  <td> '.$data['Catégorie'].' </td>
				  <td> '.$data['Domaine'].' </td>
				  <td>'.$data['Wilaya'].'</td>
				  <td>'.$data['Commune'].'</td> 
				  <td>'.$data['Adresse'].'</td> 
				  <td>'.$data['Téléphone'].'</td> 
				  <td> <a href="../Controller/commentairesAfficher.php?nom='.$data['Nom'].'" >Lire/Ajouter commentaire(s)</td>
				  </tr>';
		}

		?>



		</tbody>
		</table>
		</center>
	</div>
	</div>
<script>
filterTable()
</script>
</body>

<?php require("templateFoot.html"); ?>
</html>