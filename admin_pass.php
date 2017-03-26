<?php 
session_start();
if(session_id()=='' || isset($_SESSION['user'])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "1234";
	$dbname = "coffeecorner";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		
	$user = $_SESSION['user'];
	
	if(isset($_POST['submit'])){
		
		$old = $_POST['old'];
		$new = $_POST['new'];
		$username = $_SESSION['user'];
		
		$sql = "SELECT * FROM admin WHERE user='$username' AND pass='$old'";
		$result = mysqli_query($connection, $sql);
		
	 if(mysqli_num_rows($result) == 1)
	  {
		  $sql1 = "UPDATE admin FROM SET pass='$new' WHERE user='$username'";
		  $result1 = mysqli_query($connection, $sql1);
		  
	  }else{
		  echo "<script type='text/javascript'>alert('You are now logged in!')</script>";
		  //header("location: admin.php");
	  }
	}
	//header("location: admin.php");
?>

<!doctype html>
<html>
<head>
<link href="admin_pass.css?v=random number/string" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<title>Admin | Dashboard</title>
</head>

<body class="ggwp">

<h2 class="h2">Coffee Corner</h2>
<nav>
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
<div>
	<h1 class="h3">Welcome <?php echo $user . "!"; ?></h1>
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['user']; ?></p>
	<a class="button_logout" href="admin_logout.php" name="logout">Log out</a>
	<div class="admin_detail">
	<form method="post" action="admin_pass.php">
	Old Password:
	<input type=text name="old">
	New Password:
	<input type=text name="new">
	<input type="button" name="submit" value="submit">
	</form>
	</div>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
</body>

<?php 
 } 
 else
 { 
	header("location: admin_login.php");
 }
?>
</html>