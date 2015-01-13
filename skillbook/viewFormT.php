<?php
session_start();
include_once "header.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="colorbox/example1/colorbox.css" />
    <script src="colorbox/jquery.colorbox.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/20141111style.css">
    <title>SkillEXC</title>
</head>

<body>
    <!--Navication-->
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#">SkillEXC</a>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="#about">ABOUT</a>
                                    </li>
                                    <li><a href="#works">VIEW CASES</a>
                                    </li>
                                </ul>
                                
                                <div align="right">
                                <?php 
								if(isset($_SESSION['account']))
								{
								?>
                                <img  title="登出" src="img/logout.png" style="cursor:pointer" onclick="window.location='logout.php'">
                                <?php 
								}
								else{
								?>
                                <img  title="登入" src="img/login.jpg" style="cursor:pointer" onclick="login();" width="100">
                                <?php }?>
                                </div>
                                <?php?>
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!--Slider-->
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="position:relative; height:300px;">
                <div class="aSlider">

                </div>

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <div data-holder-rendered="true">
                            <h3>交換技能，無限可能</h3>
                            </div>
                        </div>
                        <div class="item ">
                            <div data-holder-rendered="true">
                            <h3>免費獲取新技能</h3>
                            </div>
                        </div>
                        <div class="item">
                            <div data-holder-rendered="true">
                            <h3>實現未完成的夢想</h3>
                            </div>
                        </div>
                    </div>
                    <!--  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>-->
                </div>
            </div>
        </div>
    </div>
    <!--/Slider-->


    <!--bg-top-->
    <div class="bg-top">
        <img src="img/bg-top.png" height="66" width="100%" alt="">
    </div>
    <!--/bg-top-->

    <!--mainContent-->
     <div class="bg-black">
     <div class="container">
            <div class="row">
                    <!-- works -->
                    <div class="row">
                        <!-- title -->
                        <div class="col-md-12">
                            <h2 id="works" class="text-center">VIEWCASES</h2>
                            <hr class="none middle">
                        </div>
                        <!-- work list -->
<?php 
$query="select * from user";
$number=$sql->query($query);
$datanumber=count($number); 
$per = 9; //每頁顯示項目數量
$pages = ceil($datanumber/$per); 
if(!isset($_GET["page"])){
    $page=1; //設定起始頁
}else{
    $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    $page = ($page > 0) ? $page : 1; //確認頁數大於零
    $page = ($pages > $page) ? $page : $pages; //確認使用者沒有輸入太神奇的數字
	}

$start = ($page-1)*$per;
$query.=" ORDER BY `idx` desc LIMIT  $start , $per";
$users=$sql->query($query);
			 foreach($users as $row)
			 {
?>
                        <div class="col-md-4">
                         <div class="top-PF"> </div>
                            <div class="workItem">
                                <div class="wi-h">
                                <p onclick="viewuser(<?php echo $row['idx'];?>);" style="cursor:pointer;" ><?php echo $row['name'];?></p>
                                    <img src="upload/<?php echo $row['image'];?>" onclick="viewuser(<?php echo $row['idx'];?>);" style="cursor:pointer;"  class="circleProfile position-PF"  >
                                </div>
                                <div class="wi-b">
                                    <h3>本身技能</h3>
                                    <p><?php echo $row['skill'];?></p>
                                    <h3>想交換技能</h3>
                                    <p><?php echo $row['change_skill'];?></p>
                                </div>
                            </div>
                        </div>
                <?php }?>   
                            </div>
                        </div>
                        <!-- /work list -->
                        <table align="center">
							<tr>
								<td>
                                	<a style="color:#FFF; word-spacing:2px; margin-left: 5px; margin-right: 5px;" href="<?php echo "?page=1&rstart=$rstart&rend=$rend&select=$select";?>">第一頁</a>
                                </td>
								<td>
                                	<a style="color:#FFF; word-spacing:2px; margin-left: 5px; margin-right: 5px;" href="<?php 
$prepage=$page-10;
if($prepage<1){$prepage=1;}
echo "?page=$prepage&rstart=$rstart&rend=$rend&select=$select";?>"> 前十頁</a>
								</td>
<?php
$endpage=$page+9;
if($endpage>$pages){$endpage=$pages;}
if($pages<10){
	for($i=1;$i<=$pages;$i++) {
		if($i==$page){
			echo "<td><a style='color:#FFF; href='?page=$i&rstart=$rstart&rend=$rend&select=$select'>[" . $i . "]</a></td>";
		}else{
    		echo "<td><a href='?page=$i&rstart=$rstart&rend=$rend&select=$select'>" . $i . "</a></td>";
			}
	}
}else{
	for($i=$page;$i<=$endpage;$i++) {
		if($i==$page){
			echo "<td><a style='color:#FFF; word-spacing:2px;' href='?page=$i&rstart=$rstart&rend=$rend&select=$select'>[" . $i . "]</a></td>";
		}else{
    		echo "<td><a style='color:#333; word-spacing:2px;' href='?page=$i&rstart=$rstart&rend=$rend&select=$select'>" . $i . "</a></td>";
			}
	}
  }
?>
								<td>
                                	<a style="color:#FFF; word-spacing:2px; margin-left: 5px; margin-right: 5px;" href="<?php 
$postpage=$page+10;
if($postpage>$pages){$postpage=$pages;}
echo "?page=$postpage&rstart=$rstart&rend=$rend&select=$select";?>">下十頁</a>
								</td>
								<td><a style="color:#FFF; word-spacing:2px; margin-left: 5px; margin-right: 5px;" href="<?php 
echo "?page=$pages&rstart=$rstart&rend=$rend&select=$select";?>">最末頁</a>
								</td>
							</tr>
						</table>
                    </div>
                    <!-- /works -->

                    

                </div>
            </div>
        </div>
    </div>
    <!--/main content-->

    <!--bg-bottom-->
    <div class="bg-bottom">
        <img src="img/bg-bottom.png" height="66" width="100%" alt="">
    </div>
    <!--/bg-top-->

    <hr class="middle none">

    <!--footer-->
    <div class="container">
        <div class="row"></div>
        <div class="col-md-4 col-md-offset-4 text-center">
            <h2>CONTACT</h2>
            <b><a href="mailto:yy0124125@gmail.com">yy0124125@gmail.com</a></b>
            <b>聯絡窗口 曾小姐</b>
        </div>

    </div>
    <!--/footer-->

    <hr class="max none">
<script>
function viewuser(userid)
{
	$.colorbox({href:'view.php?idx='+userid, iframe: true,width:'70%',height:'100%'});
}
function edit(userid)
{
	$.colorbox({href:'edit.php?idx='+userid, iframe: true,width:'50%',height:'70%'});
}
function login()
{
    $.colorbox({href:'login.php', iframe: true,width:'25%',height:'30%'});
}
</script>
</body>

</html>
