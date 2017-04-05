<?php
	include 'moduleConnexion.php';
	session_start();
	//connexion
	if(isset($_POST['connect']) ){


		$login=mysql_real_escape_string(htmlspecialchars($_POST['login']));
		$pass=mysql_real_escape_string(htmlspecialchars($_POST['password']));
		$profil=mysql_real_escape_string(htmlspecialchars($_POST['profil']));

		if ($profil == 'admin') {
			$pass=md5(mysql_real_escape_string(htmlspecialchars($_POST['password'])));
			$req=sprintf("SELECT * FROM users WHERE login='$login' AND password='$pass' AND profil='$profil'" ); 
		$verif=mysql_query($req)or die(mysql_error());
		$info=mysql_fetch_assoc($verif);
		$user=mysql_num_rows($verif);
		
		}else{
			$req=sprintf("SELECT prenom as login,nom,codecli  FROM client WHERE prenom='$login' AND tel='$pass' " ); 
		$verif=mysql_query($req)or die(mysql_error());
		$info=mysql_fetch_assoc($verif);
		$user=mysql_num_rows($verif);
		}

		
		
		if($user){
			
			session_register("authentification"); 
		
		 $_SESSION['codecli'] = $info['codecli'];
		 $_SESSION['login'] = $info['login']; 
		 $_SESSION['nom'] = $info['nom'];  
		 $_SESSION['profil'] = $profil; 
		
		 if ($profil == 'admin') {
		 	header("location:home.php?sign=in");
		 }else{
		 	header("location:user.php?sign=in");
				}
		}else{
			header("location:../index.php?erreur=login");
		}
	}
	//inscription
	if (isset($_POST['signup'])) {
		$prenom=mysql_real_escape_string(htmlspecialchars($_POST['prenom']));
		$nom=mysql_real_escape_string(htmlspecialchars($_POST['nom']));
		$login=mysql_real_escape_string(htmlspecialchars($_POST['login']));
		$pass=md5(mysql_real_escape_string(htmlspecialchars($_POST['password'])));
		
		

		if (empty($prenom) || empty($nom) || empty($login) || empty($pass)) {
			header("location:../index.php?sign=no");
		}else{
			if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
				copy($_FILES['photo']['tmp_name'],"../image/userImage/".$_FILES['photo']['name']);
				$photoName=$_FILES['photo']['name'];
				$photopath="../image/userImage/$photoName";
				$req=sprintf("INSERT INTO users (prenom,nom,profil,login,password,photo)VALUES('$prenom','$nom','user','$login','$pass','$photopath')" ); 
			}else{
		
		$req=sprintf("INSERT INTO users (prenom,nom,profil,login,password)VALUES('$prenom','$nom','user','$login','$pass')" ); 
				}
		$verif=mysql_query($req)or die(mysql_error());

		header("location:../index.php?sign=ok");
		}
		
	}


	//deconnexion
	if(isset($_GET['erreur']) && $_GET['erreur'] == 'logout'){ 
	$prenom = $_SESSION['login']; 
	session_unset("authentification");
	header("Location:../index.php?erreur=delog&prenom=$prenom");
}
?>