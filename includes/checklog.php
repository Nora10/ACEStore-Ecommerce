<?php
session_start();
include_once('konnect.php');
if(isset($_SESSION['memberid']) && isset($_SESSION['memberemail']) && isset($_SESSION['memberpassword'])){
	$memberid= mysqli_real_escape_string($dbConnection,$_SESSION['memberid']);//rescreen session for harmful manipulation by modafuckers
	$memberemail= mysqli_real_escape_string($dbConnection,$_SESSION['memberemail']);
	$memberpassword= mysqli_real_escape_string($dbConnection,$_SESSION['memberpassword']);
	$sql= "SELECT fullname FROM members WHERE email='$memberemail' AND pass1='$memberpassword' AND id='$memberid' LIMIT 1"; 
		$query=mysqli_query($dbConnection, $sql);
		if(mysqli_num_rows($query)<1){header('location:index.php');exit();}
		else{
			while($row = mysqli_fetch_array($query)){
  $memberfullname = $row[0];
  
  }
}
}
else{
	header('location:index.php');exit();
}


?>