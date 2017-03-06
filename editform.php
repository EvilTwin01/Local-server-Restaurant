<?php 
	session_start();
	//if(session_id()=='' || isset($_SESSION['username'])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "1234";
    $dbname = "coffeecorner";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$user = $_SESSION['username'];

	if(isset($_POST['save']))
	{
		$no_of_people = mysqli_real_escape_string($connection, $_POST['people']);
		$date = mysqli_real_escape_string($connection, $_POST['from']);
		$time = mysqli_real_escape_string($connection, $_POST['user_time']);
		
		$sql1 = "UPDATE add_reservation SET no_of_people = '$no_of_people', date = '$date', time = '$time' WHERE reserve_id = '$identifier'";
		$result1 = mysqli_query($connection, $sql1);
		
		if(!$result1)
		{
			die("database query fail!" . mysqli_error($connection));
		}
	
		header("location: user_view.php");
	}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User | Dashboard</title>
<link href="editform.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.11.1.min.js"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.datepicker.min.js"></script>
</head>

<body>
	<h2 class="h2">Coffee Corner</h2>

<nav class="navbar">
  <ul class="ul">
	  <li class="dashboard"><a>Dashboard</a></li>
	  <li class="add"><a>Make a reservation</a></li>
	  <li class="view"><a>View Reservation</a></li>
	  <li class="update"><a href="user_update.php">Update Reservation</a></li>
	  <li class="delete"><a>Delete Reservation</a></li>
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
	echo "<div class=\"addform\">";
	echo "<h3>Please fill in new details:</h3>";
	echo "<form method=\"post\" action=\"test.php\">";
	echo	"Number of people: ";
	echo	"<input type=\"number\" name=\"people\" min=\"1\" max=\"20\"><br></br>";
	echo	"<label for=\"from\">Select date:</label> <input type=\"text\" id=\"from\" name=\"from\"/><br><br>";
	echo	"Select time:";
	echo	"<input type=\"time\" name=\"user_time\"><br></br>";
	echo	"<input type=\"submit\" name=\"save\" value=\"save\"><br><br>";
	echo	"</form>";	
	echo "</div>";
}
?>
	<!--<div class="addform">
		<h3>Please fill in new details:</h3>
		<form method="post" action="editform.php">
		Number of people: 
		<input type="number" name="people" min="1" max="20"><br></br>
		<label for="from">Select date:</label> <input type="text" id="from" name="from"/><br><br>
		Select time:
		<input type="time" name="user_time"><br></br>
		<input type="submit" name="save" value="save"><br><br>
		</form>	
	</div>-->

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
</body>

<?php 
 //} 
 //else
 //{ 
	//header("location: login.php");
 //}
?>
</html>