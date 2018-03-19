<?php 
include '../configs/db.inc.php';
if(!isset($_SESSION['login'])){
	header('Location: login.php'); 
}
include 'createAccountHeader.php';
include 'folders.php';
include 'footer.php';
?>

