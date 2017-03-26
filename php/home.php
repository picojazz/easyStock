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
        <li><a href="moduleAuthentification.php?erreur=logout">Se deconnecter</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul  class="tabs  tabs-fixed-width">
        <li class="tab "><a target="_self" class="blue-text text-darken-2 active" href="home.php">Acceuil</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="admin.php">clients</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="fournisseurs.php">fournisseurs</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="commandes.php">Commandes</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="produits.php">stocks</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="livraison.php">livraison</a></li>
        <li class="tab "><a target="_self" class="blue-text text-darken-2" href="facturation.php">facturation</a></li>
        
      </ul>
    </div>
</nav>

    <div class="container center">
      <div class="row">

      <img src="../image/easystock.png">

      <p>gdfgfdhgdfngnd,fvn,dfnvn,cxnv,;cnxvnxcnvbdjgdfkjgkdfjgdjfklgjdklgkdgdd <br>gfdgdfgdfgdfgdfgdfg gdfghdfg dfgjdfgjkdjgl gdgjkdfjgkdjg dfgjdfkgjkldfjg <br>dlfkdgksgk kgljsdfgj gjigsdg gjizjizkengdgizojgk hizjkzekfodiszrer <br>ortgoerkgjdkgjdkfgkvndfnd jgdogozg,ezrgnifjgkdflgdfgkoer <br>bjbdsfsdfhlsdj gjsjgsfjgkj g skfgjkjsfg fgfjgkfd g <br>jjfkgkd jfdgjkldfjgkjdfk gfjdkjdgdfjg fd <br>hdhfhsdgjkdnfbnjdfjn <br>hfdhfhjdhjjhfjhhjklhsdf jshdfhfsd</p>

      </div>



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