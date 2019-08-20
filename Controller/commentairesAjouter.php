<?php

require("../Model/model.php");

addComments($_POST['nom'],$_POST['auteur'],$_POST['comment']);

header("Location:../View/index.php");