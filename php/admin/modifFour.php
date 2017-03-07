<?php 
	
	include '../moduleConnexion.php';
	
	if (isset($_GET)) {
		
		$id=$_GET['id'];

		$req=sprintf("SELECT * FROM fournisseur WHERE codefour ='$id'" ); 
		$verif=mysql_query($req)or die(mysql_error());
		$recup=mysql_fetch_assoc($verif);
		echo json_encode($recup) ;
	}

 ?>