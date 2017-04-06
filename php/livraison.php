<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php';

    $reqg=sprintf("SELECT c.codecmd,datecmd,cl.codecli,nom,prenom FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.etat =0 GROUP BY c.codecli ORDER BY c.codecli DESC");
      $verifg=mysql_query($reqg) or die(mysql_error());

    if (isset($_POST['rech'])) {
      $rech=$_POST['rech'];
      $req=sprintf("SELECT c.codecmd,datecmd,cl.codecli,nom,prenom FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.etat =0 GROUP BY c.codecli ORDER BY c.codecli DESC");
      $verif=mysql_query($req) or die(mysql_error());

      $reqa="SELECT c.codecmd,datecmd,cl.codecli,nom,prenom,datelivr,SUM(pu*qtecmd) as montant FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.etat =1 AND (c.codecmd like '%$rech%' OR datecmd like '%$rech%' OR cl.codecli like '%$rech%' OR nom like '%$rech%' OR prenom like '%$rech%' OR datelivr like '%$rech%')  GROUP BY c.codecmd,cl.codecli,datecmd,nom,prenom,datelivr ORDER BY c.datelivr DESC";
      $verifa=mysql_query($reqa) or die(mysql_error());
      $nbAll=mysql_num_rows($verifa);
      $nPage = 8;
      $page = ceil($nbAll/$nPage);
      if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $page) {
       $pageActuel = $_GET['p'] ;
      }else{
        $pageActuel = 1 ;
      }

      $reql="SELECT c.codecmd,datecmd,cl.codecli,nom,prenom,datelivr,SUM(pu*qtecmd) as montant FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.etat =1 AND (c.codecmd like '%$rech%' OR datecmd like '%$rech%' OR cl.codecli like '%$rech%' OR nom like '%$rech%' OR prenom like '%$rech%' OR datelivr like '%$rech%') GROUP BY c.codecmd,cl.codecli,datecmd,nom,prenom,datelivr ORDER BY c.datelivr DESC LIMIT ".(($pageActuel - 1)*$nPage).",$nPage";
      $verifl=mysql_query($reql) or die(mysql_error());


    }else{

    $req=sprintf("SELECT c.codecmd,datecmd,cl.codecli,nom,prenom FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.etat =0 GROUP BY c.codecli ORDER BY c.codecli DESC");
      $verif=mysql_query($req) or die(mysql_error());

      $reqa=sprintf("SELECT c.codecmd,datecmd,cl.codecli,nom,prenom,datelivr,SUM(pu*qtecmd) as montant FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.etat =1 GROUP BY c.codecmd,cl.codecli,datecmd,nom,prenom,datelivr ORDER BY c.datelivr DESC");
      $verifa=mysql_query($reqa) or die(mysql_error());
      $nbAll=mysql_num_rows($verifa);
      $nPage = 8;
      $page = ceil($nbAll/$nPage);
      if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $page) {
       $pageActuel = $_GET['p'] ;
      }else{
        $pageActuel = 1 ;
      }

      $reql=sprintf("SELECT c.codecmd,datecmd,cl.codecli,nom,prenom,datelivr,SUM(pu*qtecmd) as montant FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.etat =1 GROUP BY c.codecmd,cl.codecli,datecmd,nom,prenom,datelivr ORDER BY c.datelivr DESC LIMIT ".(($pageActuel - 1)*$nPage).",$nPage");
      $verifl=mysql_query($reql) or die(mysql_error());
      
      }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/materialize.min.css">
	<link rel="stylesheet" href="../css/myCss.css">
  <link rel="stylesheet" href="../css/awesomplete.css">
  <link rel="icon" type="image/png" href="../image/easystock.png" />
	<title>Gestions des livraisons</title>
</head>
<body>
<nav class="nav-extended ">
    <div class="nav-wrapper ">
      <a href="home.php" class="brand-logo "><img src="../image/easystock.png" width="60px" height="60px"></a>

      <ul id="nav-mobile" class="right">
      <li><a href="aide.php"><img  src="../image/aide.png" alt=""></a></li>
        <li><a href="moduleAuthentification.php?erreur=logout">Se deconnecter</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul  class="tabs  tabs-fixed-width">
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="home.php">Acceuil</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="admin.php">clients</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="fournisseurs.php">fournisseurs</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="fourniture.php">fournitures</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="commandes.php">Commandes</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="produits.php">stocks</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 active" href="livraison.php">livraison</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="facturation.php">facturation</a></li>
        
      </ul>
    </div>
</nav>

    <div class="container ">
      <h3 class="center titre">Gestions des livraisons</h3>
      <div class="row">
      <div class="col s3">
        <div class="card-panel z-depth-5">
        <form method="post" action="" class="livr">

          <input  class="awesomplete" list="mylist" type="text" placeholder="ou saisir le client" name="des" id="desi"><p>ou</p>
          <div class="input-field ">
                  
                  <select name="cli" id="selectprod">
                    <option value="" disabled selected>selectionner un client</option>
                    <?php while ($recup=mysql_fetch_assoc($verif)) { ?>
              <option value="<?php echo $recup['codecli']; ?>"><?php echo $recup['prenom'].'  '.$recup['nom']; ?></option>
              <?php } ?>
                  </select>
                  <label for="">Choix client</label>
          </div>
          <button type="submit" class=" btn waves-effect blue">Valider</button>

        </div>
        </form>
      </div>
      <div class="tabLivr col s9 ">

      </div><br><br>

      </div>

      <h3 class="center titre">Liste de commande(s) livrée(s)</h3><br>

  <nav style="width:60%;margin:0 auto;" >
    <div class="nav-wrapper">
      <form method="post" action="livraison.php">
        <div class="input-field">
          <input id="search" type="search" name="rech">
          <label class="label-icon" for="search"><i class="material-icons"><img src='../image/rech.png' height="32" width="32"></i></label>
          <i class="material-icons">&times</i>
        </div>
      </form>
    </div>
  </nav>
  <br>
    <div class="center">
    <a href="livraison.php"  ><img src="../image/refresh.png"></a>
    </div>
  <br>
    

        
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
        <br><br>

        

  <!-- Modal Structure -->
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

    </div>
        
      <ul class="pagination center">

        <?php for ($i=1; $i<=$page ; $i++) {  ?>
      <?php if ($i == $pageActuel){ ?>
        <li class="active"><a href="livraison.php?p=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php }else{ ?>
    
    <li class="waves-effect"><a href="livraison.php?p=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php } ?>

        <?php } ?>
      </ul>
      <br>

      
	
    <footer class="page-footer ">
          
          <div class="footer-copyright">
            <div class="container">
            © March 2017 Copyright <p class="right"> Picojazz</p>
            <div class="center"><img src="../image/easystock.png" width="60px" height="60px"></div>
            </div>
          </div>
        </footer>
  
	 <datalist id="mylist" style="display:none">
            <?php while ( $recupg=mysql_fetch_assoc($verifg)) { ?>
            <option><?php echo $recupg['prenom'].'  '.$recupg['nom']; ?></option>
            <?php } ?>
          </datalist>




<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/scriptLivr.js"></script>
<script src="../js/awesomplete.js"></script>


</body>
</html>