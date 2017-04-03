<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php';

    $reqp="SELECT codeprod,designation,qte FROM produit ORDER BY codeprod DESC ";
    $verifp=mysql_query($reqp);

    $reqt="SELECT datefournt,designation,qteav,qtefr,pu,pu*qtefr as montant  FROM fourniture f,prodfournt pf,produit p WHERE f.codefournt=pf.codefournt AND pf.codeprod=p.codeprod ORDER BY f.codefournt DESC ";
    $verift=mysql_query($reqt)or die(mysql_error());
    $nbAll=mysql_num_rows($verift);
      $nPage = 10;
      $page = ceil($nbAll/$nPage);
      if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $page) {
       $pageActuel = $_GET['p'] ;
      }else{
        $pageActuel = 1 ;
      }

      $reqc="SELECT datefournt,designation,qteav,qtefr,pu,pu*qtefr as montant  FROM fourniture f,prodfournt pf,produit p WHERE f.codefournt=pf.codefournt AND pf.codeprod=p.codeprod ORDER BY f.codefournt DESC LIMIT ".(($pageActuel - 1)*$nPage).",$nPage";
      $verifc=mysql_query($reqc)or die(mysql_error());

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/materialize.min.css">
	<link rel="stylesheet" href="../css/myCss.css">
  <link rel="icon" type="image/png" href="../image/easystock.png" />
	<title>Gestions de fournitures</title>
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
        <li class="tab "><a target="_self" class="blue-text text-darken-2 active" href="fourniture.php">fournitures</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="commandes.php">Commandes</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="produits.php">stocks</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="livraison.php">livraison</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="facturation.php">facturation</a></li>
        
      </ul>
    </div>
</nav>

    <div class="container center">
      <div class="row">
        <h3 class="center titre">Mise a jour du Stock</h3>
        <div class="card-panel col s4 center com z-depth-5">
          <h5 class=" center">Produits</h5>
        
          <form method="post" action="" class="ajoutPanier">

          <div class="input-field ">
            <select name='prod' required class="validate">
              <option value="1" disabled selected>selectionner un produit</option>
              <?php while ($recupp=mysql_fetch_assoc($verifp)) { ?>
              <option value="<?php echo $recupp['codeprod']; ?>"><?php echo $recupp['designation']; ?></option>
              <?php } ?>
            </select>
            <label>Produit</label>
          </div>
          <div class="input-field qtecmdd">
          <input placeholder="quantite a fournir"  type="text" name="qtecmd" required>
            
          </div>
          

        <button type="submit" class=" btn blue waves-effect">Ajouter </button>
        </form>
          
        

          <br>        </div>

        <div class="card-panel col s7 offset-s1 center  z-depth-5">
          <h5 class=" center">suivi des fournitures</h5>
          
          <table class="panier" style="overflow: hidden;">
            <tbody>
              <tr>
                <th>code Produit</th>
                <th>Designation</th>
                <th>Qte avant fournitures</th>
                <th>Qte fournie</th>
                <th>PU (fcfa)</th>
                <th>total (fcfa)</th>
                <th>supprimer</th>
              </tr>
    
            </tbody>
          </table>
 
          <h5 class="total blue white-text center">TOTAL : 0 F CFA</h5><br>
          

          <br>

          
          
          <button   class="cmd btn waves-effect blue ">Enregistrer</button>
          
          <br><br>

        </div>


      </div>
      <div class="row">
          <h4 class="titre center">Liste des fournitures</h4>
          

      </div>


      <table class="z-depth-5">
            <tbody>
              <tr>
                <th>Date fourniture</th>
                <th>Produit</th>
                <th>Quantite avant fourniture</th>
                <th>Quantite fournie</th>
                <th>P.U (fcfa)</th>
                <th>Montant de la fourniture (fcfa)</th>
                
              </tr>
      <?php while ( $recupc=mysql_fetch_assoc($verifc)) { ?>
              <tr>
                <td style="color:#2ecc71;"><?php echo $recupc['datefournt']; ?></td>
                <td ><?php echo $recupc['designation']; ?></td>
                <td><?php echo $recupc['qteav']; ?></td>
                <td style="color:#3498db;"><?php echo $recupc['qtefr']; ?></td>
                <td><?php echo $recupc['pu']; ?></td>
                <td><?php echo $recupc['montant']; ?></td>
              </tr>
    <?php } ?>
            </tbody>
          </table>
          <br>
            <ul class="pagination center">

        <?php for ($i=1; $i<=$page ; $i++) {  ?>
      <?php if ($i == $pageActuel){ ?>
        <li class="active"><a href="commandes.php?p=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php }else{ ?>
    
    <li class="waves-effect"><a href="commandes.php?p=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php } ?>

        <?php } ?>
      </ul>
      <br>

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
<script src="../js/scriptFourtn.js"></script>

</body>
</html>