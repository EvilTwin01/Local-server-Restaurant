<?php 
	session_start();
	if(session_id()=='' || isset($_SESSION['user'])){
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "1234";
	    $dbname = "coffeecorner";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	    if(isset($_POST['delete']))
		{
			$noti = mysqli_real_escape_string($connection,$_POST['noti']);
			
			$sql1  = "DELETE * FROM notification WHERE noti_id = '$noti'";
			$result1 = mysqli_query($connection, $sql1);
			
			if(!$result1)
		  {
			 die("database query fail!" . mysqli_error($connection) . mysqli_errno($connection));
		  }		
		}	

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
<link href="notification1.css" rel="stylesheet" type="text/css">
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
<div>
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['user']; ?></p>
	<a class="button_logout" href="admin_logout.php" name="logout">Log out</a>
	<div class="table">
	<h2>Notification Details</h2>
 <?php	
	// table reservation details
	echo "<table width=\"1200\" border=\"1\" cellspacing=\"0px\" cellpadding=\"50px\">";
    echo     "<tr>";
	echo     "<th>Notification</th>";
	echo     "<th>Option</th>"; 
    echo "</tr>";
    echo "<tr>";
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?php echo $row['noti_text']; ?></td>  
			<td>
     			<form action="notification1.php" method="post">
      		    <a href="admin.php"><input type="button" value="SEND" name="send"></a>
      			<input type="hidden" value="1" name="noti">
				<a href="noti_delete.php"><input type="button" value="DELETE" name="delete"></a>
				</form>
       		</td>
        </tr>
        <?php
    }
}else{
		echo "<script type='text/javascript'>alert('No notification found. Please add notification first!'); window.location.href = \"notification.php\";</script>"; 
	}
     echo         "</tr>";
     echo  "</table>";
	// end table reservation details
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