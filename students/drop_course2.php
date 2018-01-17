<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>选课系统界面</title>
    <link href="../images/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../javascript/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            //setMenuHeight
            $('.menu').height($(window).height()-51-27-26);
            $('.sidebar').height($(window).height()-51-27-26);
            $('.page').height($(window).height()-51-27-26);
            $('.page iframe').width($(window).width()-15-168);

            //menu on and off
            $('.btn').click(function(){
                $('.menu').toggle();

                if($(".menu").is(":hidden")){
                    $('.page iframe').width($(window).width()-15+5);
                }else{
                    $('.page iframe').width($(window).width()-15-168);
                }
            });

            //
            $('.subMenu a[href="#"]').click(function(){
                $(this).next('ul').toggle();
                return false;
            });
        })
    </script>
</head>
<body>
<div id="wrap">
    <div id="header" >
        <div class="logo fleft"></div>
        <div class="nav fleft">
            <ul>
                <div class="nav-left fleft"></div>
                <li class="first"><a href="index.php">返回首页</a></li>
                <li><a href="informations.php">通知预览</a></li>
                <li><a href="help_informations.php">帮助信息</a></li>
                <div class="nav-right fleft"></div>
            </ul>
        </div>
        <div style="float:right"><label style="color:#075587"><?php echo $_SESSION['user']?>&nbsp;同学,欢迎您！</label>
        <a class="logout fright" href="../login.html"> </a></div>
        <div class="clear"></div>
        <div class="subnav">
            <div class="subnavLeft fleft"></div>
            <div class="fleft"></div>
            <div class="subnavRight fright"></div>
        </div>
    </div><!--#header -->
    <div id="content">
        <div class="space"></div>
        <div class="menu fleft">
            <ul>
                <li class="subMenuTitle">导航栏</li>
                <li class="subMenu"><a href="#">网上选课</a>
                    <ul>
                        <li><a href="optional_course2.php">选修课</a></li>
                        <li><a href="general_course2.php">通识课</a></li>
                        <li><a href="drop_course2.php">退课</a></li>
                    </ul>
                </li>
                <li class="subMenu"><a href="#" target="right">信息维护</a>
                    <ul>
                        <li><a href="showStuInfo1.php">个人信息</a></li>
                        <li><a href="changeStuPwd1.php">密码修改</a></li>
                    </ul>
                </li>
                <li class="subMenu"><a href="#" target="right">信息查询</a>
                    <ul>
                        <li><a href="Schedulequery1.php">学生个人课表查询</a></li>
                        <li><a href="teacherInfo1.php">任课教师信息查询</a>
                        <li><a href="courseInfo1.php">课程信息查询</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="sidebar fleft"><div class="btn"></div></div>
        <div class="page">
            <iframe width="100%" scrolling="auto" height="100%" frameborder="true" allowtransparency="true" style="border: medium none;" src="drop_course.php?p=1" id="rightMain" name="right">
            </iframe>
        </div>
    </div><!--#content -->
    <div class="clear"></div>
    <div id="footer"></div><!--#footer -->
</div><!--#wrap -->
<div style="text-align:center;">
    <p>© 版权所有 计科1302张金小组</p>
</div>
</body>
</html>