<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['login']);
unset($_POST['loginPassword']);
unset($_POST['loginEmail']);
unset($_POST['loginAccount']);
session_unset();
session_destroy();
sleep(3);
header('Location: ../../login.php');


?>