<?php
class aceClass {
	
	function connectDB(){
		$dbConnection =  mysqli_connect('localhost','root','','acestore');
		return $dbConnection;
		}
	
	}
?>