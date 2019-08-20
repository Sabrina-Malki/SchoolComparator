<?php 
require("../Model/model.php");

$req = getComments($_GET['nom']);

include('../View/commentairesView.php');
