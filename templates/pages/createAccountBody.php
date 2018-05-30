 


<nav>
	<div class="nav-wrapper blue lighten-1 flow-text"">
		<a href="/" class ="brand-logo center"><i>Reezp</i></a>
		<ul id="nav-mobile" class="left hide-on-med-and-down">
			<li><a href="../../create.php">Sign Up</a></li>
			<li><a href="../../login.php">Log In</a></li>
		</ul>
	</div>
</nav>





<div class="container center">
	<h1 class="flow-text"><i>Create An Account</i></h1>
	<div class="AccountForm">
		<div class="row">
			<form class="col s12 black-text flow-text" method="POST" action="../../create.php">
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="Email" id="email" type="email" class="validate" name="createEmail">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="Password" id="password" type="password" class="validate" name="createPassword">
					</div>
				</div>
               <p class="flow-text red-text" style="font-size: .7em;">By signing up for an account, or by accessing or using the Services, you agree to be bound by our copyright policy, and any other legal notices, conditions or guidelines we provide related to the use of the Site or Services, which may be posted from time to time. All such guidelines or rules are hereby incorporated into this Agreement.<p>
				<button class="btn waves-effect waves-light blue lighten-1 left" id="showPassButton" type="button" name="showPass" onclick="showPassword()">Show Password
				</button>
				<button class="btn waves-effect waves-light blue lighten-1 right" type="submit" name="createAccount" >Submit</button>
			</form>
		</div>
	</div>
</div>
