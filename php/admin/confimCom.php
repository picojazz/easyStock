<?php 
	
	include '../moduleConnexion.php';
	
	if (isset($_GET)) {
		
		$codecmd=$_GET['codecmd'];
		$datelivr= $_GET['datelivr'];

		$req=sprintf("UPDATE commande SET datelivr='$datelivr' WHERE codecmd='$codecmd'" ); 
		$verif=mysql_query($req)or die(mysql_error());
		echo "oui";
	}

 ?>