<?php
header("Content-Type:text/html ;charset=utf-8");
session_start();
require_once ("connect.php");
$username=$_POST['username'];
$password=$_POST['password'];
$status=$_POST['status'];
$_SESSION['id']=$username;
$_SESSION['pwd']=$password;
if(empty($username)||empty($password)){
	echo "<script>alert('密码或账号不允许为空，请重新输入！');location.href='login.html';</script>";
}
if($status=='student'){
	$sql="select * from student where Id=$username and Password=$password;";
	$res=mysqli_query($conn, $sql);
	$row=mysqli_num_rows($res);
	$rows=mysqli_fetch_assoc($res);
	if($row){
		// $_SESSION['user'] = trim($_POST['username']);
		$_SESSION['user'] = $rows['Name'];
		header("Location:students/index.php");	
	}else{
		echo "<script>window.alert('密码或账号错误，请重新输入！');history.back(1);</script>";
	}
}else if($status=='teacher'){
	$sql="select * from teacher where Id=$username and Password=$password;";
	$res=mysqli_query($conn, $sql);
	$row=mysqli_num_rows($res);
	$rows=mysqli_fetch_assoc($res);
	if($row){
		$_SESSION['user'] = $rows['Name'];
		header("Location:teachers/index.php");	
	}else{
		echo "<script>window.alert('密码或账号错误，请重新输入！');history.back(1);</script>";
	}
}else{
	$sql="select * from adminstrator where Id=$username and Password=$password;";
	$res=mysqli_query($conn, $sql);
	$row=mysqli_num_rows($res);
	$rows=mysqli_fetch_assoc($res);
	if($row){
		$_SESSION['user'] = $rows['Id'];
		 header("Location:administrators/index.php");	
	}else{
		echo "<script>window.alert('密码或账号错误，请重新输入！');history.back(1);</script>";
	}
}
mysqli_free_result();
mysqli_close($coon);
?>
