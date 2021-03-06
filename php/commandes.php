<?php 
    include 'moduleTestUser.php';
    include 'moduleConnexion.php'; 

      $req="SELECT codecli,prenom,nom FROM client ORDER BY codecli DESC ";
      $verif=mysql_query($req);
      $reqr="SELECT codecli,prenom,nom FROM client ORDER BY codecli DESC ";
      $verifr=mysql_query($reqr);
      $reql="SELECT codeprod,designation,qte FROM produit ORDER BY codeprod DESC ";
    $verifl=mysql_query($reql);

      $reqp="SELECT codeprod,designation,qte FROM produit ORDER BY codeprod DESC ";
      $verifp=mysql_query($reqp);

      $reqt=sprintf("SELECT c.codecmd,datecmd,cl.codecli,nom,prenom,designation,pu,qtecmd,pu*qtecmd as montant,datelivr,qtelivr,qtecmd-qtelivr as qterestant,cp.etat FROM commande c,client cl,cmdprod cp,produit p WHERE cp.etat = 0 AND c.datelivr != '0000-00-00' AND c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod   ORDER BY c.codecmd DESC");
      $verift=mysql_query($reqt) or die(mysql_error());

      $nbAll=mysql_num_rows($verift);
      $nPage = 10;
      $page = ceil($nbAll/$nPage);
      if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $page) {
       $pageActuel = $_GET['p'] ;
      }else{
        $pageActuel = 1 ;
      }

      $reqc=sprintf("SELECT c.codecmd,datecmd,cl.codecli,nom,prenom,designation,pu,qtecmd,pu*qtecmd as montant,datelivr,qtelivr,qtecmd-qtelivr as qterestant FROM commande c,client cl,cmdprod cp,produit p WHERE cp.etat = 0 AND c.datelivr != '0000-00-00' AND c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod ORDER BY c.codecmd DESC LIMIT ".(($pageActuel - 1)*$nPage).",$nPage");
      $verifc=mysql_query($reqc) or die(mysql_error());


      $reqv="SELECT c.codecmd,datecmd,cl.codecli,nom,prenom,datelivr,SUM(pu*qtecmd) as montant FROM commande c,client cl,cmdprod cp,produit p WHERE c.codecmd=cp.codecmd AND c.codecli=cl.codecli AND cp.codeprod=p.codeprod AND c.etat =0 AND c.datelivr='0000-00-00'  GROUP BY c.codecmd,cl.codecli,datecmd,nom,prenom,datelivr ORDER BY c.datelivr DESC  ";
      $verifv=mysql_query($reqv) or die(mysql_error());

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link rel="stylesheet" href="../css/myCss.css">
  <link rel="stylesheet" href="../css/awesomplete.css">
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
        <li class="tab "><a target="_self" class="blue-text text-darken-2 " href="fourniture.php">fournitures</a></li>
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
            <select name='prod'  class="validate" id="selectprod">
              <option value="1" disabled selected>selectionner un produit</option>
              <?php while ($recupp=mysql_fetch_assoc($verifp)) { ?>
              <option value="<?php echo $recupp['codeprod']; ?>"><?php echo $recupp['designation'].'  quantite : '.$recupp['qte']; ?></option>
              <?php } ?>
            </select>
            <label>Produit</label>
          </div><p>ou</p>
          <input  class="awesomplete" list="mylist" type="text" placeholder="ou saisir la designation" name="des" id="desi">
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
            <select id="selectcli"  required>
              <option value="" disabled selected>selectionner un client</option>
              <?php while ($recup=mysql_fetch_assoc($verif)) { ?>
              <option value="<?php echo $recup['codecli']; ?>"><?php echo $recup['prenom'].' '.$recup['nom'].' code client :'.$recup['codecli']; ?></option>
              <?php } ?>
            </select>
            <label>Client</label>
          </div>
          <div class="col s7">
          <p>ou</p>
          <input  class="awesomplete" list="mylist1" type="text" placeholder="ou saisir le client" name="des" id="cli"></div>
          <div class=" col s7 ">
            <label class="left">Date de livraison</label>
            <input type="date" class="datepicker" name="date">
            
          </div><br><br><br><br><br>

          
          
          <button   class="cmd btn waves-effect blue ">commander</button><br><br><br>
          <a style="font-size: 20px;color: red;" class="modal-trigger " href="#modal1">nouveau client ?</a>

  
  <div id="modal1" class="modal modal-fixed-footer">
  <form method="post" class="col s12" id="formCli" action="#">
    <div class="modal-content">
      <h4 class="titre center">Ajout de client</h4>
      
    
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
        <div class="input-field col s6">
          <input  type="text"  name="tel" >
          <label >telephone</label>
        </div>
      
      
        <div class="input-field col s6">
                  
                  <select name="type">
                    <option value="personne">personne</option>
                    <option value="entreprise">entreprise</option>
                  </select>
                  <label for="">Type</label>
                </div>
      </div>
         
    </div>
    <div class="row">
    <div class="modal-footer col s12">
      <button class="btn blue"  type="submit" id="addCli">Ajouter</button>
    </div>
    </div>
    </form>
  </div>
          
          <br><br>

        </div>


      </div>

      <div class="row center">
        <button class="btn blue waves-effect comm " >Afficher les commandes en attente de confirmation</button><br><br>
      <div style="display:none;" class="col s12 comatt">
        <h4 class="titre">commande en attente</h4><br>
            <table class="tabcomm tablivrok">
          <tbody>
            <tr>
              <th>N° commande</th>
              <th>Datecmd</th>
              <th>code client</th>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Montant total (f cfa)</th>
              <th>details</th>
              <th>Date livraison</th>
            </tr>
            <?php while($recupv=mysql_fetch_assoc($verifv)) { ?>
            <tr>
              <td>N° <?php echo $recupv['codecmd']; ?></td>
                <td style="color:#2ecc71;"><?php echo $recupv['datecmd']; ?></td>
                <td><?php echo $recupv['codecli']; ?></td>
                <td><?php echo $recupv['nom']; ?></td>
                <td><?php echo $recupv['prenom']; ?></td>
                <td style="color:#3498db;"><?php echo number_format($recupv['montant'],0,","," "); ?></td>
                <td class="detail"><a href="admin/recupCom.php?id=<?php echo $recupv['codecmd']; ?>"><img src="../image/detail.png"></a></td>
                <td ><input placeholder="date livraison" class="datepicker col s4" type='date' name="date"><a class=" btn green waves-effect conf" href="admin/confimCom.php?codecmd=<?php echo $recupv['codecmd']; ?>">confirmer</a></td>
                
            </tr>

            <?php } ?>
          </tbody>
        </table>
        </div>

      </div>

        <div class="row center">
        <div class="center">
    <a href="commandes.php"  ><img src="../image/refresh.png"></a>
    </div>
        
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

  
  <datalist id="mylist" style="display:none">
            <?php while ( $recupl=mysql_fetch_assoc($verifl)) { ?>
            <option><?php echo $recupl['designation'].'  quantite : '.$recupl['qte']; ?></option>
            <?php } ?>
          </datalist>

          <datalist id="mylist1" style="display:none">
            <?php while ( $recupr=mysql_fetch_assoc($verifr)) { ?>
            <option><?php echo $recupr['prenom'].' '.$recupr['nom'].' code client :'.$recupr['codecli']; ?></option>
            <?php } ?>
          </datalist>

          


          <div id="modal3" class="modal">
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


<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/scriptCom.js"></script>
<script src="../js/awesomplete.js"></script>

</body>
</html>