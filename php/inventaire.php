<?php 
	include 'moduleTestUser.php';
    include 'moduleConnexion.php';

    $req=sprintf("SELECT codeprod,designation,pu,qte,pu*qte as total  FROM produit ORDER BY codeprod DESC" ); 
	$verif=mysql_query($req)or die(mysql_error());
	$reqm=sprintf("SELECT sum(pu*qte) as tot  FROM produit" ); 
	$verifm=mysql_query($reqm)or die(mysql_error());
	$recupm=mysql_fetch_assoc($verifm);


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>inventaire</title>
	<link rel="stylesheet" href="../css/materialize.min.css">
  <link rel="stylesheet" href="../css/myCss.css">
</head>
<body>

<div class="container center">
	<h1 class="titre center">INVENTAIRE DES PRODUITS</h1>
	<table>
		<tbody>
			<tr>
			  <th>Code Produit</th>
              <th>Designation</th>
              <th>Prix Unitaire (f cfa)</th>
              <th>Quantite</th>
              <th>Total (f cfa)</th>
            </tr>
            <?php while ($recup=mysql_fetch_assoc($verif)) { ?>
            <tr>
            	<td><?php echo $recup['codeprod']; ?></td>
            	<td><?php echo $recup['designation']; ?></td>
            	<td><?php echo $recup['pu']; ?></td>
            	<td><?php echo $recup['qte']; ?></td>
            	<td><?php echo $recup['total']; ?></td>
            </tr>
            <?php } ?>
		</tbody>
	</table>
	<h3 class="center">TOTAL : <?php echo number_format($recupm['tot'],0,","," "); ?> F CFA</h3>
	<br><br>
	
</div>
		
<script type="text/javascript">
	window.print();
</script>
</body>
</html>