<?php 
	include '../moduleConnexion.php';
			extract($_POST);
	 	if (empty($designation) || empty($pu) || empty($qte) || empty($id)) {
	 						echo "non";
	 }else{
	 	$req=sprintf("UPDATE produit SET designation='$designation',pu='$pu',qte='$qte' WHERE codeprod='$id'" ); 
		$verif=mysql_query($req)or die(mysql_error());
		
		
	 }


 ?>