<?php 
	session_start();
	if(session_id()=='' || isset($_SESSION['username'])){
?>

<!doctype html>
<html>
<head>
<link href="admin.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<title>Admin | Dashboard</title>
</head>

<body style="background-color: #F9F9F9">

<h2 class="h2">Coffee Corner</h2>
<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a href="admin.php">Dashboard</a></li>
	  <li class="add"><a href="notification.php">Add notification</a></li>
	  <li class="view"><a>View Reservation</a></li>
	  <li class="update"><a>Reservation Status</a></li>
	  <li class="delete"><a>Delete Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
<div>
	<h3 class="h3">Welcome <?php $_SESSION['username']. "."; ?></h3>
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="admin_logout.php" name="logout">Log out</a>
</body>

<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>
</html>