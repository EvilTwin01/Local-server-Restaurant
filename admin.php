<?php 
	session_start();
	if(session_id()=='' || isset($_SESSION['user'])){
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
	   <div class="dropdown">
  <a class="dropbtn">Notification</a>
  <div class="dropdown-content">
    <a href="notification.php">Add Notification</a>
    <a href="notification1.php">View Notification</a>
    <a href="#">Link 3</a>
  </div>
	  <li class="view"><a>View Reservation</a></li>
	  <li class="update"><a>Reservation Status</a></li>
	  <li class="delete"><a>Delete Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
<div>
	<h3 class="h3">Welcome <?php $_SESSION['user']. "."; ?></h3>
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['user']; ?></p>
	<a class="button_logout" href="admin_logout.php" name="logout">Log out</a>
</body>

<?php 
 } 
 else
 { 
	header("location: admin_login.php");
 }
?>
</html>