<?php 
	session_start();
	if(session_id()=='' || isset($_SESSION['username'])){
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "1234";
	    $dbname = "coffeecorner";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	    $user = $_SESSION['username'];	

		$sql  = "(SELECT * FROM add_reservation WHERE username like '$user')";
		$result = mysqli_query($connection, $sql);

		  if(!$result)
		  {
			 die("database query fail!" . mysqli_error($connection) . mysqli_errno($connection));
		  }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User | Dashboard</title>
<link href="edit1.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h2 class="h2">Coffee Corner</h2>

<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a href="user_dashboard.php">Dashboard</a></li>
	  <li class="add"><a href="user_addreservation.php">Make a reservation</a></li>
	  <li class="view"><a href="user_view.php">View Reservation</a></li>
	  <li class="update"><a href="user_update.php">Update Reservation</a></li>
	  <li class="delete"><a>Delete Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
<div>
	<h3 class="h3">Edit your reservation</h3>
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
	<!--drop down -->
	<div class="dropdown">
		<h2>Reservation Update</h2>
		<p>Select Reservation ID to edit:</p>
		<form id="form" action="editform.php" method="post">
		<?php
		echo "<select name=\"Reservation ID\" form=\"form\">";
		while ($row = mysqli_fetch_array($result)) 
  		{
			$gg = $row['reserve_id'];
   			 echo "<option value='" . $gg . "' name=\"reserve_id\">" . $gg . "</option>";
		}
		echo "</select>";
		$_SESSION['reserve'] = $gg;
		?>
		<input type="submit" name="form" value="Submit">
		</form>
	</div>
	<!-- end drop down -->
</body>
<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>
</html>