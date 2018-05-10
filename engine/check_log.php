<?php 
session_start();
if(isset($_SESSION['user_email']) && isset($_SESSION['user_password']) &&isset($_SESSION['user_id'])){
	
	
include('ourClass.php');

//Get Database Connection from Classs
$myClass = new aceClass();
$dbConx = $myClass->connectDB();

	
	$user_email = $_SESSION['user_email'];
	$user_password = $_SESSION['user_password'];
	$user_id = $_SESSION['user_id'];
	
	$sql = "SELECT firstname,lastname,telephone,photo FROM members WHERE email='$user_email' AND password='$user_password' AND id='$user_id' LIMIT 1";
	$query = mysqli_query($dbConx,$sql) or die(mysqli_error($dbConx));
	$checkExist = mysqli_num_rows($query);
	
	if($checkExist==0){header('location: login.php');exit();}
	else if($checkExist==1){
		while($row = mysqli_fetch_array($query)){
			$memberFirstname = $row[0];
			$memberLastname = $row[1];
			$memberTelephone = $row[2];
			$memberPhoto = $row[3];
			
			if($memberPhoto==''){$memberPhoto='default.png';}
			
			
			}
		}
	
	
	}else{
		header('location: login.php'); exit();
		}
?>
