<?php
function pr($content,$hr=false) {
	if (is_array($content)) {
		echo '<pre>';
		print_r($content);
		echo '</pre>';
	} else { echo '<pre>',$content,'</pre>'; }
	
	echo ($hr)?'<hr>':'';
}

function redirect($filename) {
    if (!headers_sent())
        header('Location: '.$filename);
    else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$filename.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
        echo '</noscript>';
    }
}

function mkdirs($path) {
	if (!file_exists($path)) { 
		$arr = explode("/",$path); $path = "";
		if (is_array($arr)) {
			for ($i = 0 ; $i < count($arr); $i++) {
				if ($arr[$i] != ""){
					if ($arr[0] == "") {	$path .= "/".$arr[$i]; }
					else {$path .= $arr[$i]."/";}
					if(!file_exists($path)) { mkdir($path,0777); }
				}
			}
		}
	}
}

function isMobile() {
	if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT'])) { return true;
	} else { return false; }
		
		#header('Location: http://detectmobilebrowser.com/mobile');
}

function createAuthString ($arg_intLength) {
    srand((double)microtime()*1000000); 
    $strLetters = range ('A','Z');
    $strNumbers = range(0,9);
    $arrayChars = array_merge($strLetters,$strNumbers);
    $strRandString ='';
    for ( $i=0;$i<$arg_intLength;$i++ ) {
        shuffle($arrayChars);
        $strRandString .= $arrayChars[0];
    }
	$strRandString .="ETMGROUP"; 
    return array(substr($strRandString,0,4),md5(base64_encode($strRandString) ) );
}  

function checkAuthString($keyin='',$auth='abcd') {
	$keyin .="ETMGROUP"; 
	#pr(md5(base64_encode($keyin)));	pr($auth);
	return (md5(base64_encode($keyin))==$auth);
}

function getMIMEType($file) { 
// our list of mime types 
$mime_types = array( 
					"pdf"=>"application/pdf"
				   ,"exe"=>"application/octet-stream" 
				   ,"zip"=>"application/zip" 
				   ,"docx"=>"application/msword" 
				   ,"doc"=>"application/msword" 
				   ,"xls"=>"application/vnd.ms-excel" 
				   ,"ppt"=>"application/vnd.ms-powerpoint" 
				   ,"gif"=>"image/gif" 
				   ,"png"=>"image/png" 
				   ,"jpeg"=>"image/jpg" 
				   ,"jpg"=>"image/jpg" 
				   ,"mp3"=>"audio/mpeg" 
				   ,"wav"=>"audio/x-wav" 
				   ,"mpeg"=>"video/mpeg" 
				   ,"mpg"=>"video/mpeg" 
				   ,"mpe"=>"video/mpeg" 
				   ,"mov"=>"video/quicktime" 
				   ,"avi"=>"video/x-msvideo" 
				   ,"3gp"=>"video/3gpp" 
				   ,"css"=>"text/css" 
				   ,"jsc"=>"application/javascript" 
				   ,"js"=>"application/javascript" 
				   ,"php"=>"text/html" 
				   ,"htm"=>"text/html" 
				   ,"html"=>"text/html" 
				   );
	$arr = explode('.',$file);
	$name = end($arr);
	$extension = strtolower($name); return $mime_types[$extension]; 
} 

function objectVars($stdclassobject){
    $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
    foreach ($_array as $key => $value) {
        $value = (is_array($value) || is_object($value)) ? object_to_array($value) : $value;
        $array[$key] = $value;
    }
    return $array;
}

function fitImageSize($width=0,$height=0,$max_width=0,$max_height=0) {	
	if ($width<$max_width && $height < $max_height) {
		$rate = $max_width/$width;
		$width = $width*$rate; $height = $height*$rate;
	}
	
	if ($width > $max_width) {
		$height = round($height/($width/$max_width));
		$width = $max_width;
	}
	if ($height > $max_height) {
		$width = round($width/($height/$max_height));
		$height = $max_height;
	}
	return array($width,$height,"width=\"$width\" height=\"$height\"");
}


function browserInfo($agent=null) {
  $known = array('msie', 'firefox', 'safari', 'webkit', 'opera', 'netscape','konqueror', 'gecko');
  $agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
  $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9]+(?:\.[0-9]+)?)#';
  if (!preg_match_all($pattern, $agent, $matches)) return array();
  $i = count($matches['browser'])-1;
  return array(
			   'browser'=>$matches['browser'][$i]
			   ,'version' => $matches['version'][$i]
			   );
}

function getFiles($index_key='',$prefix='') {
	$return_data = array();
	$sn = time();
	if (empty($index_key)){
		$keys = array_keys($_FILES);
		for ($index=0;$index<count($keys);$index++) {
			$return_data[$keys[$index]] = getFileByKey($keys[$index],$prefix);
		}
	} else { $return_data = getFileByKey($index_key,$prefix); }
	return $return_data;
}
function getFileByKey($index_key='',$prefix='') {
	$return_data = array();
	$sn = time();
	if(is_array($_FILES[$index_key]['tmp_name'])) {
		echo "Array";
		for ($i=0;$i<count($_FILES[$index_key]['tmp_name']);$i++) {
			$return_data[$i]['name'] = $_FILES[$index_key]['name'][$i];
			$return_data[$i]['type'] = $_FILES[$index_key]['type'][$i];
			$return_data[$i]['tmp_name'] = $_FILES[$index_key]['tmp_name'][$i];
			$return_data[$i]['error'] = $_FILES[$index_key]['error'][$i];
			$return_data[$i]['size'] = $_FILES[$index_key]['size'][$i];
			
			if ($return_data[$i]['error'] !='0') { continue; }
			
			$arr = explode('.',$_FILES[$index_key]['name'][$i]);
			$return_data[$i]['ext_name'] = strtolower(array_pop($arr));
			$return_data[$i]['rename'] = $prefix.$sn.'.'.$return_data[$i]['ext_name'];
			if (strpos($_FILES[$index_key]['type'][$i],'image') !== false) {
				list($width, $height) = getimagesize($_FILES[$index_key]['tmp_name'][$i]);
				$return_data[$i]['width'] = $width;
				$return_data[$i]['height'] = $height;		
			}
		}
	} else {
		if ($_FILES[$index_key]['error'] =='0') {
			$arr = explode('.',$_FILES[$index_key]['name']);
			$_FILES[$index_key]['ext_name'] = strtolower(array_pop($arr));
			$_FILES[$index_key]['rename'] = $prefix.$sn.'.'.$_FILES[$index_key]['ext_name'];
			if (strpos($_FILES[$index_key]['type'],'image') !== false) {
				list($width, $height) = getimagesize($_FILES[$index_key]['tmp_name']);
				$_FILES[$index_key]['width'] = $width;
				$_FILES[$index_key]['height'] = $height;		
			}
		}
		$return_data = $_FILES[$index_key];
	}
	return $return_data;
}

function getIP() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) { $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }
 
    return $ip;
}

function pagination($page=1,$total_cnt=0,$total_page=0,$query_str='',$index='index.php',$target='_self') {
	if ($total_cnt > 0) {
	
		$next_page = ($page+1 > $total_page)? $total_page : $page+1 ;
		$prev_page = ($page-1 < 1)? 1 : $page-1;
?>
<a href="<?php echo $index."?page=1".$query_str; ?>" target="<?php echo $target; ?>">最前頁</a> <a href="<?php echo $index."?page=".$prev_page.$query_str; ?>" target="<?php echo $target; ?>">上一頁</a> 
<?php
// 分頁
if ($total_page > 1) {

	$s_page = ($page%10 ==0)? $page-9 : $page-$page%10+1;
	$e_page = (($s_page+9) > $total_page)? $total_page : $s_page+9 ;
	for ($i = $s_page; $i <= $e_page;$i++) {
		if ($i == $page) { echo "["; }
		?><a href="<?php echo $index."?page=".$i.$query_str; ?>" target="<?php echo $target; ?>"><?php echo $i; ?></a>&nbsp;<?php
		if ($i == $page) { echo "]"; }
		if ($i < $e_page) { echo "　"; }
	}

} else { echo "1"; }
?>
&nbsp;<a href="<?php echo $index."?page=".$next_page.$query_str; ?>" target="<?php echo $target; ?>">下一頁</a> <a href="<?php echo $index."?page=".$total_page.$query_str; ?>" target="<?php echo $target; ?>">最末頁</a>

<?php	

	} else { echo '<div style="height:50px; margin-top:20px;">目前無資料</div>'; } 

}


?>