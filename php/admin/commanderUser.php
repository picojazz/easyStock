<?php 
	
	include '../moduleConnexion.php';
		extract($_POST);
	
		
		if (empty($codecli) ) {
			echo "non";
		}else{
		

		$req=sprintf("INSERT INTO commande (codecli,datecmd,etat)VALUES('$codecli',NOW(),0)" ); 
		$verif=mysql_query($req)or die(mysql_error());
		$reqm=sprintf("SELECT codecmd,datecmd FROM commande ORDER BY codecmd DESC LIMIT 1" ); 
		$verifm=mysql_query($reqm)or die(mysql_error());
		$recupm=mysql_fetch_assoc($verifm);
		echo $recupm['codecmd']; 
	}
		
	

 ?>