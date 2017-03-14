<?php 
session_start();
if(session_id()=='' || isset($_SESSION['username'])){
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "1234";
  $dbname = "coffeecorner";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(isset($_POST['submit']))
	{
		$username = $_SESSION['username'];
		$no_of_people = mysqli_real_escape_string($connection, $_POST['people']);
		$date = mysqli_real_escape_string($connection, $_POST['from']);
		$time = mysqli_real_escape_string($connection, $_POST['user_time']);
		$status = mysqli_real_escape_string($connection, $_POST['status']);
		
		if(isset($_POST['submit']))
		{
			$sql = "INSERT INTO add_reservation(username,user_id,no_of_people,date,time,status) VALUES('$username','$userid','$no_of_people',STR_TO_DATE('$date','%m/%d/%Y'),'$time','$status')";
			$result = mysqli_query($connection, $sql);
			
			if(!$result)
			{
				die("database query fail!" . mysqli_error($connection));
			}
			header("location: user_view.php");
		}
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User | Add Reservation</title>
<link href="user_add.css?v=random number/string" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
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
	<h3 class="h3"></h3>
</div>

<aside>
  <p class="credential">Logged in as : <?php echo $_SESSION['username']; ?></p>
	<a class="button_logout" href="logout.php" name="logout">Log out</a>
</aside>

<section class="space">
	<h2>Add Reservation</h2><br><br>
	<form  method="post" action="user_addreservation.php">
		Number of people: 
		<input type="number" name="people" min="1" max="20" required><br></br>
		<label for="from">Select date:</label> <input type="text" id="from" name="from" required/><br><br>
		Select time:
		<input type="time" name="user_time" required><br></br>
		<input type="hidden" name="status" value="Pending">
		<input type="submit" name="submit"><br><br>
	</form>	
	<!--We are holding this table for you for = <span id="timer"></span>-->
</section>
<section class="current">
	<h4>Current Date and Time</h4><br>
	<?php
		echo "Today date: " . date("d/m/Y") . "<br>";
    ?>
  <p>Time: <span id="clock"></span></p>
</section>

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
	document.getElementById('timer').innerHTML =
  01 + ":" + 00;
startTimer();

function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
	
  if(m<0)
  {
	  alert('timer completed');
      exit();
  }
  
  document.getElementById('timer').innerHTML =
    m + ":" + s;
  setTimeout(startTimer, 1000);
}

function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
  if (sec < 0) {sec = "59"};
  return sec;
}

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
</body>

<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>
</html>