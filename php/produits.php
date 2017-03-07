<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php';
      $req="SELECT * FROM produit ORDER BY codeprod DESC ";
      $verif=mysql_query($req);
      
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
<nav class="nav-extended ">
    <div class="nav-wrapper ">
      <a href="#" class="brand-logo center">Admin</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="moduleAuthentification.php?erreur=logout">Se deconnecter</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul  class="tabs  tabs-fixed-width">
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="admin.php">clients</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="fournisseurs.php">fournisseurs</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="commande.php">Commandes</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 active" href="produits.php">stocks</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="livraison.php">livraison</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="facturation.php">facturation</a></li>
        
      </ul>
    </div>
</nav>

    <div class="container">
        <?php include 'moduleAlert.php' ?>
      <div class="row">
        

<div class="row">
<h3 class="center titre">Ajout de produit</h3>
<div class="card-panel col s6 offset-s3">
  
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
      <button class="btn blue"  type="submit" id="addCli">Ajouter</button>
      
    </form>
  </div>        
</div>
</div>

 <div class="row">
    <h3 class="center titre">Liste des produits</h3>
    <table class="clientTable">
  <tbody>
    <tr>
      <th>Designation</th>
      <th>Prix Unitaire</th>
      <th>quantite</th>
      <th>modifier</th>
      <th>supprimer</th>
      
    </tr>
    <?php while ($recup=mysql_fetch_array($verif)) { ?>
    <tr>
       <td><?php echo $recup['designation']; ?></td>
       <td><?php echo $recup['pu']; ?></td>
       <td><?php echo $recup['qte']; ?></td>
       <td class="modif"><a href="admin/modifProd.php?id=<?php echo $recup['codeprod']; ?>"><img src='../image/modif.png'></a></td>
     <td class="supp"><a href="admin/suppProd.php?id=<?php echo $recup['codeprod']; ?>"><img src="../image/supp.png"></a></td>
    </tr>
    <?php } ?>
  </tbody>
  </table>
  </div>



  <div id="modal1" class="modal modal-fixed-footer">
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

    </div>

      
  
    
  
  




<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/scriptProd.js"></script>

</body>
</html>