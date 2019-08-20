var JQ = jQuery.noConflict();

//calculer taxe

JQ(document).ready(function(){
	JQ("#tableTax tr").hover(function(){
		
			var ht = parseInt(JQ(this).find('td').eq(2).html());
			var tt = parseInt(JQ(this).find('td').eq(3).html());
			var result = ((ht*tt)/100+parseInt(ht));
			JQ(this).find('td').eq(4).html(result);
		
	});
});

JQ(document).ready(function(){
	JQ(".envoi").on('click',function(event){
		JQ('#ajoutFormaLoad').load('ajoutRefresh.php');
		event.preventDefault();
	});
});

// ajouter nouvelle formation

// JQ(document).ready(function() {
	// JQ("#valid").click(function() {
		//Créer la ligne
		// JQ("#tableTax").append("<tr><td> </td><td> </td><td> </td><td> </td><td> </td></tr>");
		//Récuperer les valeurs
		// var nom = JQ("#nom").val();
		// var volumeH = JQ("#vh").val();
		// var prixHT = JQ("#ht").val();
		// var tauxT = JQ("#tauxt").val();
		//Mettre à jour la table 
	    // JQ("#tableTax tr:last").find('td').eq(0).html(nom);
	    // JQ("#tableTax tr:last").find('td').eq(1).html(volumeH);
	    // JQ("#tableTax tr:last").find('td').eq(2).html(prixHT);
	    // JQ("#tableTax tr:last").find('td').eq(3).html(tauxT);
		
		// var result = ((prixHT*tauxT)/100+parseInt(prixHT));
		// JQ("#tableTax tr:last").find('td').eq(4).html(result);
		
		// JQ("#form")[0].reset();
		
		
		
// });
	
// });