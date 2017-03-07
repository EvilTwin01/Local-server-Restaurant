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
		$no_of_people = mysqli_real_escape_string($connection, $_GET['people']);
		$date = mysqli_real_escape_string($connection, $_GET['from']);
		$time = mysqli_real_escape_string($connection, $_GET['user_time']);
		
		$sql1 = "UPDATE add_reservation SET no_of_people = '$no_of_people', date = '$date', time = '$time' WHERE reserve_id = '$identifier'";
		$result1 = mysqli_query($connection, $sql1);
		
		if(!$result1)
		{
			die("database query fail!" . mysqli_error($connection));
		}
		echo $identifier;
		header("location: test.php");
	}

?>

<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>