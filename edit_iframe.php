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
		$reserve_id = mysqli_real_escape_string($connection, $_POST['reserve_id']);
		
		$sql = "(SELECT * FROM add_reservation WHERE reserve_id like '$reserve_id')";
	    $result = mysqli_query($connection, $sql);
			
		if(!$result)
		{
			die("database query fail!" . mysqli_error($connection));
		}
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Iframe</title>
<link href="user_add.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.11.1.min.js"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.datepicker.min.js"></script>
</head>

<body>
	<form action="edit_iframe.php" method="post">
		Number of people: 
		<input type="number" name="people" min="1" max="20"><br></br>
		<label for="from">Select date:</label> <input type="text" id="from" name="from"/><br><br>
		Select time:
		<input type="time" name="user_time"><br></br>
		<input type="submit" name="submit"><br><br>
	</form>

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

</body>
<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>
</html>