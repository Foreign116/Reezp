<?php 
include 'templates/configs/db.inc.php';
if(!isset($_SESSION['login'])){
	header('Location: login.php'); 
}
include 'templates/pages/createAccountHeader.php';
include 'templates/pages/logout.php';
include 'templates/pages/folders.php';
include 'templates/pages/footer.php';
?>

