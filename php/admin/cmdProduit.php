<?php 
	include '../moduleConnexion.php';
	extract($_POST);

	$req=sprintf("INSERT INTO cmdprod (codeprod,codecmd,qtecmd,qtelivr)VALUES('$codeprod','$codecmd','$qtecmd',0)" ); 
		$verif=mysql_query($req)or die(mysql_error());





 ?>