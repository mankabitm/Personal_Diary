<?php

	include("connect.php");
	include("functions.php");

	$res="";
	$text="";
	if(logged_in())
	{
	?>
		<a href="changepassword.php" style="padding:10px; margin-right:40px; background-color:#eee; color:#333; text-decoration:none;">Change password</a>
		<a href="logout.php" style="float:right; padding:10px; margin-right:40px; background-color:#eee; color:#333; text-decoration:none;">Logout</a>
	<?php
		$end_user=$_SESSION['email'];
		echo "HELLO ".$end_user."!!";
		$sql="SELECT * FROM users WHERE email='$end_user'";
		$rs=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($rs);
		$res=$row[3];
		if(isset($_POST['submit']))
		{
			$text=$_POST['text'];
			$sql="UPDATE users SET content='$text' WHERE email='$end_user'";
			mysqli_query($con,$sql);
			$sql="SELECT * FROM users WHERE email='$end_user'";
			$rs=mysqli_query($con,$sql);
			$row=mysqli_fetch_array($rs);
			$res=$row[3];
		}
	}
	else
	{
		header("location:login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Diary</title>
	<link rel="stylesheet" href="css/styles.css" />
</head>
<body>
	<form method="POST">
		<textarea id="text" name="text"><?php echo $res;?></textarea><br><br>
		<input type="submit" class="theButtons" name="submit" value="SUBMIT" />
	</form>
</body>
</html>