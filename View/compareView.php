<?php require("../Model/model.php"); ?>
<head>
<link href="style.css" rel="stylesheet"/>
</head>
<body>
<div id="firstPart" style="width:100%">
<form method="post">
<select id="compareListe" name="selectCompare" style="width:100%;">
  <option selected="true" disabled="disabled">Choisissez une catégorie</option> 
  <option value="Maternelle">Maternelle</option>
  <option value="Primaire">Primaire</option>
  <option value="Moyen">Moyen</option>
  <option value="Secondaire">Secondaire</option>
  <option value="Formations universitaires">Formations universitaires</option>
  <option value="Formations professionnelles">Formations professionnelles</option>
</select><br/><br/>
<center><input type="submit" value="Ok" name="choixCat"/></center><br/>
</form>
</div>

<div id="secondPart">
<?php
//Choix de la categorie et des ecoles 
 if(isset($_POST['choixCat'])){
	$ecole = $_POST['selectCompare'];
	$req = getEcoles($ecole);
	?>
	<!-- premiere ecole -->
	<form method="post" action="">
	<select name="selectEcole"  style="width:100%;">
	<?php
    while ($data=$req->fetch()) 
	{
	?>
	<option value="<?php echo $data['Nom']; ?>"><?php echo $data['Nom']; ?></option> 
	<?php
	}
	?>
	</select>
	<!-- deuxieme ecole -->
	<?php 
	$ecole = $_POST['selectCompare'];
	$req = getEcoles($ecole);
	?>
	<select name="selectEcole2"  style="width:100%;">
	<?php 
    while ($data=$req->fetch()) 
	{
	?>
	<option value="<?php echo $data['Nom']; ?>"><?php echo $data['Nom']; ?></option> 
	<?php
	}
	?>
	</select><br/><br/>
	<center><input type="submit" value="Comparer" name="choixEcole"/></center> <br/>
</form>
	<?php

	}
//Affichage des tableaux 	
	if(isset($_POST['choixEcole'])) {
     
	?>	
	<!-- tableau premiere ecole -->
<div>	
     <div id="ecole1">  
		<p><table border="10" id="table1" >
		<thead> 
		<th>Nom</th>
		<th>Formation</th>
		<th>Volume horaire</th>
		<th>Prix HT</th>
		<th>Taux taxe</th>
		</thead>
		<tbody>
		<?php 
		
		$req2 = getFormations($_POST['selectEcole']);
		while ($data2 = $req2->fetch())
		{
			echo '<tr> <td>'.$_POST['selectEcole'].'</td>
			<td>'.$data2['Designation'].'</td>
			<td>'.$data2['VolumeH'].'</td>
			<td>'.$data2['PrixHT'].'</td>
			<td>'.$data2['TauxT'].'</td>
			</tr>';
		}
		
		
		?>
		
		</tbody>
		</table> </p> <br/>
		<!-- commentaires premiére ecole -->
		
		 <?php
		 $req = getComments($_POST['selectEcole']);
		 while ($comments = $req->fetch())
		 {
			 ?>
			 <p><strong><?php echo $comments['Auteur']?> </strong>le <?php echo $comments['Date']?> </p>
			 <p style="font-style:italic;"><?php echo $comments['Contenu']?></p>
			 
		 <?php
		 }
        ?>
	</div>
		<!-- tableau deuxieme ecole -->
	<div id="ecole2">
		<p><table border="10" id="table2">
		<thead> 
		<th>Nom</th>
		<th>Formation</th>
		<th>Volume horaire</th>
		<th>Prix HT</th>
		<th>Taux taxe</th>
		</thead>
		<tbody>
		<?php 
		
		$req2 = getFormations($_POST['selectEcole2']);
		while ($data2 = $req2->fetch())
		{
			echo '<tr> <td>'.$_POST['selectEcole2'].'</td>
			<td>'.$data2['Designation'].'</td>
			<td>'.$data2['VolumeH'].'</td>
			<td>'.$data2['PrixHT'].'</td>
			<td>'.$data2['TauxT'].'</td>
			</tr>';
		}
		
		
		?>
		
		</tbody>
		</table></p> <br/> 
		<!-- commentaires deuxieme ecole -->
	
		 <?php
		 $req = getComments($_POST['selectEcole2']);
		 while ($comments = $req->fetch())
		 {
			 ?>
			 <p><strong><?php echo $comments['Auteur']?> </strong>le <?php echo $comments['Date']?> </p>
			 <p style="font-style:italic;"><?php echo $comments['Contenu']?></p>
			 
		 <?php
		 }
        ?>
	</div>	
	<?php
	};
	
?>
</div>
</div>
</body>