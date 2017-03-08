<?php 
	
	include '../moduleConnexion.php';
	
	


		$req=sprintf("SELECT * FROM produit " ); 
		$verif=mysql_query($req)or die(mysql_error());
		$tab=array();
		while ($recup=mysql_fetch_assoc($verif)){
		array_push($tab,$recup);
		}

		echo json_encode($tab) ;
		 

 ?>
