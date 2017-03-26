<?php 
	session_start();
	if(session_id()=='' || isset($_SESSION['username']))
	{
  		$dbhost = "localhost";
		$dbuser = "root";
  		$dbpass = "1234";
  		$dbname = "coffeecorner";
  		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		
		$user = $_SESSION['username'];
		$sql = "SELECT * FROM user";
	$result = mysqli_query($connection, $sql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User | Dashboard</title>
<link href="user_dash.css?v=random number/string" rel="stylesheet" type="text/css">
</head>

<body class="ggwp">
	<h2 class="h2">Coffee Corner</h2>

<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a class="dashtext" href="user_dashboard.php">Dashboard</a></li>
	  <li class="add"><a class="add2" href="user_addreservation.php">Make a reservation</a></li>
	  <li class="view"><a class="view2" href="user_view.php">View Reservation</a></li>
	  <li class="update"><a class="update2" href="user_update.php">Update Reservation</a></li>
	  <li class="delete"><a class="delete2" href="user_delete.php">Delete Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
<div>
	<h1 class="h3">Welcome <?php echo $_SESSION['username']. "."; ?></h1>
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
<div>
	<?php 
	  	$sql = "SELECT * FROM notification WHERE noti_id = '1'";
	  	$result = mysqli_query($connection, $sql);
		
		while($row = mysqli_fetch_array($result))
		{	
	?>
	<marquee class="marque" bgcolor="##FFFFFF"><?php echo $row['noti_text']; ?></marquee>
	<?php } ?>
</div>
<div class="admin_detail">
	<?php
	while ($row = mysqli_fetch_array($result)){
	?>
		<?php echo "<h4>Your Details:</h4>"; ?>
		<?php echo "Username: " . $row['username']; ?> <br><br>
		<?php echo "User ID: " . $row['user_id']; ?> <br><br>
		<?php echo "Email: " . $row['email']; ?> <br><br>
		<?php echo "Phone: " . $row['phone']; ?> <br><br>
	<?php
	}
	?>
		<!--<a href="admin_pass.php">Change Password</a>-->
	</div>
</body>

<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>
</html>