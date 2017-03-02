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
  //header("location: user_dashboard.php");
		
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User | View Reservation</title>
<link href="user_view.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h2 class="h2">Coffee Corner</h2>
	<h3 class="details">Reservation Details</h3>
<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a href="user_dashboard.php">Dashboard</a></li>
	  <li class="add"><a href="user_addreservation.php">Make a reservation</a></li>
	  <li class="view"><a href="user_view.php">View Reservation</a></li>
	  <li class="update"><a>Update Reservation</a></li>
	  <li class="delete"><a>Delete Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
	<p class="credential">Logged in as : <?php echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
	<div class=details_box>
  <?php	
	$results=mysql_query($sql,$connection);
	$row = array();
  echo "<table width=\"200\" border=\"1\" cellspacing=\"0px\" cellpadding=\"10px\">";
  echo "<tbody>";
  echo  "<tr>";
  echo  "<td>Name</td>";
  echo  "<td>Number of people</td>";
  echo  "<td>Date</td>";    
  echo  "<td>Time</td>";   
  echo  "<td>Status</td>";    
  echo  "</tr>";  
	while($rows[]=mysql_fetch_array($results))
	{
  echo  "<tr>";  
  echo  "<td>$user</td>";    
  echo  "<td></td>";   
  echo  "<td>&nbsp;</td>";    
  echo  "<td>&nbsp;</td>";    
  echo  "<td>&nbsp;</td>";     
  echo  "</tr>";  
  echo  "</tbody>"; 
  echo  "</table>"; 
	}
  ?>
		<p><?php echo "Customer name: " . $user; ?></p>
		<p><?php 
			//while($row = mysqli_fetch_assoc($result))
			{ 
				//var_dump($row); 
				echo "Number of people: " . $row["no_of_people"] . "</br><br>";
				echo "Date: " . $row["date"] . "</br><br>";
				echo "Time: " . $row["time"] . "</br><br>";
			} 
			?></p>
	</div>
</body>

<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>
</html>