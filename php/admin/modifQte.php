<?php 
	
	include '../moduleConnexion.php';
	
	if (isset($_GET)) {
		
		$qte=$_GET['qte'];
		$codeprod=$_GET['codeprod'];
		$codecmd=$_GET['codecmd'];

		$req=sprintf("UPDATE cmdprod SET qtecmd=$qte where codeprod=$codeprod AND codecmd=$codecmd " ); 
		$verif=mysql_query($req) or die(mysql_error());
		

		//verif cmd total
		
		
		
	}

 ?>