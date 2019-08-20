<?php
//Connexion à la base de donnée 
$base = 'projet';
$server = 'localhost';
$user = 'root';
$password = '';
$con='mysql:dbname='.$base.';host='.$server.';charset=utf8'; 
try 
{
	$db = new PDO($con,$user,$password);
}

catch(PDOException $e)
{
	printf('Echec de la connexion : %s\n',$e->getMessage());
	exit();
}
?>