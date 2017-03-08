<?php
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "1234";
	    $dbname = "coffeecorner";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		$sql1  = "DELETE FROM notification WHERE noti_id = '1'";
		$result1 = mysqli_query($connection, $sql1);
			
		if($result1){
			echo "<script type='text/javascript'>alert('Delete success!')</script>";
			header("location: admin.php");
		}
		else if(!$result1)
	    {
			 die("database query fail!" . mysqli_error($connection) . mysqli_errno($connection));
	    }		
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>