<?php 
	
	include '../moduleConnexion.php';
		extract($_POST);
	
		
		if (empty($codecli) || empty($datelivr)) {
			echo "non";
		}else{
		

		$req=sprintf("INSERT INTO commande (codecli,datelivr,datecmd,etat)VALUES('$codecli','$datelivr',NOW(),0)" ); 
		$verif=mysql_query($req)or die(mysql_error());
		$reqm=sprintf("SELECT codecmd,datecmd FROM commande ORDER BY codecmd DESC LIMIT 1" ); 
		$verifm=mysql_query($reqm)or die(mysql_error());
		$recupm=mysql_fetch_assoc($verifm);
		echo $recupm['codecmd'];
	}
		
	

 ?>