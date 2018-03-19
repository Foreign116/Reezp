<?php 
include '../configs/db.inc.php';
if(isset($_POST["createAccount"])){
	$email = mysqli_real_escape_string($conn,$_POST['createEmail']);
	$password = mysqli_real_escape_string($conn,$_POST['createPassword']);
	$sk = mysqli_real_escape_string($conn,$_POST['sc']);
	if(empty($sk) || $sk != 'haydensmiddlenameisjewish'){
		header('Location: create.php?accountCreation=Error'); 
	}
	else{
		if(empty($email) || empty($password)){
			
			header('Location: create.php?accountCreation=Error'); 
		
		}
		else{
			$query = "SELECT id FROM users WHERE email='$email';";
			$results = mysqli_query($conn, $query);
			if(mysqli_num_rows($results)>0){
				header('Location: create.php?accountCreation=emailTaken');
			}
			else{
				$hashPassword = password_hash($password,PASSWORD_DEFAULT);
				$query ="INSERT INTO users (email, pass) VALUES ('$email', '$hashPassword');";
				if(mysqli_query($conn,$query)===TRUE){
					header('Location: login.php'); 
				}
				else{
					echo 'something went wrong';
				}

			}
		}
	}
	mysqli_close($conn);
}
include 'createAccountHeader.php';
include 'createAccountBody.php';
include 'footer.php';
?>
