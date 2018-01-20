<?php

	include("connect.php");
	include("functions.php");

	if(logged_in())
	{
		header("location:profile.php");
		exit();
	}

	$error="";

	if(isset($_POST['submit']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordConfirm = $_POST['passwordConfirm'];

		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$error="Please enter valid email address";
		}
		else if(email_exists($email,$con))
		{
			$error="Already registered email";
		}
		else if(strlen($password) < 8)
		{
			$error="Password must be greater than 8 characters";
		}
		else if($password !== $passwordConfirm)
		{
			$error="Passwords do not match";
		}
		else
		{
			$password = md5($password);
			$insertQuery = "INSERT INTO users(email,password) VALUES('$email','$password')";
			if(mysqli_query($con,$insertQuery))
			{
				$error = "Registered successfully";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
		<head>
			<title>REGISTRATION PAGE</title>
			<link rel="stylesheet" href="css/styles.css" />
		</head>
		<body>
			<div id="error" style=" <?php if($error != "") { ?> display:block; <?php } ?>">
				<?php echo $error; ?>
			</div>
			<div id="wrapper">
				<div id="menu">
					<a href="index.php">Sign Up</a>
					<a href="login.php">Login</a>
				</div>
				<div id="formDiv">
					<form method="POST" action="index.php">
						<label style="color:white;">Email:</label><br/>
						<input type="text" name="email" class="inputFields" required/><br/><br/>
						<label style="color:white;">Password:</label><br/>
						<input type="password" name="password" class="inputFields" required/><br/><br/>
						<label style="color:white;">Re-enter Password:</label><br/>
						<input type="password" name="passwordConfirm" class="inputFields" required/><br/><br/>
						<input type="submit" class="theButtons" name="submit" value="Sign Up!" />
					</form>
				</div>
			</div>
		</body>
</html>