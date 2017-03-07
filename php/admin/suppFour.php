<?php 
	include '../moduleConnexion.php';
	if (isset($_GET)) {
		
		$id=$_GET['id'];

		$req=sprintf("DELETE FROM fournisseur WHERE codefour ='$id'" ); 
		$verif=mysql_query($req)or die(mysql_error());
	}

 ?>