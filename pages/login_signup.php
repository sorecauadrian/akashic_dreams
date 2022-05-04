<?php
	if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
		header("location: ./index.php?page=main");
		exit;
	}

	require_once "./db_connection.php";

	$username = $password = $confirm_password = "";
	$username_err = $password_err = $confirm_password_err = $login_err = "";

	if (isset($_POST["login"]))
	{
		if (empty(trim($_POST["login_username"])))
			$username_err = "Please enter username.";
		else
			$username = trim($_POST["login_username"]);

		if(empty(trim($_POST["login_password"])))
			$password_err = "Please enter your password.";
		else
			$password = trim($_POST["login_password"]);

		if(empty($username_err) && empty($password_err))
		{
			$query = "SELECT id, username, password FROM users WHERE username = '" . $username . "'";
			if ($result = mysqli_query($link, $query))
			{
				if (mysqli_num_rows($result) == 1)
				{
					$row = mysqli_fetch_assoc($result);
					if(password_verify($password, $row['password']))
					{
						$_SESSION["loggedin"] = true;
						$_SESSION['id'] = $row['id'];
						$_SESSION["username"] = $username;                            
						
						header("location: ./index.php?page=main");
						exit;
					} 
					else
						$login_err = "invalid username or password.";
				}
				else
					$login_err = "this username does not exist.";
			}
			else
				echo "oops! something went wrong. please try again later.";
		}
	}
	if (isset($_POST["signup"]))
	{
		// Validate username
		if (empty(trim($_POST["signup_username"])))
			$username_err = "please enter a username.";
		elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["signup_username"])))
			$username_err = "username can only contain letters, numbers, and underscores.";
		else
		{
			$select = mysqli_query($link, "SELECT id FROM users WHERE username = '".$_POST["signup_username"]."'");
			if(mysqli_num_rows($select))
				$username_err = "this username is already taken.";
			else
				$username = trim($_POST["signup_username"]);
		}

		// Validate password
		if(empty(trim($_POST["signup_password"])))
			$password_err = "please enter a password.";     
		elseif(strlen(trim($_POST["signup_password"])) < 6)
			$password_err = "password must have atleast 6 characters.";
		else
			$password = trim($_POST["signup_password"]);

		// Validate confirm password
		if(empty(trim($_POST["signup_confirm_password"])))
			$confirm_password_err = "please confirm password.";     
		else
		{
			$confirm_password = trim($_POST["signup_confirm_password"]);
			if(empty($password_err) && ($password != $confirm_password))
				$confirm_password_err = "password did not match.";
		}

		// Check input errors before inserting in database
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
		{
			$query = "INSERT INTO users (username, password, created_at) VALUES ('$username', '" . crypt($password, PASSWORD_DEFAULT) . "', CURRENT_TIMESTAMP)";
			if ($result = mysqli_query($link, $query))
			{
				header("location: ./index.php?page=login_signup");
				exit;
			}
			else
				echo "no se puede";
		}

	}

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/style.css">
		<link rel = "icon" type = "image/png" href = "./logos/logon.png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <title>akashic dreams - login and signup</title>
        <style>

			#radius-shape-1 
			{
				height: 220px;
				width: 220px;
				top: -60px;
				left: -130px;
				background: radial-gradient(#44006b, #ad1fff);
				overflow: hidden;
			}

			#radius-shape-2 
			{
				border-radius: 40% 60% 60% 40% / 70% 30% 70% 30%;
				bottom: -60px;
				right: -110px;
				width: 300px;
				height: 300px;
				background: radial-gradient(#44006b, #ad1fff);
				overflow: hidden;
			}

			.bg-glass 
			{
				background-color: rgba(43, 29, 93, 0.5) !important;
				backdrop-filter: saturate(200%) blur(10px);
				color: white;
			}
			#signup
			{
				display:  none;
			}
		</style>
		<script>
			$(document).ready(function()
			{
				$('#link1').click(function()
				{
					$('#signup').show();
					$('#login').hide();
				});
				$('#link2').click(function()
				{
					$('#login').show();
					$('#signup').hide();
				});
			});
		</script>
	</head>
	<body>
		<div class="background">
			<div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
				<div class="row gx-lg-5 align-items-center mb-5">
				  	<div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
					    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
							<img src="./logos/logos.png" alt="logo" style="height: auto; width: 80%;"> <br />
					    	<span style="color: hsl(218, 81%, 75%)">becoming aware</span>
					    </h1>
					    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
					    	do you remember your dreams clearly? you can improve dream recall and make your dreams much longer and vivid by writing them down first thing in the morning. but if you are looking for something even more exciting - you can learn lucid dreaming!
					    </p>
				  	</div>

				  	<div class="col-lg-6 mb-5 mb-lg-0 position-relative">
				    	<div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
				    	<div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

					    <div class="card bg-glass">

					      	<div class="card-body px-4 py-5 px-md-5" id="login">
					      		<h2>login</h2>
					        	<form action="./index.php?page=login_signup" method="post">
						          	<div class="form-outline mb-4">
						            	<input type="text" name="login_username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="username">
										<span class="invalid-feedback"><?php echo $username_err; ?></span>
						          	</div>

				          			<div class="form-outline mb-4">
				           				<input type="password" name="login_password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="password">
										<span class="invalid-feedback"><?php echo $password_err; ?></span>
				          			</div>

				          			<button type="submit" class="btn btn-dark btn-block mb-4 w-100" name="login">
				            			login
				          			</button>
				          			<div class="form-text text-center mb-5 text-light">not registered?
										<a class="text-light fw-bold text-decoration-none" id="link1">create an account</a>
									</div>
									<?php
									
										if(!empty($login_err))
											echo '<div class="alert alert-danger">' . $login_err . '</div>'; 
											  
									?>
				        		</form>
				      		</div>

				      		<div class="card-body px-4 py-5 px-md-5" id="signup">
					      		<h2>sign up</h2>
					        	<form action="./index.php?page=login_signup" method="post">
						          	<div class="form-outline mb-4">
						            	<input type="text" name="signup_username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="username">
										<span class="invalid-feedback"><?php echo $username_err; ?></span>
						          	</div>

				          			<div class="form-outline mb-4">
				           				<input type="password" name="signup_password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="password">
										<span class="invalid-feedback"><?php echo $password_err; ?></span>
				          			</div>

				          			<div class="form-outline mb-4">
				          				<input type="password" name="signup_confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" placeholder="confirm password">
										<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
									</div>

				          			<button type="submit" class="btn btn-dark btn-block mb-4 w-100" name="signup">
				            			signup
				          			</button>

				          			<div class="form-text text-center mb-5 text-light">already have an account?
										<a class="text-light fw-bold text-decoration-none" id="link2">login</a>
									</div>
				        		</form>
				      		</div>

				    	</div>
				  	</div>
				</div>
			</div>
		</div>
	</body>
</html>