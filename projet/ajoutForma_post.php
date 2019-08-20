<?php
require_once("connBDD.php");
header("Location:accueil.php");
global $db;

$des = $_POST['nom'];
$vh = $_POST['volH'];
$ht = $_POST['prixHT'];
$tt = $_POST['tauxT'];

$req = $db->prepare("INSERT INTO typeformations(Designation,VolumeH,PrixHT,TauxT) VALUES(:des,:vh,:ht,:tt)");
$req->execute(array(
"des" => $des,
"vh" => $vh,
"ht" => $ht,
"tt" => $tt
));
?>