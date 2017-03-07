<?php 
	include '../moduleConnexion.php';
			extract($_POST);
	 	if (empty($prenom) || empty($nom) || empty($adresse) || empty($tel) || empty($id)) {
	 						echo "non";
	 }else{
	 	$req=sprintf("UPDATE fournisseur SET prenom='$prenom',nom='$nom',tel='$tel',adresse='$adresse' WHERE codefour='$id'" ); 
		$verif=mysql_query($req)or die(mysql_error());
		
		
	 }


 ?>