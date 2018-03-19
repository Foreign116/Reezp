<?php
include '../configs/db.inc.php';
if(isset($_POST['loginAccount'])){
	$email = mysqli_real_escape_string($conn,$_POST['loginEmail']);
	$password = mysqli_real_escape_string($conn,$_POST['loginPassword']);

	if(empty($email)||empty($password)){
		header('Location: login.php?login=fail');
	}
	else{
		$query = "SELECT id FROM users where email='$email';";
		$results = mysqli_query($conn,$query);
		if(mysqli_num_rows($results)!=1){
			header('Location: login.php?login=fail');
		}
		else{
			$query = "SELECT pass FROM users WHERE email='$email';";
			$results = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($results);
			$passQ = $row['pass'];
			if(password_verify($password,$passQ)){
				$_SESSION['email'] = $email ;
				$_SESSION['password'] = $password;
				$_SESSION['login'] = 'true';
				header('Location: Directory.php');	
				
			}
			else{
				header("Location: login.php?login=fail");		
			}

			}
		}
		mysqli_close($conn);
	}

include 'createAccountHeader.php';
include 'loggedBody.php';
include 'footer.php';
	?>
