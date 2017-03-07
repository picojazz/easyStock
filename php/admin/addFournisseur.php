<?php 
include '../moduleConnexion.php';
	extract($_POST);
	 	if (empty($prenom) || empty($nom) || empty($adresse) || empty($tel)) {
	 						echo "non";
	 }else{
	 	$req=sprintf("INSERT INTO fournisseur (prenom,nom,adresse,tel)VALUES('$prenom','$nom','$adresse','$tel')" ); 
		$verif=mysql_query($req)or die(mysql_error());
		$req1=sprintf("SELECT codefour FROM fournisseur ORDER BY codefour DESC LIMIT 1" ); 
		$verif1=mysql_query($req1)or die(mysql_error());
		$recup=mysql_fetch_assoc($verif1);
		echo $recup['codefour'];
		
	 }
		
	
		

 ?>