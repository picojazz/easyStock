<?php 
	
	include '../moduleConnexion.php';
	
	if (isset($_GET)) {
		
		$qte=$_GET['qte'];
		$codeprod=$_GET['codeprod'];
		$codecmd=$_GET['codecmd'];

		$req=sprintf("UPDATE cmdprod SET qtelivr=qtelivr+$qte where codeprod=$codeprod AND codecmd=$codecmd " ); 
		$verif=mysql_query($req) or die(mysql_error());
		$reqf=sprintf("UPDATE produit SET qte=qte-$qte where codeprod=$codeprod  " ); 
		$veriff=mysql_query($reqf) or die(mysql_error());

		//verif cmd total
		
		$reqp=sprintf("SELECT qtecmd,qtelivr FROM cmdprod where codeprod=$codeprod AND codecmd=$codecmd" ); 
		$verifp=mysql_query($reqp) or die(mysql_error());
		$recupp=mysql_fetch_assoc($verifp);
		
		
		if ($recupp['qtecmd'] == $recupp['qtelivr']) {
			$reqa=sprintf("UPDATE cmdprod SET etat=1 where codeprod=$codeprod AND codecmd=$codecmd " ); 
		$verifa=mysql_query($reqa) or die(mysql_error());
		echo "oui";
		}

		$reqb=sprintf("SELECT qtecmd FROM cmdprod where etat=0 AND codecmd=$codecmd" ); 
		$verifb=mysql_query($reqb) or die(mysql_error());
		$row=mysql_num_rows($verifb);
		
		if ($row == 0) {
			$reqc=sprintf("UPDATE commande SET etat = 1 where codecmd=$codecmd " ); 
		$verifc=mysql_query($reqc) or die(mysql_error());
		}

		
	}

 ?>