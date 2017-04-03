<?php 
	include '../moduleConnexion.php';
	extract($_POST);

	$req=sprintf("INSERT INTO prodfournt (codeprod,codefournt,qteav,qtefr)VALUES('$codeprod','$codefournt','$qteav','$qtefr')" ); 
		$verif=mysql_query($req)or die(mysql_error());

	$reqp=sprintf("UPDATE produit SET qte=qte+$qtefr WHERE codeprod=$codeprod" ); 
		$verifp=mysql_query($reqp)or die(mysql_error());





 ?>