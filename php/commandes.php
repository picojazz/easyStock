<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php';

      $req="SELECT codecli,prenom,nom FROM client ORDER BY codecli DESC ";
      $verif=mysql_query($req);

      $reqp="SELECT codeprod,designation,qte FROM produit ORDER BY codeprod DESC ";
      $verifp=mysql_query($reqp);




 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link rel="stylesheet" href="../css/myCss.css">
  <link rel="stylesheet" type="text/css" media="print" href="../css/print.css" />
  <title>scAcces</title>
</head>
<body>
<nav class="nav-extended ">
    <div class="nav-wrapper ">
      <a href="#" class="brand-logo center">Admin</a>
      <ul id="nav-mobile" class="right ">
        <li><a href="moduleAuthentification.php?erreur=logout">Se deconnecter</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul  class="tabs  tabs-fixed-width">
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
        <div class="card-panel col s5 ">
          <h5 class=" center">commande</h5>
        
          
          <div class="input-field ">
            <select>
              <option value="" disabled selected>selectionner un client</option>
              <?php while ($recup=mysql_fetch_assoc($verif)) { ?>
              <option value="<?php echo $recup['codecli']; ?>"><?php echo $recup['prenom'].' '.$recup['nom'].' code client :'.$recup['codecli']; ?></option>
              <?php } ?>
            </select>
            <label>Client</label>
          </div>

          <div class="input-field ">
            <select>
              <option value="" disabled selected>selectionner un produit</option>
              <?php while ($recupp=mysql_fetch_assoc($verifp)) { ?>
              <option value="<?php echo $recupp['codeprod']; ?>"><?php echo $recupp['designation']; ?></option>
              <?php } ?>
            </select>
            <label>Produit</label>
          </div>
          <div class="input-field ">
          <input placeholder="quantite a commander"  type="text" >
          <label >Quantite</label>
        </div>

        <button class="btn blue waves-effect">Ajouter au panier</button>
        
          
        

          <br><br>
        </div>

        <div class="card-panel col s6 offset-s1">
          <h5 class=" center">Panier</h5>
          
          <table>
            <tbody>
              <tr>
                <th>Designation</th>
                <th>Qte</th>
                <th>PU</th>
                <th>total</th>
                <th>supprimer</th>
              </tr>
    
            </tbody>
          </table>

        </div>


      </div>

        <div class="row">
          <h4 class="titre center">Liste des Commandes</h4>

          <table >
            <tbody>
              <tr>
                <th>Code Commande</th>
                <th>Date Commaande</th>
                <th>Etat</th>
                <th>modifier</th>
                <th>supprimer</th>
              </tr>
              <tr>
                <td>azert</td>
                <td>fdfds</td>
                <td>dfdsfg</td>
                <td>sfdsf</td>
                <td>dgfdg</td>
              </tr>
    
            </tbody>
          </table>

        </div>

    </div>

      
  

  
  




<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/scriptProd.js"></script>

</body>
</html>