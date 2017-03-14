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
	if(isset($_POST['delete']))
	{
		header("location: admin_view.php");
	}
  //header("location: user_dashboard.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User | Delete</title>
<link href="user_delete.css?v=random number/string" rel="stylesheet" type="text/css">
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
	<h3 class="h3">Cancel Reservation</h3>
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
	<div class="delete1">
    <?php	
	// table reservation details
	echo "<table width=\"1200\" border=\"1\" cellspacing=\"0px\" cellpadding=\"50px\">";
    echo     "<tr>";
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
            <td><?php echo $row['reserve_id']; ?></td>  
            <td><?php echo $row['no_of_people']; ?></td> 
            <td><?php echo date('d/m/Y', strtotime($row['date'])); ?></td> 
            <td><?php echo date('h:i a', strtotime($row['time'])); ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php
    }
}else{
		echo "<script type='text/javascript'>alert('You cant cancel your reservation. You need to add some first.'); window.location.href = \"user_addreservation.php\";</script>"; 
	}
     echo         "</tr>";
     echo  "</table>";
	// end table reservation details
  ?>
  <!--drop down -->
	<div class="dropdown">
	<?php 
		$sql  = "(SELECT * FROM add_reservation WHERE username like '$user')";
		$result = mysqli_query($connection, $sql);
	?>
		<h2>Reservation Update</h2>
		<p>Select reservation id you wish to cancel:</p>
		<form id="form" action="deletedetail.php" method="get">
		<?php
		echo "<select name=\"Reservation_ID\" form=\"form\">";
		while ($row = mysqli_fetch_array($result)) 
  		{
			$gg = $row['reserve_id'];
   			 echo "<option value='" . $gg . "' name=\"reserve_id\">" . $gg . "</option>";
		}
		echo "</select>";
		//$_SESSION['reserve'] = $gg;
		?>
		<input type="submit" name="form" value="Submit">
		</form>
	</div>
	<!-- end drop down -->
  <?php
	if(isset($_REQUEST['deleteFile']))  
	{var_dump($_REQUEST);
    if(isset($_POST['checkbox']))
    {

        print_r($_POST);
    }
}
?>
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