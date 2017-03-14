<?php 
	session_start();
	if(session_id()=='' || isset($_SESSION['username'])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "1234";
    $dbname = "coffeecorner";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$user = $_SESSION['username'];
	if(isset($_GET['save']))
	{
		$id = mysqli_real_escape_string($connection, $_GET['aa']);
		
		$sql1 = "DELETE FROM `add_reservation` WHERE `reserve_id` = '$id'";
		$result1 = mysqli_query($connection, $sql1);
		
		if(!$result1)
		{
			die("database query fail!" . mysqli_error($connection) . mysqli_errno($connection));
		}
	
		header("location: user_view.php");
	}else if(isset($_GET['save1'])){
		header("location: user_view.php");
	}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User | Dashboard</title>
<link href="deletedetail.php" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<link href="deletedetail.css?v=random number/string" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.11.1.min.js"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.datepicker.min.js"></script>
</head>

<body class="ggwp">
	<h2 class="h2">Coffee Corner</h2>

<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a class="dashtext" href="user_dashboard.php">Dashboard</a></li>
	  <li class="add"><a class="add2" href="user_addreservation.php">Make a reservation</a></li>
	  <li class="view"><a class="view2" href="user_view.php">View Reservation</a></li>
	  <li class="update"><a class="update2" href="user_update.php">Update Reservation</a></li>
	  <li class="delete"><a class="delete2" href="user_delete.php">Cancel Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
<div>
	<h3 class="h3">Reservation Details</h3>
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
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
	// table reservation
	echo "<div class=\"table\">";
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
	echo "<form method=\"get\" action=\"deletedetail.php\">";
	echo    "<input type=\"hidden\" name=\"aa\" value=\"$identifier\">";
	echo "<h3>Are you sure to cancel?</h3>";
	echo	"<input class=\"cancel\" type=\"submit\" name=\"save\" value=\"YES\">";
	echo	"<input class=\"cancel\" type=\"submit\" name=\"save1\" value=\"NO\"><br><br>";
	echo	"</form>";	
	echo "</div>";
}
?>

</body>

<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>
</html>