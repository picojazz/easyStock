<?php 
    session_start();
if ($_SESSION['login'] =="" ) {
    header("Location:../index.php?erreur=intru");
}
if ($_SESSION['profil'] =="user" ) {
    header("Location:user.php");
}

 ?>