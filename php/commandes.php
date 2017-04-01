<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php';

      $req="SELECT codecli,prenom,nom FROM client ORDER BY codecli DESC ";
      $verif=mysql_query($req);

      $reqp="SELECT codeprod,designation,qte FROM produit ORDER BY codeprod DESC ";
      $verifp=mysql_query($reqp);

      $reqt=sprintf("SELECT c.codecmd,datecmd,cl.codecli,nom,prenom,designation,pu,qtecmd,pu*qtecmd as montant,datelivr,qtelivr,qtecmd-qtelivr as qterestant,cp.etat FROM commande c,client cl,cmdprod cp,produit p WHERE cp.etat = 0 AND c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod   ORDER BY c.codecmd DESC");
      $verift=mysql_query($reqt) or die(mysql_error());

      $nbAll=mysql_num_rows($verift);
      $nPage = 10;
      $page = ceil($nbAll/$nPage);
      if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $page) {
       $pageActuel = $_GET['p'] ;
      }else{
        $pageActuel = 1 ;
      }

      $reqc=sprintf("SELECT c.codecmd,datecmd,cl.codecli,nom,prenom,designation,pu,qtecmd,pu*qtecmd as montant,datelivr,qtelivr,qtecmd-qtelivr as qterestant FROM commande c,client cl,cmdprod cp,produit p WHERE cp.etat = 0 AND c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod ORDER BY c.codecmd DESC LIMIT ".(($pageActuel - 1)*$nPage).",$nPage");
      $verifc=mysql_query($reqc) or die(mysql_error());

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link rel="stylesheet" href="../css/myCss.css">
  <link rel="stylesheet" type="text/css" media="print" href="../css/print.css" />
  <link rel="icon" type="image/png" href="../image/easystock.png" />
  <title>Gestion des commandes</title>
</head>
<body>
<nav class="nav-extended ">
    <div class="nav-wrapper ">
      <a href="home.php" class="brand-logo "><img src="../image/easystock.png" width="60px" height="60px"></a>
      <ul id="nav-mobile" class="right ">
      <li><a href="aide.php"><img  src="../image/aide.png" alt=""></a></li>
        <li><a href="moduleAuthentification.php?erreur=logout">Se deconnecter</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul  class="tabs  tabs-fixed-width">
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="home.php">Acceuil</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="admin.php">clients</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="fournisseurs.php">fournisseurs</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 active" href="commandes.php">Commandes</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="produits.php">stocks</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="livraison.php">livraison</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="facturation.php">facturation</a></li>
        
      </ul>
    </div>
</nav>



  



    <div class="container">
        <?php include 'moduleAlert.php' ?>
      <div class="row">
        <h3 class="center titre">Gestion des commandes</h3>
        <div class="card-panel col s4 center com z-depth-5">
          <h5 class=" center">commande</h5>
        
          <form method="post" action="" class="ajoutPanier">

          <div class="input-field ">
            <select name='prod' required class="validate">
              <option value="1" disabled selected>selectionner un produit</option>
              <?php while ($recupp=mysql_fetch_assoc($verifp)) { ?>
              <option value="<?php echo $recupp['codeprod']; ?>"><?php echo $recupp['designation'].'  quantite : '.$recupp['qte']; ?></option>
              <?php } ?>
            </select>
            <label>Produit</label>
          </div>
          <div class="input-field qtecmdd">
          <input placeholder="quantite a commander"  type="text" name="qtecmd" required>
            
          </div>
          

        <button type="submit" class=" btn blue waves-effect">Ajouter au panier</button>
        </form>
          
        

          <br>        </div>

        <div class="card-panel col s7 offset-s1 center  z-depth-5">
          <h5 class=" center">Panier</h5>
          
          <table class="panier" style="overflow: hidden;">
            <tbody>
              <tr>
                <th>code Produit</th>
                <th>Designation</th>
                <th>Qte</th>
                <th>PU</th>
                <th>total</th>
                <th>supprimer</th>
              </tr>
    
            </tbody>
          </table>
 
          <h5 class="total blue white-text center">TOTAL : 0 F CFA</h5><br>
          

          <div class="input-field col s7 ">
            <select  required>
              <option value="" disabled selected>selectionner un client</option>
              <?php while ($recup=mysql_fetch_assoc($verif)) { ?>
              <option value="<?php echo $recup['codecli']; ?>"><?php echo $recup['prenom'].' '.$recup['nom'].' code client :'.$recup['codecli']; ?></option>
              <?php } ?>
            </select>
            <label>Client</label>
          </div><br>
          <div class=" col s7 ">
            <label class="left">Date de livraison</label>
            <input type="date" class="datepicker" name="date">
            
          </div><br><br>

          
          
          <button   class="cmd btn waves-effect blue ">commander</button>
          
          <br><br>

        </div>


      </div>

        <div class="row">
          <h4 class="titre center">Liste des Commandes en cours ...</h4>
          
          
          

        </div>

    </div>

      <table class="z-depth-5">
            <tbody>
              <tr>
                <th>Numero Commande</th>
                <th>Date Commande</th>
                <th>code client</th>
                <th>Nom</th>
                <th>Prenom</th>
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
                <td>N° <?php echo $recupc['codecmd']; ?></td>
                <td style="color:#2ecc71;"><?php echo $recupc['datecmd']; ?></td>
                <td><?php echo $recupc['codecli']; ?></td>
                <td><?php echo $recupc['nom']; ?></td>
                <td><?php echo $recupc['prenom']; ?></td>
                <td><?php echo $recupc['designation']; ?></td>
                <td><?php echo $recupc['pu']; ?></td>
                <td style="color:#3498db;"><?php echo $recupc['qtecmd']; ?></td>
                <td><?php echo $recupc['montant']; ?></td>
                <td style="color:#2ecc71;"><?php echo $recupc['datelivr']; ?></td>
                <td style="color:#3498db;"><?php echo $recupc['qtelivr']; ?></td>
                <td style="color:red;"><?php echo $recupc['qterestant']; ?></td>
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

        <footer class="page-footer">
          
          <div class="footer-copyright">
            <div class="container">
            © March 2017 Copyright <p class="right"> Picojazz</p>
            <div class="center"><img src="../image/easystock.png" width="60px" height="60px"></div>
            </div>
          </div>
        </footer>

  
  




<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/scriptCom.js"></script>

</body>
</html>