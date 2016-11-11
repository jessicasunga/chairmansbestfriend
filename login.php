<?php

	include 'includes/header.php'; 

?>

<!-- Body -->
		<div class="container" id="content">
			<div class="row">
<?php
				if (isset($_SESSION['logged_in'])) {

					print ("<h1>You are logged in. You'lll be re-directed to the homepage in 5 seconds</h1>");
					header("Refresh:5;url=home.php");

				} else {

					print ("

						<div class='row login-container'>

							<div class='one-half column'>
								<h2>Log In</h2>
								<form name='login' action='login.php' method='POST'>
									<b>Username: </b><input class='u-full-width' type='text' name='username'><br/>
									<b>Password: </b><input class='u-full-width' type='password' name='password'><br/>
									<input id='button' class='button-primary' name='submit' id='submit' type='submit' value='Login'>
								</form>
							</div>

							<div class='one-half column u-pull-right'>
								<h2>Create Account</h2>
									<p>Don't have an account? Create one here!</p>
									<a href='create_account.php'><input class='button-primary create-account-button' type='submit' value='Create Account'></a>
							</div>
						</div>

					");

				}

				if ((isset($_POST['submit'])) && (!isset($_SESSION['logged_in']))) {

					$username= mysql_real_escape_string($_POST['username']);

					$password= mysql_real_escape_string($_POST['password']);

					$sha_password = sha1($password);

					$query= "SELECT * FROM users WHERE username= '$username' AND password= '$sha_password' LIMIT 1";

					$result= mysql_query($query, $connection);

					if (mysql_num_rows($result) == 1) {

						$row = mysql_fetch_row($result);

						$_SESSION['logged_in'] = true;

						print "You are now logged in " . $username . ". You will be redirected to the homepage in 5 seconds.";

						header("Refresh:5; url=home.php");

					} else {

						print "<h3>The login information you entered is incorrect, please try again.<h3>";
					}

				}
?>
			 </div>
		</div>
<!-- /Body -->
		
<?php include 'includes/footer.php'; ?>