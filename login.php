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
	  
	  $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
	  $result = mysqli_query($connection, $sql);
	  
	  if(!$result)
			{
				die("database query fail!" . mysqli_error($connection));
			}

	  if(mysqli_num_rows($result) == 1)
	  {
		  //$_SESSION['username'] = $username;
		  //$_SESSION['user_id'] = $userid;
		  header("location: user_dashboard.php");
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
<title>login</title>
<link href="login.css" rel="stylesheet" type="text/css">
</head>

<body class="background">
 <h1 class="h1">Welcome to Coffee Corner </h1>
 <pre class="pre">“We welcome you to a delicious feast of exquisite dishes in Coffee Corner. 
 With a wide range of world cuisines to choose from, 
 We guarantee you a sumptuous feast experience in our restaurant.”</pre>
 <div class="signin_style">
	<form method="post" action="login.php" >
		<p class="hi">Hi! Good to see you!</p>
		<?php 
		if(isset($_POST['login']))
  		{
	  		$username = mysqli_real_escape_string($connection, $_POST['username']);
			$password = mysqli_real_escape_string($connection, $_POST['password']);
	  
			$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
	  		$result = mysqli_query($connection, $sql);
	  
	  		if(mysqli_num_rows($result) == 1)
	  		{
				echo "";
				$_SESSION['username'] = $username;
	  		}
	  		else
	  		{
				echo "Incorrect username/password!";
	  		}
  		}
		?>
		<input type="text" class="username" placeholder="Username" name="username" required>
		<input type="password" class="password" placeholder="Password" name="password" required>
		<input type="submit" class="login_button" value="Log in" name="login">
		<p>New customer? <a href="signup.php" class="signup">Sign up now !</a></p>
	 </form>
 </div>	
</body>
</html>


<?php
	mysqli_close($connection);
?>