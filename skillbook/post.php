<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
</head>
<body>
<?php
              require('FCKeditor/fckeditor.php') ;
              require('use_mysql.php');
              if ( !isset( $_POST['name'] ) ){ ?>
              <form action="post.php" method="post">
              作者：<input name="name" type="text" size="20" maxlength="20"><br>
              標題：<input name="title" type="text" size="80" maxlength="50"><br>
 
              <?php
              $oFCKeditor = new FCKeditor('FCKeditor1') ;
              $oFCKeditor->BasePath              = "/FCKeditor/" ;
              $oFCKeditor->ToolbarSet = "Basic";
              $oFCKeditor->Width  = '100%' ;
              $oFCKeditor->Height = '400' ;
              $oFCKeditor->Create() ;
              ?>
              <br>
              <input type="submit" value="輸入">
              </form>
<?php
              }else{
                            $name = $_POST['name'];
                            $title = $_POST['title'];
                            $text = $_POST['FCKeditor1'];
                            $query = "INSERT INTO board (name,title,text) "
                                                        ."VALUES ('$name','$title','$text')";
                            use_mysql($query)
                                          or die('留言失敗');
                            echo '<META HTTP-EQUIV=REFRESH CONTENT="0;URL=test2.php">';
              }
?>
 
</body>
</html>