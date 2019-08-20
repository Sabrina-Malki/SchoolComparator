<!DOCTYPE html>

<head>
<title><?php echo $_GET['nom']?></title>
</head>

<body>

<center><strong><?php echo $_GET['nom']?></strong></center>

<div class="comments" style="text-align:left;">
 <?php
 while ($comments = $req->fetch())
 {
	 ?>
	 <p><strong><?php echo $comments['Auteur']?> </strong>le <?php echo $comments['Date']?> </p>
	 <p style="font-style:italic;"><?php echo $comments['Contenu']?></p>
	 
 <?php
 }
 ?>
</div>

<p style="color:blue;text-align:center;"><strong>Ajouter un commentaire :</strong></p>
<form action="../Controller/commentairesAjouter.php" method="post" style="text-align:center;" >
	<input type="text" placeholder="Nom" name="auteur" required> <br/><br/>
	<textarea rows="7" cols="50" placeholder="Commentaire" name="comment" required></textarea>
	<input type="hidden" name='nom' value="<?php echo $_GET['nom']?>">
	<input type="submit" value="Envoyer">
</form>


</textarea>




</body>

</html>