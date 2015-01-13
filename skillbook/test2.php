<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>留言板</title>
</head>
<body>
<a href="post.php">留言</a><br>
<?php
    require("use_mysql.php");
              $query = "SELECT name,title,time,text FROM board ORDER BY no DESC LIMIT 0,10";
              $result = use_mysql($query);
              while($row = mysql_fetch_array($result)){
?>
                            <font style="background-color:#9999FF">標題：</font>
                            <?php echo $row['title'] ?><br>
                            <font style="background-color:#CCFFFF ">作者：</font>
                            <?php echo $row['name'].'('.$row['time'].')' ?><br>
                            <?php echo $row['text'] ?><br>
<?php
              }
?>
</body>
</html>