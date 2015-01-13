<?php
function use_mysql($query)
{
              $link = mysql_connect("mysql1.000webhost.com","a1456595_skill","Olis00000")
                            or die('連結資料庫失敗');
              mysql_select_db("a1456595_skill", $link)             
                            or die('載入資料庫失敗');
              mysql_query('SET CHARACTER SET utf8');
              $result = mysql_query($query,$link);
              mysql_close( $link );
              return $result;
}
?>