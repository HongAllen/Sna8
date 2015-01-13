<?php
session_start();
include_once "header.php";
extract($_POST);
$info=$sql->query("select * from user where account='".$_SESSION['account']."'");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="colorbox/example1/colorbox.css" />
    <script src="colorbox/jquery.colorbox.js"></script>
<title>無標題文件</title>
</head>

<body>
<?php
if(isset($submit))
{
			$filename = $info[0]['image'];
			$uuid=uniqid();
			$time=time();
			$fileexplode=explode(".",$_FILES['file']['name']);
			$filetype=end($fileexplode);
			$fileurl = "thumb/".$_FILES['file']['name'];
			if(($_FILES['file']['type']=="image/jpeg"||$filetype=="jpeg"||$_FILES['file']['type']=="image/jpg"||$filetype=="jpg"||$_FILES['file']['type']=="image/png"||$filetype=="png"||$_FILES['file']['type']=="image/gif"||$filetype=="gif")&&!empty($_FILES['file']['name'])){
				$filename =$uuid."_".$time.".".$filetype;
				$datatype=strtolower($_FILES["file"]["type"]);
	
				switch ($datatype){
					case "image/jpg":{
						$src = imagecreatefromjpeg($_FILES['file']['tmp_name']);
						break;	
					}
					case "jpg":{
						$src = imagecreatefromjpeg($_FILES['file']['tmp_name']);
						break;	
					}
					case "JPG":{
						$src = imagecreatefromjpeg($_FILES['file']['tmp_name']);
						break;	
					}
					case "image/jpeg":{
						$src = imagecreatefromjpeg($_FILES['file']['tmp_name']);
						break;
					}
					case "jpeg":{
						$src = imagecreatefromjpeg($_FILES['file']['tmp_name']);
						break;
					}
					case "JPEG":{
						$src = imagecreatefromjpeg($_FILES['file']['tmp_name']);
						break;
					}
					case 'image/gif':{
						$src = imagecreatefromgif($_FILES['file']['tmp_name']);
						break;
					}	
					case 'gif':{
						$src = imagecreatefromgif($_FILES['file']['tmp_name']);
						break;
					}	
					case 'GIF':{
						$src = imagecreatefromgif($_FILES['file']['tmp_name']);
						break;
					}	
					case 'image/png':{
						$src = imagecreatefrompng($_FILES['file']['tmp_name']);
						break;
					}
					case 'png':{
						$src = imagecreatefrompng($_FILES['file']['tmp_name']);
						break;
					}	
					case 'PNG':{
						$src = imagecreatefrompng($_FILES['file']['tmp_name']);
						break;
					}	
				}

				copy($_FILES['file']['tmp_name'],'upload/'.$uuid."_".$time.".".$filetype);//複製檔案
}



	$now=date('Y-m-d H:i:s');
	$insert=$sql->execute("UPDATE `user` SET `name`='$user_name',`skill`='$skill',`change_skill`='$change_skill',`report`='$report',`email`='$email',`image`='$filename' WHERE account ='".$_SESSION['account']."'");
	echo 	"<script>parent.$.fn.colorbox.close();
	window.parent.location.reload();</script>";
}

?>
使用者註冊:
<form action="edit.php" method="post" enctype="multipart/form-data">
<table width="100%" border="1">
  <tr>
    <td>姓名</td>
    <td><input name="user_name" id="user_name" type="text" value="<?php echo $info[0]['name'];?>" /></td>
  </tr>
  <tr>
    <td>使用者圖片</td>
    <td>
    <img src="upload/<?php echo $info[0]['image'];?>" width="70">
    <br>
    <input name="file" id="file" type="file" /></td>
  </tr>
  <tr>
    <td>本身技能</td>
    <td><input name="skill" id="skill" type="text" value="<?php echo $info[0]['skill'];?>"/></td>
  </tr>
  <tr>
    <td>想交換技能</td>
    <td><input name="change_skill" id="change_skill" type="text" value="<?php echo $info[0]['change_skill'];?>"/></td>
  </tr>
  <tr>
    <td>交換心得</td>
    <td><textarea name="report" id="report" cols="30" rows="5"><?php echo $info[0]['report'];?></textarea></td>
  </tr>
  <tr>
    <td>連絡方式</td>
    <td><input name="email" id="email" type="text" value="<?php echo $info[0]['email'];?>" /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input name="" type="submit" onclick="return check();" />
    </div></td>
    </tr>
</table>
<input name="submit" id="submit" type="hidden" value="1" />
</form>

<script>
function check()
{
	if(document.getElementById('user_name').value=='')
	{
		alert('請填寫姓名');
		return false;
	}
	if(document.getElementById('skill').value=='')
	{
		alert('請填寫技能');
		return false;
	}
	if(document.getElementById('change_skill').value=='')
	{
		alert('請填寫交換技能');
		return false;
	}
	if(document.getElementById('report').value=='')
	{
		alert('請填寫心得');
		return false;
	}
	if(document.getElementById('email').value=='')
	{
		alert('請填寫Email');
		return false;
	}
	var email = document.getElementById('email').value;
	 if ( !email.match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)){
　　　alert('Email格式錯誤'); return false;
}
	
}
</script>
</body>
</html>