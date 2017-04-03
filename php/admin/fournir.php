<?php 
	
	include '../moduleConnexion.php';
		
	
		
		
		

		$req=sprintf("INSERT INTO fourniture (datefournt)VALUES(NOW())" ); 
		$verif=mysql_query($req)or die(mysql_error());
		$reqm=sprintf("SELECT codefournt FROM fourniture ORDER BY codefournt DESC LIMIT 1" ); 
		$verifm=mysql_query($reqm)or die(mysql_error());
		$recupm=mysql_fetch_assoc($verifm);
		echo $recupm['codefournt']; 
	
		
	

 ?>