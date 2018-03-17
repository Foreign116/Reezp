 
<nav class="nav-wrapper blue lighten-1 flow-text">
	<a href="landingPage.php" class ="brand-logo center"><i>Reezp</i></a>
</nav>


<div class="container center">
	<h1 class="flow-text"><i>Log In</i></h1>
	<div class="AccountForm">
		<div class="row">
			<form class="col s12 black-text flow-text" method="post">
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="Email" id="email" type="email" class="validate" name="loginEmail">

					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="Password" id="password" type="password" class="validate" name="loginPassword">
					</div>
				</div>
				<button class="btn waves-effect waves-light blue lighten-1 left" id="showPassButton" type="button" name="showPass" onclick="showPassword()">Show Password
				</button>
				<button class="btn waves-effect waves-light blue lighten-1 right" type="submit" name="loginAccount">Submit
				</button>
			</form>
		</div>
	</div>
</div>
