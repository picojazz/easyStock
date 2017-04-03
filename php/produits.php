<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php';

    $reqf="SELECT codefour,nom,prenom FROM fournisseur ";
      $veriff=mysql_query($reqf);

    $reqm="SELECT codeprod FROM produit ";
      $verifm=mysql_query($reqm);
      $nbAll=mysql_num_rows($verifm);
      $nPage = 8;
      $page = ceil($nbAll/$nPage);
      //print_r($nbAll);
      //die();

      if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $page) {
       $pageActuel = $_GET['p'] ;
      }else{
        $pageActuel = 1 ;
      }


    if (isset($_POST['rech'])) {
      $rech=$_POST['rech'];
      $req="SELECT * FROM produit WHERE designation like '%$rech%' OR pu like '%$rech%' OR qte like '%$rech%' ";
      $verif=mysql_query($req);
    }else{
      $req="SELECT codeprod,designation,pu,qte,nom,prenom FROM produit,fournisseur f WHERE produit.codefour=f.codefour  ORDER BY codeprod DESC LIMIT ".(($pageActuel - 1)*$nPage).",$nPage";
      $verif=mysql_query($req) or die(mysql_error());
      }
      $req1="SELECT * FROM produit  ";
      $verif1=mysql_query($req1);
      $total=0;
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link rel="stylesheet" href="../css/myCss.css">
  <link rel="stylesheet" type="text/css" media="print" href="../css/print.css" />
  <link rel="icon" type="image/png" href="../image/easystock.png" />
  <title>Gestion des produits</title>
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
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="fourniture.php">fournitures</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="commandes.php">Commandes</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 active" href="produits.php">stocks</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="livraison.php">livraison</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="facturation.php">facturation</a></li>
        
      </ul>
    </div>
</nav>



  <div id="modal2" class="imp modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="titre center">Inventaire des produits</h4>
      <div class="row">
        <table class="prod">
          <tbody>
            <tr>
              <th>Code Produit</th>
              <th>Designation</th>
              <th>Prix Unitaire</th>
              <th>Quantite</th>
              <th>Total</th>
            </tr>
           
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
    <h5 class="tot left">  </h5>
      <a href="inventaire.php" class="imprimer modal-action modal-close waves-effect white-text waves-green btn-flat blue ">Imprimer</a>
    </div>
  </div>




    <div class="container">
        <?php include 'moduleAlert.php' ?>
      <div class="row">
        

<div class="row">
<h3 class="center titre">Ajout de produit</h3>
<div class="card-panel col s6 offset-s3 z-depth-5">
  
  <div class="row">
    <form method="post" class="col s12" id="formCli" action="#">
      <div class="row">
        <div class="input-field col s6">
          <input   type="text"  name="designation" >
          <label >Designation</label>
        </div>
        <div class="input-field col s6">
          <input type="text"  name="pu" >
          <label >Prix Unitaire</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text"  name="qte" >
          <label>Quantite</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <select name="four" id="" required>
          
      <?php while ($recupf = mysql_fetch_assoc($veriff)) { ?>
          <option value="<?php echo $recupf['codefour']; ?>"><?php echo $recupf['prenom'].' '.$recupf['nom']; ?></option>
      <?php } ?>
          </select>
          <label>fournisseur</label>
        </div>
      </div>
      <button class="btn blue"  type="submit" id="addCli">Ajouter</button>
      
    </form>
  </div>        
</div>
</div>

 <div class="row">
    <h3 class="center titre">Liste des produits</h3>
    <div class=" col s6 offset-s3">

  <nav>
    <div class="nav-wrapper">
      <form method="post">
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
    <a href="produits.php"  ><img src="../image/refresh.png"></a>
    </div><br>
    </div>
    <div class=" col s6 offset-s3 center">

      <a class="mo modal-trigger waves-effect waves-light btn blue" href="#modal2">Inventaire des produits</a>

  
  <br><br>
</div>


    <table class="clientTable z-depth-5">
  <tbody>
    <tr>
      <th>Designation</th>
      <th>Prix Unitaire</th>
      <th>quantite</th>
      <th>fournisseur</th>
      <th>modifier</th>
      <th>supprimer</th>
      
    </tr>
    <?php while ($recup=mysql_fetch_array($verif)) { ?>
    <tr>
       <td><?php echo $recup['designation']; ?></td>
       <td style="color:#3498db;"><?php echo $recup['pu']; ?></td>
       <td><?php echo $recup['qte']; ?></td>
       <td><?php echo $recup['prenom'].' '.$recup['nom']; ?></td>
       <td class="modif"><a href="admin/modifProd.php?id=<?php echo $recup['codeprod']; ?>"><img src='../image/modif.png'></a></td>
     <td class="supp"><a href="admin/suppProd.php?id=<?php echo $recup['codeprod']; ?>"><img src="../image/supp.png"></a></td>
    </tr>
    <?php } ?>
  </tbody>
  </table>
  </div>



  <div id="modal1" class="mod modal modal-fixed-footer">
  <form method="post" id="formModif"  action="#">
    <div class="modal-content">
      <h4 class="center titre">Modifier un produit</h4>
    
      <div class="row">
        <div class=" col s6">
          <label >Designation</label>
          <input   type="text"  name="designation" >
        </div>
        <div class=" col s6">
          <label >Prix Unitaire </label>
          <input type="text"  name="pu" >
        </div>
      </div>
      <div class="row">
        <div class=" col s12">
          <label>Quantite</label>
          <input type="text"  name="qte" >
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <button  type="submit" class="white-text btn blue  waves-effect waves-white butModif ">modifier</button>
    </div>
    </form>
  </div>

      </div>

      <ul class="pagination center">

<?php for ($i=1; $i<=$page ; $i++) {  ?>
      <?php if ($i == $pageActuel){ ?>
        <li class="active"><a href="produits.php?p=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php }else{ ?>
    
    <li class="waves-effect"><a href="produits.php?p=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php } ?>

<?php } ?>
      </ul>

    </div>

      
  
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
<script src="../js/scriptProd.js"></script>

</body>
</html>