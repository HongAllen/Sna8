 <!DOCTYPE html>
 <html>
 
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/20141111style.css">
    <link rel="stylesheet" href="css/signin.css">
 </head>
 <body>
 <?php 
 session_start();
 include_once "header.php";
 extract($_POST);
 if(isset($account))
 {
	$user=$sql->query("select * from user where account = '$account' and pwd = '$pwd'");

	if(empty($user[0]['idx']))
	{
		echo "<script>alert('帳號密碼錯誤!');</script>";
	}
	else
	{
		$_SESSION['name'] = $user[0]['name'];
		$_SESSION['account'] = $user[0]['account'];
		echo 	"<script>parent.$.fn.colorbox.close();
				window.parent.location.reload();</script>";
	}
	
 }
 ?>
<form id='form1' action='login.php' method="post" class="form-signin">
<h2 class="form-signin-heading">請登入吧</h2>
 <input type="text" name="account" id="account" class="form-control" placeholder="帳號">
 <input type="password" name="pwd" id="pwd" class="form-control" placeholder="密碼">
 <input type="submit" value="登入" class="btn btn-lg btn-primary btn-block">
 <input type="button" value="註冊" onClick="window.location='register.php'"class="btn btn-lg btn-primary btn-block">
 </form>

 </body>
 </html>