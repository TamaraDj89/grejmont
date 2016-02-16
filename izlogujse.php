<?php 
	session_start();

	unset($_SESSION['idKorisnika']);
	unset($_SESSION['uloga']);

	session_destroy();
	header("Location:index.php");
 ?>