


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/myCss.css">
	<title>scAcces</title>
</head>
<body>
	
	
    
  
	
<div class="container">
	<div class="row">
	<?php include 'php/moduleAlert.php'; ?>
		<div class="col s6 offset-s3 auth">
			
				<div class ="card-panel z-depth-3">
					<ul  class="tabs tabs-fixed-width ">
        				<li class="tab col s3 "><a class="signin" href="#signin"> <span class="blue-text ">Se connecter</span></a></li>
        				<li class="tab col s3 "><a class="signup" href="#signup"> <span class="blue-text ">S'inscrire</span></a></li>
      				</ul>
      					<form method="post" action="php/moduleAuthentification.php" >
						<div id="signin" >
    						<div class="input-field">
    							<label for="">Identifiant</label>
    							<input type="text" name="login">
    						</div>
    						<div class="input-field">
    							<label for="">Mot De Passe</label>
    							<input type="password" name="password">
    						</div>
    						<div class="input-field ">
    							
    							<select name="profil">
    								<option value="admin">administrateur</option>
    								<option value="user">utilisateur</option>
    							</select>
    							<label for="">Profil</label>
    						</div>
    						<button type="submit" name="connect" class="btn blue waves-effect waves-light">Se connecter</button>
    					</div>
    					</form>
						<form method="post" action="php/moduleAuthentification.php" enctype="multipart/form-data">
    					<div id="signup" >
      				    	<div class="input-field">
    							<label for="">Prenom</label>
    							<input type="text" name="prenom" required>
    						</div>
    						<div class="input-field">
    							<label for="">Nom</label>
    							<input type="text" name="nom" required>
    						</div>
    						
    						<div class="input-field">
    							<label for="">Identifiant</label>
    							<input type="text" name="login" required>
    						</div>
    						<div class="input-field">
    							<label for="">Mot De Passe</label>
    							<input type="password" name="password" >
    						</div>
    						<div class="file-field input-field">
								<div class   ="btn blue">
									<span>Photo</span>
									<input  type  ="file" name="photo">
								</div>
								<div class   ="file-path-wrapper">
									<input class ="file-path validate " type="text">
								</div>
							</div>
    						<button type="submit" name="signup" class="btn blue waves-effect waves-light">S'inscrire</button>
    						</form>
      				    </div>
				</div>

				
    						
		</div>
	</div>

	 
    



</div>




<script src="js/jquery.min.js"></script>
<script src="js/materialize.min.js"></script>
<script src="js/script.js"></script>


</body>
</html>