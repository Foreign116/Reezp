<?php
include 'templates/configs/db.inc.php';
if(isset($_SESSION['login']) || $_SESSION['login']==='true'){
	header('Location: Directory.php');
	}

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
			$query2 = "SELECT hashGood FROM users WHERE email='$email';";
			$results = mysqli_query($conn, $query);
			$results2 = mysqli_query($conn,$query2);
			$row = mysqli_fetch_assoc($results);
			$row2 = mysqli_fetch_assoc($results2);
			$passQ = $row['pass'];
			$hash = $row2['hashGood'];
			if(password_verify($password,$passQ) && $hash==='good'){

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

include 'templates/pages/createAccountHeader.php';
include 'templates/pages/loggedBody.php';
include 'templates/pages/footer.php';
?>