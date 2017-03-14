<?php 
session_start();
if(session_id()=='' || isset($_SESSION['user'])){
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "1234";
$dbname = "coffeecorner";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		
  $sql  = "SELECT * FROM add_reservation";
  $result = mysqli_query($connection, $sql);

  if(!$result)
  {
	 die("database query fail!" . mysqli_error($connection) . mysqli_errno($connection));
  }
	
	if(isset($_POST['submit']))
	{
		$selected_val = $_POST['sort'];  // Storing Selected Value In Variable
		echo "You have selected :" .$selected_val;
		
		if($selected_val=="ASC")
		{
			header("location: ascending.php");
		}
		else if($selected_val=="DESC")
		{
			header("location: descending.php");
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
<style>
body {
    margin: 0;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 25%;
    background-color: #f1f1f1;
    position: fixed;
    height: 100%;
    overflow: auto;
}

li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

li a.active {
    background-color: #4CAF50;
    color: white;
}

li a:hover:not(.active) {
    background-color: #555;
    color: white;
}
</style>
</head>
<body>

<ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>

<div class=details_box>
	<h2>Customer Reservation</h2>
	<div class="gg">
<form action="" method="post">
  <select name="sort">
    <option value="ASC">Ascending</option>
    <option value="DESC">Descending</option>
  </select>
<input type="submit" name="submit" value="SORT BY DATE">
</form>
</div>
  <?php	
	// table reservation details
	echo "<table width=\"1200\" border=\"1\" cellspacing=\"0px\" cellpadding=\"50px\">";
    echo     "<tr>";
    echo     "<th>Username</th>";
	echo     "<th>Reservation ID</th>";
    echo     "<th>Total Person</th>";
    echo     "<th>Date</th>";
	echo     "<th>Time</th>";
	echo     "<th>Status</th>";
    echo "</tr>";
    echo "<tr>";
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['reserve_id']; ?></td>  
            <td contenteditable="false"><?php echo $row['no_of_people']; ?></td> 
            <td><?php echo date('d/m/Y', strtotime($row['date'])); ?></td> 
            <td><?php echo date('h:i a', strtotime($row['time'])); ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php
    }
}else{
		echo "<script type='text/javascript'>alert('No reservation to be displayed. No customer yet!'); window.location.href = \"admin.php\";</script>"; 
	}
     echo         "</tr>";
     echo  "</table>";
	// end table reservation details
  ?>
	</div>

</body>

<?php 
 } 
 else
 { 
	header("location: admin_login.php");
 }
?>
</html>
