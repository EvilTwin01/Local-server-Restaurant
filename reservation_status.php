<?php 
session_start();
if(session_id()=='' || isset($_SESSION['user'])){
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "1234";
$dbname = "coffeecorner";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		
  $sql  = "SELECT * FROM add_reservation";
  $result = mysqli_query($connection, $sql);
	
  if(!$result)
  {
	 die("database query fail!" . mysqli_error($connection) . mysqli_errno($connection));
  }
?>

<!doctype html>
<html>
<head>
<link href="reservation_status.css?v={random number/string}" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<title>Admin | Status</title>
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
	<p class="credential">Logged in as : <?php echo $_SESSION['user']; ?></p>
	<a class="button_logout" href="admin_logout.php" name="logout">Log out</a>
	
	<div class=details_box>
	<h2>Update Status</h2>
  <?php	
	// table reservation details
	
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
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['reserve_id']; ?></td>  
            <td contenteditable="false"><?php echo $row['no_of_people']; ?></td> 
            <td><?php echo date('d/m/Y', strtotime($row['date'])); ?></td> 
            <td><?php echo date('h:i a', strtotime($row['time'])); ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php
    }
}else{
		echo "<script type='text/javascript'>alert('No reservation to be approved. No customer yet!'); window.location.href = \"admin.php\";</script>"; 
	}
     echo         "</tr>";
     echo  "</table>";
	// end table reservation details
  ?>
	</div>
	<!--drop down -->
	<div class="listdrop">
	<?php 
		$sql  = "SELECT * FROM add_reservation";
		$result = mysqli_query($connection, $sql);	
	?>
		<h4>Select a Reservation ID to approved:</h4>
		<form id="form" action="status2.php" method="get">
		<?php
		echo "<select name=\"Reservation_ID\" form=\"form\">";
		while ($row = mysqli_fetch_array($result)) 
  		{
			$gg = $row['reserve_id'];
   			 echo "<option value='" . $gg . "' name=\"reserve_id\">" . $gg . "</option>";
		}
		echo "</select>";	
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