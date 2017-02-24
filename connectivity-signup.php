<?php
  session_start();
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "1234";
  $dbname = "coffeecorner";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(isset($_POST['submit']))
	{
		$username = mysql_real_escape_string($_POST['user']);
		$email = mysql_real_escape_string($_POST['email']);
		$phone = mysql_real_escape_string($_POST['phone']);
		$password = mysql_real_escape_string($_POST['password']);
		
		if(isset($_POST['submit']))
		{
			$sql = "INSERT INTO user(username,email,phone,password) VALUES('$username','$email','$phone',$password)";
			mysqli_query($connection, $sql);
			$_SESSION['message'] = "Success register";
			$_SESSION['username'] = $username;
			header("location: index.html");
		}
		else
		{
			$_SESSION['message'] = "Failed";
		}
	}
?>

