<?php
session_start();
if(session_id()=='' || isset($_SESSION['username'])){
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "1234";
  $dbname = "coffeecorner";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
  $user = $_SESSION['username'];
	//$reserve_id = mysqli_real_escape_string($connection, $_POST['reserve_id']);
		
  $sql = "(SELECT * FROM add_reservation WHERE username like '$user')";
  $result = mysqli_query($connection, $sql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit your reservation</title>
</head>
<body>
	<div>
		<h2>Reservation Update</h2>
		<p>Select Reservation ID to edit:</p>
		<form id="form" action="edit.php" method="post">
		<?php
		echo "<select name=\"Reservation ID\" form=\"form\">";
		while ($row = mysqli_fetch_array($result)) 
  		{
			$gg = $row['reserve_id'];
   			 echo "<option value='" . $gg . "' name=\"reserve_id\">" . $gg . "</option>";
		}
		echo "</select>";
		$_SESSION['reserve'] = $gg;
		?>
		<input type="submit" name="form" value="Submit">
		</form>
	</div>
	<?php
  if(isset($_POST['form']))
  {
	//echo $_POST['Reservation_ID'];
	//print_r($_POST);
	$identifier = $_POST['Reservation_ID']; 
	$sql1 = "SELECT * FROM add_reservation WHERE reserve_id LIKE '$identifier'";
	$result1 = mysqli_query($connection, $sql1);
	
	while($row = mysqli_fetch_array($result1))
	{
		echo "Reservation Details";
		//echo $row['no_of_people'];
	}
  }
	?>

</body>

<?php 
 } 
 else
 { 
	header("location: login.php");
 }
?>

</html>