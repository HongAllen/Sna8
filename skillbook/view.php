<?php
include_once "header.php";
extract($_REQUEST);
$user=$sql->query("select * from user where idx=$idx");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="colorbox/example1/colorbox.css" />
    <script src="colorbox/jquery.colorbox.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/20141111style.css">
</head>

<body>

<div id="myhw">
                    
                    
                    <div class="left-block">
                        <img src="upload/<?php echo $user[0]['image']?>" alt="" class="img-responsive img-circle">
                        <ul>
                            <li><?php echo $user[0]['name'];?></li>
                            
                        </ul>
                        <hr class="none">
                    </div>
                    <div class="left">
                        
                        <h2>本身技能</h2>
                        <dl>
                            <dd><?php echo $user[0]['skill'];?></dd>
                        </dl>
                        <hr>
                        <h2>想交換技能</h2>
                        <dl>
                            <dt><?php echo $user[0]['change_skill'];?></dt>
                        </dl>
                        <hr>
                        <h2>自我介紹</h2>
                        <dl>
						<dt><?php echo $user[0]['report'];?></dt>
                        </dl>
                        <h2>Email</h2>
                        <dl>
                        <dt><?php echo $user[0]['email'];?></dt>
                        </dl>

                    </div>
                    
                </div>
</body>
</html>