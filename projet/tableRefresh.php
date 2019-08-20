<center>
<table border="10" class="table" id="tableTax">
<thead>
<th>Formation </th>
<th>Volume horaires </th>
<th>Prix HT(DA) </th>
<th>Taux taxe(%) </th>
<th>Prix TTC(DA)</th>
</thead>
<tbody>

<?php

require_once("connBDD.php");
global $db;

$req = $db->query('SELECT * FROM typeformations');
while ($data=$req->fetch())
{
	$taux = $data['TauxT']*100;
	echo '<tr> <td>'.$data['Designation'].'</td>
	      <td> '.$data['VolumeH'].'h </td>
		  <td>'.$data['PrixHT'].'</td>
		  <td>'.$taux.'</td> 
		  <td></td> </tr>';
}

?>

</tbody>
</table>
</center>
