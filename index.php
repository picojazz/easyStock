


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/myCss.css">
    <link rel="icon" type="image/png" href="image/easystock.png" />
	<title>EasyStock</title>
</head>
<body>
	
	
    
  
	
<div class="container">
        
	<div class="row">
	<?php include 'php/moduleAlert.php'; ?>
    
		<div class="col s6  ">
			     <div class="auth">
				<div class ="card-panel z-depth-5 ">
					<ul  class="tabs tabs-fixed-width ">
        				<li class="tab col s3 "><a class="signin" href="#signin"> <span class="blue-text ">Se connecter</span></a></li>
        				<!--<li class="tab col s3 "><a class="signup" href="#signup"> <span class="blue-text ">S'inscrire</span></a></li>-->
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
						
				</div>

				
    						
		</div></div>
            
            <div class="col s6 center" style="padding-top: 5vh;">
                <img src="image/easystock.png">
                <img src="image/easy.png">
            </div>
        

	</div>

	 
    



</div>




<script src="js/jquery.min.js"></script>
<script src="js/materialize.min.js"></script>
<script src="js/scriptIndex.js"></script>


</body>
</html>