<?php
  session_start();
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "1234";
  $dbname = "coffeecorner";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  if(isset($_POST['login']))
  {
	  $username = mysqli_real_escape_string($connection, $_POST['username']);
	  $password = mysqli_real_escape_string($connection, $_POST['password']);
	  
	  $sql = "SELECT * FROM admin WHERE user='$username' AND pass='$password'";
	  $result = mysqli_query($connection, $sql);
	  
	  if(!$result)
			{
				die("database query fail!" . mysqli_error($connection));
			}

	  if(mysqli_num_rows($result) == 1)
	  {
		  header("location: admin.php");
	  }
	  else
	  {
		echo "Username/password are incorrect!";
	  }
  }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin | Login</title>
<link href="admin_login.css" rel="stylesheet" type="text/css">
</head>

<body class="background">
	<h1 class="h2">Coffee Corner</h1>
	<h3 class="h3">ADMIN LOGIN</h3>
<div class="box">
	<form method="post" action="admin_login.php" >
		<?php 
		if(isset($_POST['login']))
  		{
	  		$username = mysqli_real_escape_string($connection, $_POST['username']);
			$password = mysqli_real_escape_string($connection, $_POST['password']);
	  
			$sql = "SELECT * FROM admin WHERE user='$username' AND pass='$password'";
	  		$result = mysqli_query($connection, $sql);
	  
	  		if(mysqli_num_rows($result) == 1)
	  		{
				echo "";
				$_SESSION['user'] = $username;
	  		}
	  		else
	  		{
				echo "Incorrect username/password!";
	  		}
  		}
		?>
		<p class="username">USERNAME</p>
		<input type="text" class="username" name="username" required><br><br>
		<p class="password">PASSWORD</p>
		<input type="password" class="password" name="password" required><br><br>
		<input class="sign" type="submit" class="login_button" value="SIGN IN" name="login">
	 </form>
</div>
</body>
</html>