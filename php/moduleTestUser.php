<?php 
    session_start();
if ($_SESSION['login'] =="" && $_SESSION['profil'] == 'admin' ) {
    header("Location:../index.php?erreur=intru");
} ?>