<?php 
	session_start();
	//if(session_id()=='' || isset($_SESSION['username'])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "1234";
    $dbname = "coffeecorner";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$user = $_SESSION['username'];	

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User | Dashboard</title>
<link href="editform.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h2 class="h2">Coffee Corner</h2>

<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a>Dashboard</a></li>
	  <li class="add"><a>Make a reservation</a></li>
	  <li class="view"><a>View Reservation</a></li>
	  <li class="update"><a>Update Reservation</a></li>
	  <li class="delete"><a>Delete Reservation</a></li>
	  <li class="border-bottom"><a></a></li>
  </ul>
</nav>
<div>
	<h3 class="h3">Welcome <?php echo $_SESSION['username']. "."; ?></h3>
</div>
	<p class="credential">Logged in as : <?php echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
	<!-- edit -->
	<?php
	if(isset($_POST['form']))
{
	//echo $_POST['Reservation_ID'];
	//print_r($_POST);
	$identifier = $_POST['Reservation_ID']; 
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
        </tr>
        <?php
    	}
  	}
     echo         "</tr>";
     echo  "</table>";
	echo "</div>";
	//end table
}
	?>
	<div class="addform">
	<!-- form -->
		<form method="post" action="user_addreservation.php">
		Number of people: 
		<input type="number" name="people" min="1" max="20"><br></br>
		<label for="from">Select date:</label> <input type="text" id="from" name="from"/><br><br>
		Select time:
		<input type="time" name="user_time"><br></br>
		<input type="submit" name="submit"><br><br>
		</form>	
	<!-- end from-->
	</div>
</body>

<script type="text/javascript">
 	var dateToday = new Date();
	var dates = $("#from").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});
</script>

<script>
	function updateClock ( )
 	{
 	var currentTime = new Date ( );
  	var currentHours = currentTime.getHours ( );
  	var currentMinutes = currentTime.getMinutes ( );
  	var currentSeconds = currentTime.getSeconds ( );
		
  	// Pad the minutes and seconds with leading zeros, if required
  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  	// Choose either "AM" or "PM" as appropriate
  	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  	// Convert the hours component to 12-hour format if needed
  	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  	// Convert an hours component of "0" to "12"
  	currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  	// Compose the string for display
  	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
  	
  	
   	$("#clock").html(currentTimeString);
   	  	
 }

$(document).ready(function()
{
   setInterval('updateClock()', 1000);
});
</script>

<?php 
 //} 
 //else
 //{ 
	//header("location: login.php");
 //}
?>
</html>