<?php 
	//session_start();
	//if(session_id()=='' || isset($_SESSION['user'])){
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "1234";
	    $dbname = "coffeecorner";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	    //$user = $_SESSION['username'];	

		$sql  = "SELECT * FROM notification WHERE noti_id = '1'";
		$result = mysqli_query($connection, $sql);

		  if(!$result)
		  {
			 die("database query fail!" . mysqli_error($connection) . mysqli_errno($connection));
		  }
?>

<!doctype html>
<html>
<head>
<link href="notification.css" rel="stylesheet" type="text/css">
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
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['user']; ?></p>
	<a class="button_logout" href="admin_logout.php" name="logout">Log out</a>
	<div class="table">
	<h2>Confirm</h2>
 <?php	
	// table reservation details
	echo "<table width=\"1200\" border=\"1\" cellspacing=\"0px\" cellpadding=\"50px\">";
    echo     "<tr>";
	echo     "<th>Notification</th>";
	echo     "<th>Confirmation</th>"; 
    echo "</tr>";
    echo "<tr>";
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?php echo $row['noti_text']; ?></td>  
			<td>
     			<a method="post" action="">
      				<a href="edit1.php"><input type="button" value="SEND"></a>
				</a>
       		</td>
        </tr>
        <?php
    }
}
     echo         "</tr>";
     echo  "</table>";
	// end table reservation details
  ?>
	</div>
</body>

<?php 
 //} 
 //else
 //{ 
	//header("location: login.php");
 //}
?>
</html>