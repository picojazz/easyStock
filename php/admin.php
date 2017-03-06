<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php'; ?>
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
        <li class="tab "><a class="blue-text text-darken-2" href="#clients">clients</a></li>
        <li class="tab "><a class="blue-text text-darken-2" href="#fournisseurs">fournisseurs</a></li>
        <li class="tab "><a class="blue-text text-darken-2" href="#commandes">Commandes</a></li>
        <li class="tab "><a class="blue-text text-darken-2" href="#stocks">stocks</a></li>
        <li class="tab "><a class="blue-text text-darken-2" href="#livraison">livraison</a></li>
        <li class="tab "><a class="blue-text text-darken-2" href="#facturation">facturation</a></li>
        
      </ul>
    </div>
</nav>

    <div class="container">
        <?php include 'moduleAlert.php' ?>
      <div class="row">

        <div id="clients" class="col s12"><?php include 'admin/clients.php'; ?></div>
        <div id="fournisseurs" class="col s12">fournisseur</div>
        <div id="commandes" class="col s12">commande</div>
        <div id="stocks" class="col s12">stocks</div>
        <div id="livraison" class="col s12">livraison</div>
        <div id="facturation" class="col s12">facturation</div>
      </div>

    </div>

      
	
    
  
	




<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/script.js"></script>

</body>
</html>