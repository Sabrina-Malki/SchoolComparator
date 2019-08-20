function calculTaxe()
{
var lignes = document.getElementById("tableTax").rows;
var cpt = lignes.length;


for (i=1 ; i<cpt ; i++) {
	
	var ht = lignes[i].cells[2].innerHTML;
	var tt = lignes[i].cells[3].innerHTML;
	var result = ((ht*tt)/100+parseInt(ht));
	lignes[i].cells[4].innerHTML = result;
	
}



}

