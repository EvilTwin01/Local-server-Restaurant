<?php
  // 1. Create a database connection
  session_start();
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "1234";
  $dbname = "coffeecorner";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  // Test if connection succeeded
  if(mysqli_connect_errno()) 
  {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }else
  		echo "success!"
  
?>