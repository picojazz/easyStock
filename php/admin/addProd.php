<?php 
include '../moduleConnexion.php';
	extract($_POST);
	 	if (empty($designation) || empty($pu) || empty($qte) || empty($four)) {
	 						echo "non";
	 }else{
	 	$req=sprintf("INSERT INTO produit (designation,pu,qte,codefour)VALUES('$designation','$pu','$qte','$four')" ); 
		$verif=mysql_query($req)or die(mysql_error());
		$req1=sprintf("SELECT codeprod FROM produit ORDER BY codeprod DESC LIMIT 1" ); 
		$verif1=mysql_query($req1)or die(mysql_error());
		$recup=mysql_fetch_assoc($verif1);
		echo $recup['codeprod'];
		
	 }
		
	
		

 ?>