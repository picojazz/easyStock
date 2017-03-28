<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php';
    $tot = 0;

    if (isset($_GET)) {

      $codecmd=$_GET['id'];
    }

      $reql=sprintf("SELECT c.codecmd,nom,prenom,datelivr,p.codeprod,designation,pu,qtecmd,(pu*qtecmd) as montant FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.codecmd=$codecmd ORDER BY c.datelivr DESC ");
      $verifl=mysql_query($reql) or die(mysql_error());

      $req=sprintf("SELECT nom,prenom,datelivr,SUM(pu*qtecmd) as total FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.codecmd=$codecmd GROUP BY nom,prenom,datelivr ORDER BY c.datelivr DESC ");
      $verif=mysql_query($reql) or die(mysql_error());
      $recup=mysql_fetch_assoc($verif);
      

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/materialize.min.css">
	<link rel="stylesheet" href="../css/myCss.css">
  <link rel="icon" type="image/png" href="../image/easystock.png" />
	<title>Facture</title>
</head>
<body>

    

    <div style="width: 70%;margin: 0 auto;" class=" auth ">
    
      <h3 class="center titre">Facture N° <?php echo $codecmd ?></h3><br>
      <h4><?php echo $recup['prenom'].' '.$recup['nom']; ?><span class="right"><?php echo $recup['datelivr']; ?></span></h4>
      <h5 class="center ">commande N° <?php echo $codecmd ?></h5><br>
      
      <table >
          <tbody>
            <tr>
              <th>Code produit</th>
              <th>Produit</th>
              <th>Quantite</th>
              <th>Prix unitaire</th>
              <th>Montant (f cfa)</th>
              
            </tr>
            <?php while($recupl=mysql_fetch_assoc($verifl)) { ?>
            <tr>
              <td><?php echo $recupl['codeprod']; ?></td>
                <td><?php echo $recupl['designation']; ?></td>
                <td><?php echo $recupl['qtecmd']; ?></td>
                <td><?php echo $recupl['pu']; ?></td>
                <td><?php echo $recupl['montant']; ?></td>
                
            </tr>

            <?php $tot +=$recupl['montant']; } ?>
          </tbody>
        </table><br>

        <h3 class="center ">TOTAL : <?php echo number_format($tot,0,","," "),' F cfa'; ?></h3>

     

    </div>
        
      
  
	




<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script type="text/javascript">
  window.print();
</script>



</body>
</html>