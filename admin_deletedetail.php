<?php 
	session_start();
	if(session_id()=='' || isset($_SESSION['user'])){
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "1234";
	    $dbname = "coffeecorner";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	$user = $_SESSION['user'];
	if(isset($_GET['save']))
	{
		$id = mysqli_real_escape_string($connection, $_GET['aa']);
		
		$sql1 = "DELETE FROM `add_reservation` WHERE `reserve_id` = '$id'";
		$result1 = mysqli_query($connection, $sql1);
		
		if(!$result1)
		{
			die("database query fail!" . mysqli_error($connection) . mysqli_errno($connection));
		}
	
		header("location: admin_view.php");
	}

?>

<!doctype html>
<html>
<head>
<link href="admin_deletedetail.css" rel="stylesheet" type="text/css">
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
	<!-- edit -->
<?php
	//$identifier =  '';
	if(isset($_GET['form']))
{
	//echo $_POST['Reservation_ID'];
	//print_r($_POST);
	$identifier = $_GET['Reservation_ID']; 
	$sql = "SELECT * FROM add_reservation WHERE reserve_id LIKE '$identifier'";
	$result = mysqli_query($connection, $sql);
	// table reservation+
	echo "<div class=\"tablee\">";
	echo "<table width=\"1200\" border=\"1\" cellspacing=\"0px\" cellpadding=\"50px\">";
    echo     "<tr>";
	echo     "<th>Username</th>";
	echo     "<th>Reservation ID</th>";
    echo     "<th>Total Person</th>";
    echo     "<th>Date</th>";
	echo     "<th>Time</th>";
	echo     "<th>Status</th>";
    echo "</tr>";
    echo "<tr>";
    if (mysqli_num_rows($result) > 0) 
	{
    	while ($row = mysqli_fetch_array($result)) {
?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['reserve_id']; ?></td>  
            <td><?php echo $row['no_of_people']; ?></td> 
            <td><?php echo date('d/m/Y', strtotime($row['date'])); ?></td> 
            <td><?php echo date('h:i a', strtotime($row['time'])); ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
<?php
    	}
  	}
     echo         "</tr>";
     echo  "</table>";
	echo "</div>";
	//end table
	echo "<div class=\"addform\">";
	echo "<form method=\"get\" action=\"admin_deletedetail.php\">";
	echo    "<input type=\"hidden\" name=\"aa\" value=\"$identifier\">";
	echo	"<input type=\"submit\" name=\"save\" value=\"Delete\"><br><br>";
	echo	"</form>";	
	echo "</div>";
}
?>	
	
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