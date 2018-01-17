<?php
header("Content-Type:text/html ;charset=utf-8");
require_once("../connect.php");
session_start();
$student=$_SESSION['id'];
$page=$_GET['p'];
$pageSize=10;
$total_sql="select count(*) from(select curricula.Name as a,teacher.Name as b,teacher.Dates_Enrollment,academy.Name as c,speciality.Name as d,teacher.Sex,teacher.Nation,teacher.BirthPlace,teacher.BirthDay,teacher.Phone,teacher.EMail
from teacher,academy,speciality,curricula_variable,shouke,curricula where curricula_variable.Student_Id='$student'and curricula_variable.Curricula_Id=shouke.Curricula_Id and shouke.Teacher_Id=teacher.Id and teacher.Academy=academy.Id and teacher.Speciality=speciality.Id and curricula.Id=curricula_variable.Curricula_Id) sc";


$total_result=mysqli_fetch_array(mysqli_query($conn,$total_sql));
$total=$total_result[0];
$total_pages=ceil($total/$pageSize);
if($page>$total_pages+1){
    echo "<script>alert('无此页'); window.location.href=\"queryteacher.php?p=1\";
                window.event.returnValue = false;</script>";
}
$showPage=5;
$start=($page-1)*$pageSize;
$sql="select curricula.Name as a,teacher.Name as b,teacher.Dates_Enrollment,academy.Name as c,speciality.Name as d,teacher.Sex,teacher.Nation,teacher.BirthPlace,teacher.BirthDay,teacher.Phone,teacher.EMail
from teacher,academy,speciality,curricula_variable,shouke,curricula where curricula_variable.Student_Id='$student'and curricula_variable.Curricula_Id=shouke.Curricula_Id and shouke.Teacher_Id=teacher.Id and teacher.Academy=academy.Id and teacher.Speciality=speciality.Id and curricula.Id=curricula_variable.Curricula_Id limit {$start},{$pageSize}";
$res1=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../css/bootstrap.css" type="text/css" rel="stylesheet" />
    <link href="../images/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        function bbb(){
            var text=document.getElementById('aaa').value;
            if(text=='') {
                alert("请输入页号！");
                window.location.href="teacherInfo.php?p=1";
                window.event.returnValue = false;
            }
        }
    </script>
    <style type="text/css">
        body {
            background:#FFF
        }
        div.page{
            background-color: white;
            text-align: center;
            height: 50px;
        }
        div.page input{
            border:1px solid #1D7AD9;
        }
        div.content{
            height: 50px;
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
<body >
<div id="contentWrap">
    <div class="pageTitle">&nbsp;&nbsp;<span>当前位置 -- 信息查询 -- 任课教师信息查询</span></div>
    <div class="pageColumn">
        <div class="pageButton"><h1 style="text-align:center">&nbsp;&nbsp;任课教师信息查询统计表</h1></div>
<table class="table table-bordered table-striped" align="center" id="table1" >
    <thead align="center">
    <td>
        课程名称
    </td>
    <td>
        教师姓名
    </td>
    <td>
        入校时间
    </td>
    <td>
        学院名称
    </td>
    <td>
        专业名称
    </td>
    <td>
        教师性别
    </td>
    <td>
        民族
    </td>
    <td>
        出生地
    </td>
    <td>
        出生日期
    </td>
    <td>
        联系方式
    </td>
    <td>
        邮箱
    </td>
    </thead>
    <tbody align="center">
    <?php while($arr=mysqli_fetch_array($res1)){
        ?>
        <tr>
            <td><?php echo $arr[a]?></td>
            <td><?php echo $arr[b]?></td>
            <td><?php echo $arr[Dates_Enrollment]?></td>
            <td><?php echo $arr[c]?></td>
            <td><?php echo $arr[d]?></td>
            <td><?php echo $arr[Sex]?></td>
            <td><?php echo $arr[Nation]?></td>
            <td><?php echo $arr[BirthPlace]?></td>
            <td><?php echo $arr[BirthDay]?></td>
            <td><?php echo $arr[Phone]?></td>
            <td><?php echo $arr[EMail]?></td>
        </tr>
    <?php }?>
    </tbody>
</table>
</div></div>
<?php
mysqli_close($conn);
$page_banner="<div class='page'>";
$page_offset=($showPage-1)/2;

if($page>1){
    $page_banner.="<br/><a href='".$_SERVER['PHP_SELF']."?p=1'>首页</a>";
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
$page_banner.="<form action='teacherInfo.php' method='get'>";
$page_banner.="跳转到第<input type='text' size='3' name='p' id='aaa'>页";
$page_banner.="<input type='submit' value='确定' onclick='bbb()'>";
$page_banner.="</form></div>";
echo $page_banner;?>
</body>
</html>