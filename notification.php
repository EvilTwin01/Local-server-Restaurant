<?php 
session_start();
if(session_id()=='' || isset($_SESSION['user'])){
	
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "1234";
  $dbname = "coffeecorner";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  
	$sql1 = "SELECT * FROM notification";
	  $result1 = mysqli_query($connection, $sql1);

  if((mysqli_num_rows($result1) < 1)){
  if(isset($_POST['add']))
  {
	  $noti_id = "1";
	  $notification = mysqli_real_escape_string($connection, $_POST['noti']);
	  
	  $sql = "INSERT INTO notification(noti_id,noti_text) VALUES('$noti_id','$notification')";
	  $result = mysqli_query($connection, $sql);
			
	  if(!$result)
	  {
		 die("database query fail!" . mysqli_error($connection));
	  }
	  header("location: notification1.php");
  }}else
  {  
	  echo "<script type='text/javascript'>alert('Only 1 notification can be added. Delete some!'); window.location.href = \"notification1.php\";</script>"; 
  }
?>

<!doctype html>
<html>
<head>
<link href="notification.css?v=random number/string" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<title>Admin | Dashboard</title>
</head>

<body class="ggwp">

<h2 class="h2">Coffee Corner</h2>
<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a class="dashboard2" href="admin.php">Dashboard</a></li>
	  <div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Notification</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="notification.php">Add Notification</a>
    <a href="notification1.php">View Notification</a>
  </div>
</div>
	  <li class="view"><a class="view2" href="admin_view.php">View Reservation</a></li>
	  <li class="update"><a class="update2" href="reservation_status.php">Reservation Status</a></li>
	  <li class="delete"><a class="a_delete" href="admin_delete.php">Delete Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
	<p class="credential">Logged in as : <?php echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="admin_logout.php" name="logout">Log out</a>
	<div class="add_noti">
		<h3>Add a message.</h3>
		<form method="post" action="notification.php">
		<input class="input" type="text" name="noti" required><br><br>
		<input type="submit" name="add" value="SEND">
		</form>
	</div>
</body>

<?php 
 } 
 else
 { 
	header("location: admin_login.php");
 }
?>
</html>