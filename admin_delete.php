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
	if(isset($_POST['delete']))
	{
		header("location: user_view.php");
	}
?>

<!doctype html>
<html>
<head>
<link href="admin_delete.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<title>Admin | Delete Reservation</title>
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
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['user']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
	<div class="delete1">
   	<h3>Delete Reservation</h3>
    <?php	
	// table reservation details
	echo "<table width=\"1200\" border=\"1\" cellspacing=\"0px\" cellpadding=\"50px\">";
    echo     "<tr>";
	echo     "<th>Reservation ID</th>";
    echo     "<th>Total Person</th>";
    echo     "<th>Date</th>";
	echo     "<th>Time</th>";
	echo     "<th>Status</th>";
	echo     "<th>Option</th>"; 
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
			<td>
			<a method="post" action="admin_delete1.php">
				<!--<input type="hidden" value="<?php //$row['reserve_id']; ?>" name="hidden">-->
				<a href="admin_delete1.php"><input type="button" value="DELETE" name="delete"></a><br>
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