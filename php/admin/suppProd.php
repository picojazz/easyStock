<?php 
	include '../moduleConnexion.php';
	if (isset($_GET)) {
		
		$id=$_GET['id'];

		$req=sprintf("DELETE FROM produit WHERE codeprod ='$id'" ); 
		$verif=mysql_query($req)or die(mysql_error());
	}

 ?>