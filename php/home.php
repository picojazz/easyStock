<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php';

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/materialize.min.css">
	<link rel="stylesheet" href="../css/myCss.css">
  <link rel="icon" type="image/png" href="../image/easystock.png" />
	<title>Acceuil</title>
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
        <li class="tab "><a target="_self" class="blue-text text-darken-2 active" href="home.php">Acceuil</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="admin.php">clients</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="fournisseurs.php">fournisseurs</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="fourniture.php">fournitures</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="commandes.php">Commandes</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="produits.php">stocks</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="livraison.php">livraison</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="facturation.php">facturation</a></li>
        
      </ul>
    </div>
</nav>

    <div class="container ">
    <?php include 'moduleAlert.php' ?>
      <div class="row">
      <div style="margin-top: 60px;" class="col s6 center">
        <div class="card-panel">
          <h5 class="blue-text">Bienvenue dans EasyStock</h5>
          <p>sejbfsbfbhddgdgdfgdfgdfgdf <br>dgdfgdfgdfgdfgdfgdfgdfgdfg <br>gfrdrfgdfgdfgdfg</p>
        </div>
      </div>
      <div class="col s6 center">
      <img  src="../image/easystock.png" width="250" height="300">
      </div>
      

      </div><br><br><br><br>



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
<script src="../js/script.js"></script>

</body>
</html>