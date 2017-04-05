<?php 
    session_start();
if ($_SESSION['login'] ==""  ) {
    header("Location:../index.php?erreur=intru");}
    include 'moduleConnexion.php';
      $codecli = $_SESSION['codecli'];
      $reqc=sprintf("SELECT c.codecmd,cp.codeprod,datecmd,cl.codecli,nom,prenom,designation,pu,qtecmd,pu*qtecmd as montant,datelivr,qtelivr,qtecmd-qtelivr as qterestant,cp.etat FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecli='$codecli' AND cp.etat = 0 AND c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod  ORDER BY c.codecmd DESC");
      $verifc=mysql_query($reqc) or die(mysql_error());
      $rowc =mysql_num_rows($verifc);

      $reql=sprintf("SELECT c.codecmd,datecmd,cl.codecli,nom,prenom,datelivr,SUM(pu*qtecmd) as montant FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecli='$codecli' AND c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.etat =1 GROUP BY c.codecmd,cl.codecli,datecmd,nom,prenom,datelivr ORDER BY c.datelivr DESC");
      $verifl=mysql_query($reql) or die(mysql_error());
      $rowl =mysql_num_rows($verifl);
      

     ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/materialize.min.css">
	<link rel="stylesheet" href="../css/myCss.css">
	<title>scAcces</title>
</head>
<body>
<nav>
    <div class="nav-wrapper">
      <a href="user.php" class="brand-logo "><img src="../image/easystock.png" width="60px" height="60px"></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="moduleAuthentification.php?erreur=logout">Se deconnecter</a></li>
      </ul>
    </div>
</nav>

    <div style="margin-top:20px;" class="container">
        <?php include 'moduleAlert.php' ?>
        <h4  class="titre center">Page personnel</h4>
        <div class="row">
          <div style="font-size: 20px;" class="col s3 card-panel ">
            <h5 class="center">Information</h5>
            <li>code client : <strong class="right blue-text"><?php echo $_SESSION['codecli']; ?></strong></li>
            <li>Prenom : <strong class="right blue-text"><?php echo $_SESSION['login']; ?></strong></li>
            <li>Nom : <strong class="right blue-text"><?php echo $_SESSION['nom']; ?></strong></li>
            <li>NB de commande en cours : <strong class="right blue-text"><?php echo $rowc; ?></strong></li>
            <li>NB de commande livrée : <strong class="right blue-text"><?php echo $rowl; ?></strong></li>
          </div>
        </div>
        <div class="row"><br>
          <h4 class="titre center">Liste des commandes en cours...</h4><br>

          <table class="tablcom z-depth-5">
            <tbody>
              <tr>
                <th>Numero Commande</th>
                <th>Date Commande</th>
                <th>Code produit</th>
                <th>Produit</th>
                <th>Prix Unit</th>
                <th>Qte Commandée</th>
                <th>Montant</th>
                <th>Date Livraison</th>
                <th>Qte Livrée</th>
                <th>reste a livée</th>
              </tr>
      <?php while ( $recupc=mysql_fetch_assoc($verifc)) { ?>
              <tr>
                <td><?php echo $recupc['codecmd']; ?></td>
                <td style="color:#2ecc71;"><?php echo $recupc['datecmd']; ?></td>
                <td><?php echo $recupc['codeprod']; ?></td>
                <td><?php echo $recupc['designation']; ?></td>
                <td><?php echo $recupc['pu']; ?></td>
                <td style="color:#3498db;"><p><?php echo $recupc['qtecmd']; ?></p><input placeholder="quantite" name="com" type="number" class="col s6"><button class=" col s6 com btn green waves-effect">modifier</button></td>
                <td><?php echo $recupc['montant']; ?></td>
                <td style="color:#2ecc71;"><?php echo $recupc['datelivr']; ?></td>
                <td style="color:#3498db;"><?php echo $recupc['qtelivr']; ?></td>
                <td style="color:red;"><?php echo $recupc['qterestant']; ?></td>
              </tr>
    <?php } ?>
            </tbody>
          </table>
          <br>



        </div>

        <div class="row">
          <h4 class="titre center">Liste des commandes livrées</h4><br>

          <table class="tablivrok z-depth-5">
          <tbody>
            <tr>
              <th>N° commande</th>
              <th>Datecmd</th>
              <th>code client</th>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Date livraison</th>
              <th>Montant total (f cfa)</th>
              <th>voir details</th>
              <th>voir facture</th>
              <th>info</th>
            </tr>
            <?php while($recupl=mysql_fetch_assoc($verifl)) { ?>
            <tr>
              <td>N° <?php echo $recupl['codecmd']; ?></td>
                <td style="color:#2ecc71;"><?php echo $recupl['datecmd']; ?></td>
                <td><?php echo $recupl['codecli']; ?></td>
                <td><?php echo $recupl['nom']; ?></td>
                <td><?php echo $recupl['prenom']; ?></td>
                <td style="color:#2ecc71;"><?php echo $recupl['datelivr']; ?></td>
                <td style="color:#3498db;"><?php echo number_format($recupl['montant'],0,","," "); ?></td>
                <td class="detail"><a href="admin/recupCom.php?id=<?php echo $recupl['codecmd']; ?>"><img src="../image/detail.png"></a></td>
                <td><a href="facture.php?id=<?php echo $recupl['codecmd']; ?>"><img src="../image/facture.png"></a></td>
                <td><img src="../image/1.png"></td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        </div>

        <div id="modal1" class="modal">
    <div class="modal-content">
      <h4 class="titre center">Modal Header</h4><br><br>
      <table class="mod">
          <tbody>
            <tr>
              <th>Code produit</th>
              <th>Produit</th>
              <th>Prix Unitaire(f cfa)</th>
              <th>Quantite</th>
              <th>Montant (f cfa)</th>
              
            </tr>
            
          </tbody>
        </table>
    </div>
    
  </div>

<br><br>
    </div>

    <footer class="page-footer ">
          
          <div class="footer-copyright">
            <div class="container">
            © March 2017 Copyright <p class="right"> Picojazz</p>
            <div class="center"><img src="../image/easystock.png" width="60px" height="60px"></div>
            </div>
          </div>
        </footer>

      
	
    
  
	




<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/scriptUser.js"></script>


</body>
</html>