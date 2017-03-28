<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php';

      $reqm="SELECT codefour FROM fournisseur ";
      $verifm=mysql_query($reqm);
      $nbAll=mysql_num_rows($verifm);
      $nPage = 8;
      $page = ceil($nbAll/$nPage);

      if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $page) {
       $pageActuel = $_GET['p'] ;
      }else{
        $pageActuel = 1 ;
      }


    if (isset($_POST['rech'])) {
      $rech=$_POST['rech'];
      $req="SELECT * FROM fournisseur WHERE prenom like '%$rech%' OR nom like '%$rech%' OR tel like '%$rech%' OR adresse like '%$rech%'";
      $verif=mysql_query($req);
    }else{
      $req="SELECT * FROM fournisseur ORDER BY codefour DESC LIMIT ".(($pageActuel - 1)*$nPage).",$nPage ";
      $verif=mysql_query($req);
      }
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link rel="stylesheet" href="../css/myCss.css">
  <link rel="icon" type="image/png" href="../image/easystock.png" />
  <title>Gestion des fournisseurs</title>
</head>
<body>
<nav class="nav-extended ">
    <div class="nav-wrapper ">
      <a href="home.php" class="brand-logo "><img src="../image/easystock.png" width="60px" height="60px"></a>
      <ul id="nav-mobile" class="right">
        <li><a href="moduleAuthentification.php?erreur=logout">Se deconnecter</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul  class="tabs  tabs-fixed-width">
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="home.php">Acceuil</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="admin.php">clients</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 active" href="fournisseurs.php">fournisseurs</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="commandes.php">Commandes</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="produits.php">stocks</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="livraison.php">livraison</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="facturation.php">facturation</a></li>
        
      </ul>
    </div>
</nav>

    <div class="container">
        <?php include 'moduleAlert.php' ?>
      <div class="row">
        

<div class="row">
<h3 class="center titre">Ajout de fournisseur</h3>
<div class="card-panel col s6 offset-s3 z-depth-5">
  
  <div class="row">
    <form method="post" class="col s12" id="formCli" action="#">
      <div class="row">
        <div class="input-field col s6">
          <input   type="text"  name="prenom" >
          <label >Prenom</label>
        </div>
        <div class="input-field col s6">
          <input type="text"  name="nom" >
          <label >Nom</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text"  name="adresse" >
          <label>Adresse</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input  type="text"  name="tel" >
          <label >telephone</label>
        </div>
      </div>
      <button class="btn blue"  type="submit" id="addCli">Ajouter</button>
      
    </form>
  </div>        
</div>
</div>

 <div class="row">
    <h3 class="center titre">Liste des fournisseurs</h3>
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
  <br><br>
    </div>
    <table class="clientTable z-depth-5">
  <tbody>
    <tr>
      <th>Prenom</th>
      <th>Nom</th>
      <th>Telephone</th>
      <th>Adresse</th>
      <th>modifier</th>
      <th>supprimer</th>
      
    </tr>
    <?php while ($recup=mysql_fetch_array($verif)) { ?>
    <tr>
       <td><?php echo $recup['prenom']; ?></td>
       <td><?php echo $recup['nom']; ?></td>
       <td style="color:#3498db;"><?php echo $recup['tel']; ?></td>
       <td><?php echo $recup['adresse']; ?></td>
       <td class="modif"><a href="admin/modifFour.php?id=<?php echo $recup['codefour']; ?>"><img src='../image/modif.png'></a></td>
     <td class="supp"><a href="admin/suppFour.php?id=<?php echo $recup['codefour']; ?>"><img src="../image/supp.png"></a></td>
    </tr>
    <?php } ?>
  </tbody>
  </table>
  </div>



  <div id="modal1" class="modal modal-fixed-footer">
  <form method="post" id="formModif"  action="#">
    <div class="modal-content">
      <h4 class="center titre">Modifier un fournisseur</h4>
    
      <div class="row">
        <div class=" col s6">
          <label >Prenom</label>
          <input   type="text"  name="prenom" >
        </div>
        <div class=" col s6">
          <label >Nom</label>
          <input type="text"  name="nom" >
        </div>
      </div>
      <div class="row">
        <div class=" col s12">
          <label>Adresse</label>
          <input type="text"  name="adresse" >
        </div>
      </div>
      <div class="row">
        <div class=" col s12">
          <label >telephone</label>
          <input  type="text"  name="tel" >
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
        <li class="active"><a href="fournisseurs.php?p=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php }else{ ?>
    
    <li class="waves-effect"><a href="fournisseurs.php?p=<?php echo $i ?>"><?php echo $i ?></a></li>
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
<script src="../js/scriptfour.js"></script>

</body>
</html>