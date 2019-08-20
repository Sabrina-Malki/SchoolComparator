<head>
<link href="style.css" rel="stylesheet"/>
</head>
<body>
<div class="formulaire">
<form name="loginForm" method="post" action="../Controller/login.php">


<center><label>Connexion</label></center><br/><br/>
<center><label>Nom d'utilisateur : </label></center> <center><input type="text" name="nom" required /></center><br/><br/>
<center><label>Mot de passe : </label></center> <center><input type="password" name="mdp" required /></center><br/><br/>
<center><input type="submit" value="Se connecter"/></center>

<?php
if (isset($_POST[''])) 
?>
</form>
</div>
</body>