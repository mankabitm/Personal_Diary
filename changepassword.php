<?php

	include("connect.php");
	include("functions.php");

	$error="";
	if(isset($_POST['savepass']))
	{
		$password=$_POST['password'];
		$passwordConfirm=$_POST['passwordConfirm'];

		if(strlen($password) < 8)
		{
			$error="Password must be greater than 8 characters";
		}
		else if($password !== $passwordConfirm)
		{
			$error="Passwords do not match";
		}
		else
		{
			$password=md5($password);
			$email=$_SESSION['email'];
			if(mysqli_query($con,"UPDATE users SET password='$password' WHERE email='$email'"))
			{
				$error="Password changed successfully <a href='profile.php'>CLICK HERE</a> to go back to the profile";
			}
		}

	}

	if(logged_in())
	{
	?>
	<?php echo $error; ?>
	<style>
		body{
			padding:0;
			margin:0;
			background-image: url("https://sc01.alicdn.com/kf/UT8AhfZXEpaXXagOFbXV/Customize-New-Year-Diary-for-2016-Office.jpg");
			background-repeat: no-repeat;
			background-size: 2000px 1000px;
		}
		#formchange{
			color:white;
			width:300px;
			margin:0px auto;
			margin-top:20px;
			font-family:tahoma;
			font-size:14px;
		}
	</style>
	<form method="POST" action="changepassword.php" id="formchange">
		<label>New Password:</label><br/>
		<input type="password" name="password" /><br/><br/>
		<label>Re-enter Password:</label><br/>
		<input type="password" name="passwordConfirm" /><br/><br/>
		<input type="submit" name="savepass" value="Change Password"/><br/><br/>
	</form>
	<?php
	}
	else
	{
		header("location:profile.php");
	}
?>