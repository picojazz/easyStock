<?php 
	
	include '../moduleConnexion.php';
	
	if (isset($_GET)) {
		
		$id=$_GET['id'];

		$req=sprintf("SELECT c.codecmd,datecmd,designation,pu,qtecmd,pu*qtecmd as montant,qtecmd,qtelivr,cp.etat,p.codeprod FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND cl.codecli=$id AND c.etat = 0 ORDER BY c.codecmd ASC");
      $verif=mysql_query($req) or die(mysql_error());
      $tab=array();
		while ($recup=mysql_fetch_assoc($verif)){
		array_push($tab,$recup);
		}

		echo json_encode($tab) ;
	}

 ?>