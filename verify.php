<?php 
include 'templates/configs/db.inc.php';
include 'templates/pages/createAccountHeader.php';


if (isset($_GET['email']) && isset($_GET['hash']) && !empty($_GET['email']) && !empty($_GET['hash'])) {
	$theHash = mysqli_real_escape_string($conn,$_GET['hash']);
	$theEmail = mysqli_real_escape_string($conn,$_GET['email']);
	$query = "SELECT hash FROM users WHERE email='$theEmail';";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$dbHash = $row['hash'];
	if($theHash === $dbHash){
		$query2 = "UPDATE users SET hashGood = 'good' WHERE email = '$theEmail';";
		mysqli_query($conn,$query2);
	}
	else{
		header("Location: create.php");	
	}
}
else{
	header("Location: create.php");	
}

?>

<div class="container center">
	<h1 class="green-text flow-text">Confirmed</h1>
	<a href="login.php">Login Now</a>
</div>


<script type="text/javascript" src="../../scripts/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../../styles/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="../../scripts/js/mainScript.js"></script>
</body>
</html>