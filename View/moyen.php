<?php
require("../Model/connBDD.php");
global $db;
require("templateHead.html"); 
?>

	<div class="contenu">
	<?php 
	require("../Model/model.php");
	$req = getEcoles('Moyen'); 
	require("templateTableau.php"); 
	?>
	</div>
	

</body>

<?php require("templateFoot.html"); ?>
</html>