<?php
$host="localhost";
$username="root";
$password="123456";
$db="select_course1";
$conn=mysqli_connect($host,$username,$password);
if(!$conn){
	echo "link failure";
	exit;
}
mysqli_select_db($conn,$db);
mysqli_query($conn,"SET NAMES UTF8");
?>