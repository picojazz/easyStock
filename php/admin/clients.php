
<?php 
	

	$req="SELECT * FROM client ORDER BY codecli DESC ";
	$verif=mysql_query($req);


 ?>


<div class="row">
<h3 class="center titre">Ajout de clients</h3>
<div class="card-panel col s6 offset-s3">
	
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
  	<h3 class="center titre">Liste des clients</h3>
  	<table class="clientTable">
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
       <td><?php echo $recup['tel']; ?></td>
       <td><?php echo $recup['adresse']; ?></td>
       <td class="modif"><a href="admin/modifClient.php?id=<?php echo $recup['codecli']; ?>"><img src='../image/modif.png'></a></td>
	   <td class="supp"><a href="admin/suppClient.php?id=<?php echo $recup['codecli']; ?>"><img src="../image/supp.png"></a></td>
    </tr>
    <?php } ?>
  </tbody>
  </table>
  </div>



  <div id="modal1" class="modal modal-fixed-footer">
  <form method="post" id="formModif"  action="#">
    <div class="modal-content">
      <h4 class="center titre">Modifier un client</h4>
    
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