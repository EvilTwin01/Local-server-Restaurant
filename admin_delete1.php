<?php 
	session_start();
	if(session_id()=='' || isset($_SESSION['user'])){
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "1234";
	    $dbname = "coffeecorner";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	    $user = $_SESSION['user'];	

		$sql  = "SELECT * FROM add_reservation";
		$result = mysqli_query($connection, $sql);

		  if(!$result)
		  {
			 die("database query fail!" . mysqli_error($connection) . mysqli_errno($connection));
		  }
?>

<!
<!doctype html>
<html>
<head>
<link href="admin_delete1.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<title>Admin | Delete</title>
</head>

<body style="background-color: #F9F9F9">

<h2 class="h2">Coffee Corner</h2>
<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a href="admin.php">Dashboard</a></li>
	  <div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Notification</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="notification.php">Add Notification</a>
    <a href="notification1.php">View Notification</a>
  </div>
</div>
	  <li class="view"><a href="admin_view.php">View Reservation</a></li>
	  <li class="update"><a href="reservation_status.php">Reservation Status</a></li>
	  <li class="delete"><a href="admin_delete.php">Delete Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
	<p class="credential">Logged in as : <?php echo $_SESSION['user']; ?></p>
	<a class="button_logout" href="admin_logout.php" name="logout">Log out</a>
	<!--drop down -->
	<div class="ddropdown">
		<h2>Delete Reservation</h2>
		<p>Select Reservation ID to delete:</p>
		<form id="form" action="admin_deletedetail.php" method="get">
		<?php
		echo "<select name=\"Reservation_ID\" form=\"form\">";
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