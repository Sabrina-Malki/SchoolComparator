<?php
require_once("../Model/connBDD.php");


function getEcoles($cat){
	
	global $db;
	
	$req = $db->prepare('SELECT Nom,Catégorie,Domaine,Wilaya,Commune,Adresse,Téléphone FROM ecole WHERE Catégorie = ?');
	$req->execute(array($cat));
	
	return $req;
}

function getComments($ecole) {
	global $db;

	$req = $db->prepare('SELECT ID FROM ecole WHERE Nom = ?');
	$req->execute(array($ecole));
	$data = $req->fetch();
	
	$req2 = $db->prepare('SELECT Auteur,Contenu,Date,ID_Ecole FROM commentaires WHERE ID_Ecole = ? ORDER BY Date Desc');
	$req2->execute(array($data['ID']));
	
	return $req2;
}

function getAllComments() {
	global $db;
	
	$req = $db->query('SELECT Auteur,Contenu,Date FROM commentaires');
	return $req;
}

function getEcoleID($ecole) {
	global $db;
	
	$req = $db->prepare('SELECT ID FROM ecole WHERE Nom = ?');
	$req->execute(array($ecole));
	$data = $req->fetch();
	
	return $data['ID'];
}

function addComments($ecole,$auteur,$contenu) {
	global $db;
	
	$ID = getEcoleID($ecole);
	$req = $db->prepare('INSERT INTO Commentaires(Auteur,Contenu,Date,ID_Ecole) VALUES(:auteur,:contenu,now(),:id)');
	$req->execute(array(
	"auteur"=> $auteur,
	"contenu"=>$contenu,
	"id"=>$ID
	));
	
	return;
}

function getFormations($ecole) {
	global $db;
	
	$req = $db->prepare('SELECT ID_TFormations FROM ecole WHERE Nom = ?');
	$req->execute(array($ecole));
	$data = $req->fetch();
	
	$req2 = $db->prepare('SELECT Designation,VolumeH,PrixHT,TauxT FROM typeformations WHERE ID = ?');
	$req2->execute(array($data['ID_TFormations']));
	
	return $req2;
}

function login($name,$mdp){
	global $db;
	
	$req = $db->prepare("SELECT Name,Password,Rights FROM users WHERE Name = ?");
	$req->execute(array($name));
	$data = $req->fetch();
	if (empty($data) || $data["Password"] != $mdp)
	{
		return 0;
	}

	else { 
			 session_start();
			 $_SESSION["nom"] = $name;
			 $_SESSION["droits"] = $data['Rights'];
			 return 1; 
	};
	
}


