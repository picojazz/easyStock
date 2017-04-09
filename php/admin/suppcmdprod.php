<?php 
	include '../moduleConnexion.php';
	extract($_POST);

	$req=sprintf("DELETE FROM cmdprod WHERE codeprod ='$codeprod' AND codecmd='$codecmd'"); 
		$verif=mysql_query($req)or die(mysql_error());





 ?>