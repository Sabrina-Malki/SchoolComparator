<!DOCTYPE html>
<head>
<script src="jquery-3.3.1.js"></script>
<script src="javaProj.js"></script>
<script src="jquery.min.js"></script>
<link href="style.css" rel="stylesheet"/>
</head>
<body>
<input id="filtre" type="text" placeholder="Recherche.."> <br/><br/>

<div id="tableau">
		<center>
		<table border="10" class="table" id="tableEco">
		<thead>
		<th onclick="sortTable(0)">Nom</th>
		<th>Catégorie </th>
		<th onclick="sortTable(2)">Wilaya </th>
		<th onclick="sortTable(3)">Commune</th>
		<th onclick="sortTable(4)">Adresse</th>
		<th onclick="sortTable(5)">Téléphones</th>
		<th>Commentaires</th>
		</thead>
		<tbody id="tableBody">

		
		<?php
		
		while ($data=$req->fetch())
		{
			echo '<tr> <td> <a href="../projet/accueil.php?nom='.$data['Nom'].'" target="_blank">'.$data['Nom'].' </a></td>
				  <td> '.$data['Catégorie'].' </td>
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
	
<script>
filterTable()
</script>
</body>
</html>	