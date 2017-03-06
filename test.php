<?php
session_start();
if(session_id()=='' || isset($_SESSION['username'])){
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "1234";
  $dbname = "coffeecorner";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  $user = $_SESSION['username'];

if(isset($_POST['form']))
{
	echo $_POST['Reservation_ID'];
	//print_r($_POST);
	$identifier = $_POST['Reservation_ID']; 
	$sql1 = "SELECT * FROM add_reservation WHERE reserve_id LIKE '$identifier'";
	$result1 = mysqli_query($connection, $sql1);
	
	while($row = mysqli_fetch_array($result1))
	{
		echo $row['no_of_people'];
	}
}

?>

<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>