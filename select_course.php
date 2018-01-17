<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html;charset=utf-8">
<style>
	body{
			font-size: 20px;font-family: verdana;width:100%;
		}
		div.page{
			text-align: center;
		}
		div.content{
			height: 300px;
		}
		div.page a{
			border:#00f 1px solid;text-decoration: none;padding: 2px 5px 2px 5px;margin: 2px;
		}
		div.page span.current{
			border:blue 1px solid ;background-color: blue;padding: 4px 6px;margin: 2px;color:#fff;font-weight: bold;
		}
		div.page span.disable{
			border:#eee 1px solid;padding:2px 5px;margin: 2px;color :#ddd;
		}
		div.page form{
			display:inline;
		}
</style>
</head>
<body>
<?php
require_once("connect.php");
$page=$_GET['p'];
$pageSize=10;
$showPage=5;
$sql="select * from student limit".($page-1)*$pageSize.",{$pageSize}";
$result=mysqli_query($conn,$sql);
echo "<div class='content'>";
echo "<table border=1 cellspacing=0 width=40% align=center>";
echo "<tr><td>Id</td><td>Name</td></tr>";
$row=mysqli_fetch_assoc($result);
while($row){
	echo "<tr>";
	echo "<td>{$row['Id']}</td>";
	echo "<td>{$row['Name']}</td>";
	echo "</tr>";
}
echo "</table>";
echo "</div>";
mysqli_free_result($result);
$total_sql="select count(*) from student";
$total_result=mysqli_fetch_array(mysqli_query($conn,$total_sql));
$total=$total_result[0];
$total_pages=ceil($total/$pageSize);
#echo $toatl."页";
mysqli_close($conn);
$page_banner="<div class='page'>";
$page_offset=($showPage-1)/2;

if($page>1){
	$page_banner.="<a href='".$_SERVER['PHP_SELF']."?p=1'>首页</a>";
	$page_banner.="<a href='".$_SERVER['PHP_SELF']."?p=".($page-1)."'><上一页</a>";
}else{
	$page_banner.="<span class='disable'>首页</a></span>";
	$page_banner.="<span class='disable'><上一页</a></span>";
}
$start=1;
$end=$total_pages;
if($total_pages>$showPage){
	if($page>$page_offset+1){
		$page_banner.="...";
	}
	if($page>$page_offset){
		$start=$page-$page_offset;
		$end=$total_pages>$page+$page_offset?$page+$page_offset:$total_pages;
	}else{
		$start=1;
		$end=$total_pages>$showPage?$showPage:$total_pages;
	}
	if($page+$page_offset>$total_pages){
		$start=$start-($page+$page_offset-$end);

	}
}
for($i=$start;$i<$end;$i++){
	if($page==$i){
		$page_banner.="<span class='current'>{$i}</span>";
	}else{
		$page_banner.="<a href=".$_SERVER['PHP_SELF']."?p=".$i."'>{$i}</a>";
	}
}
if($total_pages>$showPage && $total_pages>$page+$page_offset){
	$page_banner.="...";
}
if($page<$total_pages){
	$page_banner.="<a href=".$_SERVER['PHP_SELF']."?p=".($page+1)."'>下一页></a>";
	$page_banner.="<a href=".$_SERVER['PHP_SELF']."?p=".($total_pages)."'>尾页</a>";
}
$page_banner.="共{$total_pages}页,";
$page_banner.="<form action='select_course.php' method='post'>";
$page_banner.="跳转到第<input type='text' size='3' name='p'>页";
$page_banner.="<input type='submit' value='确定'>";
$page_banner.="</form></div>";
echo $page_banner;
?>
</body>
</html>
