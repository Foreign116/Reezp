<?php 
include 'templates/configs/db.inc.php';


function emailConfirm($hash,$email,$password){
$to   = $email; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Email: '.$email.'
Password: '.$password.'
------------------------
 
Please click this link to activate your account:
https://reezp.com/verify.php?email='.$email.'&hash='.$hash.''; // Our message above including the link
                     
$headers = 'From:noreply@Reezp.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
}



if(isset($_POST["createAccount"])){
	$email = mysqli_real_escape_string($conn,$_POST['createEmail']);
	$password = mysqli_real_escape_string($conn,$_POST['createPassword']);
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
				$hash = md5( rand(0,1000) );
				$hashPassword = password_hash($password,PASSWORD_DEFAULT);
				$query ="INSERT INTO users (email, pass, hash, hashGood) VALUES ('$email', '$hashPassword','$hash',NULL);";
				if(mysqli_query($conn,$query)===TRUE){
					emailConfirm($hash,$email,$password);
					header('Location: sent.php'); 
				}
				else{
					echo 'something went wrong';
				}

			}
		}
	
	mysqli_close($conn);
}


include 'templates/pages/createAccountHeader.php';
include 'templates/pages/createAccountBody.php';
include 'templates/pages/footer.php';
?>
