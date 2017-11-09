<?
header("Content-Type: text/html; charset=UTF-8");
$include_path = $_SERVER[DOCUMENT_ROOT]."/nu/inc/";
function dbconn($dbname="rdy1")
{
	$LocalHost = "localhost";
	$DBName = $dbname;
	$DBUser = "rdy1";
	$DBPasswd = "dkfeldhkdl1";

	$connect = mysql_connect($LocalHost,$DBUser,$DBPasswd) or die("Failed connecting to MySQL DB!");
	$connectresult = mysql_select_db($DBName,$connect);
	
	return $connect;
}

# 일정 길이 이상의 글을 잘라 준다.
function string_cut($str, $len="")
{
    global $string_cut_start, $string_cut_end;

    if( !$len )
        $len = $string_cut_end;

        $nstr = @strlen($str);
        if ($nstr <= $len)
                return $str;

    $r = @preg_split('/&#[0-9]+;/', $str, -1);
    $n = @count($r);
        $i = 0;
    $cnt = 0;
        $off = 0;
    if ($n > 1) {
                $n--;
        for(; $i < $n;  $i++) {
            $slen = @strlen($r[$i]);
            if ($cnt + $slen + 2 > $len)
                break;
            $cnt += $slen + 2;
                        $off += $slen;
                        while($str[$off++] != ';')
                                ;
        }
    }

        $off2 = 0;
    if ($len > $cnt) {
                $last = $r[$i];
                $n = $len - $cnt;
                $off2 = @strlen($last);
                if ($n < $off2) {
                        for ($off2 = 0; $off2 < $n; $off2++) {
                                if (@ord($last[$off2]) >= 128) {
                                        if (++$off2 >= $n) {
                                                $off2--;
                                                break;
                                        }
                                }
                        }
                }
        }

        $off += $off2;
        if ($off < $nstr)
                return @substr($str, 0, $off).'...';
        else
        return $str;
}



// Encrypting
function encrypt($string, $key, $iv) {
    $enc = "";
    $enc=mcrypt_cbc (MCRYPT_TripleDES, $key, $string, MCRYPT_ENCRYPT, $iv);

  return base64_encode($enc);
}

// Decrypting 
function decrypt($string, $key, $iv) {
    $dec = "";
    $string = trim(base64_decode($string));
    $dec = mcrypt_cbc (MCRYPT_TripleDES, $key, $string, MCRYPT_DECRYPT, $iv);
  return $dec;
}

$gConf['iv'] = base64_decode("rx1GqHvoQwE=");
$gConf['ENCODE_KEY'] = "123121";

//페이징 네비게이션 생성
function drawPagingUserNavi($totalCnt, $nowPage, $pageCnt = "20", $naviSize = "10", $scriptName = "goPage"  ) {
	$pageStr = "";
	$firstPG = "";
	$finalPG = "";
	$startPG = "";
	$endPG		= "";
    
	$totalPage = ceil($totalCnt / $pageCnt );
	$total_block = ceil($totalPage / $naviSize);
	$block = ceil( $nowPage / $naviSize );

	$first_page = ($block-1) * $naviSize;
	$last_page = $block * $naviSize;
	$go_page = $first_page + 1;

 	$prevPG = $first_page;
	$nextPG = $last_page + 1;
		
	if( $totalPage > 1 ) {
		$firstPG = 1;
		$finalPG = $totalPage;
	}

	if( $total_block <= $block) $last_page = $totalPage;
                				
	//이전 페이지 block 보기
	if($totalPage > 1 ) {
                        
		if( $block > 1 ) $prev_b .= "<a href=\"javascript:" . $scriptName . "('" . $prevPG . "')\"><img src='/img/common01/btn_prev.gif' border='0' align='absmiddle'></a>";
		else $prev_b .= "<a href=\"javascript:void(0)\"><img src='/img/common01/btn_prev.gif' border='0' align='absmiddle'></a>";
		
		//다음 페이지 block 보기
		if( $block < $total_block) $next_b .= "<a href=\"javascript:" . $scriptName . "('" . $nextPG . "')\"><img src='/img/common01/btn_next.gif' border='0' align='absmiddle'></a>";
		else $next_b .= "<a href=\"javascript:void(0)\"><img src='/img/common01/btn_next.gif' border='0' align='absmiddle'></a>";
		
		$pageStr .= $prev_b;
		
		for( $go_page = $go_page ; $go_page <= $last_page; $go_page++) {		
			if( $nowPage == $go_page) $pageStr .= "<strong>" . $go_page . "</strong>";
			else  $pageStr .= " <a href=\"javascript:" . $scriptName . "('" . $go_page . "')\">" . $go_page . "</a> ";
		    if($go_page != $last_page) $pageStr .= '|';
		}
		
		$pageStr .= $next_b;
		
		
    }

	
	
	return $pageStr;
	
} 

function gcUpload($file_name, $file_tmp_name, $file_size, $folder) {
    global $gConf;
    //$file_name = $file["name"];
    //$file_tmp_name = $file['tmp_name'];
    //$file_size = $file['size'];
    $file_type = explode(".", $file_name);    
    $file_type_size = count($file_type);
    $file_ext = $file_type[$file_type_size - 1];
    
    $cmd = "mkdir ".$_SERVER['DOCUMENT_ROOT'].$gConf['board_data']."/".$folder;
    $path = $_SERVER['DOCUMENT_ROOT'].$gConf['board_data']."/".$folder;
    @mkdir($path, 0777);
    
    $newName = mktime().rand(1000,9999).".".$file_ext;
    
    //echo "!".$file_tmp_name."<BR>";
    //echo $_SERVER['DOCUMENT_ROOT']."/data/$folder/$file_name";
    move_uploaded_file($file_tmp_name,$_SERVER['DOCUMENT_ROOT'].$gConf['board_data']."/$folder/$file_name") or die('파일1 Upload에 실패했습니다.');
    rename($_SERVER['DOCUMENT_ROOT'].$gConf['board_data']."/$folder/$file_name",$_SERVER['DOCUMENT_ROOT'].$gConf['board_data']."/$folder/$newName") or die('파일 rename에 실패했습니다.');
    return $path."/".$newName;
}
    
// 특수문자 변환
function specialCharsReplace($str) {
	$str = htmlspecialchars($str);
	
	$str = str_replace("'","&#039;",$str);
	$str = str_replace("\"","&quot;",$str);
	/*
	$str = str_replace("&", "&amp;", $str);
	$str = str_replace("<", "&lt;", $str);
	$str = str_replace(">", "&gt;", $str);
	*/
	return $str;
}

// 특수문자 변환 decode
function specialCharsReplaceDecode($str) {
	$str = htmlspecialchars_decode($str);
	
	$str = str_replace("&#039;","'",$str);
	$str = str_replace("&quot;","\"",$str);
	/*
	$str = str_replace("&amp;", "&",  $str);
	$str = str_replace("&lt;", "<", $str);
	$str = str_replace("&gt;", ">", $str);
	*/
	return $str;
}

function url_parse($value=""){
	parse_str($_SERVER[QUERY_STRING],$QUERY_STRING);
	$aa=explode(",",$value);
	for($a=0;$a<count($aa);$a++) unset($QUERY_STRING[$aa[$a]]);
	foreach($QUERY_STRING as $key=>$value){
		if(!$temp) $temp="$key=$value";
		else $temp.="&$key=$value";	
	}
	return $QUERY_STRING=$temp;
}
  
if($_COOKIE[sessInfo]) {
    //$deInfo = decrypt($_COOKIE[sessInfo], $gConf['ENCODE_KEY'], $gConf['iv']);
    $deInfo = urldecode($_COOKIE[sessInfo]);
    $cookieInfo = explode(" | ",$deInfo);
    if(!$connect) {
        //$connect = dbconn();
    }
}  

$fileInfo = explode("/", $_SERVER['PHP_SELF']);
$common['filename'] = $fileInfo[count($fileInfo)-1];
EXTRACT($_POST);
EXTRACT($_GET);
if($cookieInfo[0] == "" && $common['filename'] != "login_ok.php") {
    echo "<script>location = 'index.php';</script>";
    exit;
}
if($cookieInfo[2]) {
    if($cookieInfo[2] == "sampling") {
        if(!strstr($common['filename'], "sampling") && $common['filename'] != "main.php"&& $common['filename'] != "login_ok.php") {
            echo "<script>alert('해당 메뉴에 대한 권한이 없습니다.');history.go(-1);</script>";
            exit;                
        }
    } else if($cookieInfo[2] == "h_3") {
        if(!strstr($common['filename'], "data_i_129") && !strstr($common['filename'], "mea_data_c_14") && !strstr($common['filename'], "data_h_3") && $common['filename'] != "main.php"&& $common['filename'] != "login_ok.php") {
            echo "<script>alert('해당 메뉴에 대한 권한이 없습니다.');history.go(-1);</script>";
            exit;                
        }        
        
        if(strstr($common['filename'], "mea_data_i_129")) {
            echo "<script>alert('해당 메뉴에 대한 권한이 없습니다.');history.go(-1);</script>";
            exit;                            
        }        
    } else if($cookieInfo[2] == "data") {
        if(!strstr($common['filename'], "trus_") && !strstr($common['filename'], "data_") && $common['filename'] != "main.php"&& $common['filename'] != "login_ok.php") {
            echo "<script>alert('해당 메뉴에 대한 권한이 없습니다.');history.go(-1);</script>";
            exit;                
        }  
        
        if(strstr($common['filename'], "mea_")) {
            echo "<script>alert('해당 메뉴에 대한 권한이 없습니다.');history.go(-1);</script>";
            exit;                            
        }
        
        if(strstr($common['filename'], "data_h_3") ||  strstr($common['filename'],"data_i_129")) {
            echo "<script>alert('해당 메뉴에 대한 권한이 없습니다.');history.go(-1);</script>";
            exit;                            
        }
    } else if($cookieInfo[2] == "mea") {
        if(!strstr($common['filename'], "counter_") && !strstr($common['filename'], "mea_") && $common['filename'] != "main.php"&& $common['filename'] != "login_ok.php") {
            echo "<script>alert('해당 메뉴에 대한 권한이 없습니다.');history.go(-1);</script>";
            exit;                
        }                

        if(strstr($common['filename'], "data_h_3") ||  strstr($common['filename'],"data_i_129") ||  strstr($common['filename'],"mea_data_c_14")) {
            echo "<script>alert('해당 메뉴에 대한 권한이 없습니다.');history.go(-1);</script>";
            exit;                            
        }        
    }
    
    /*
    if(!strstr($common['filename'], $cookieInfo[2]) && $cookieInfo[2] != "" && $common['filename'] != "main.php"&& $common['filename'] != "login_ok.php") {
        if("data_h_3" == $cookieInfo[2] && strstr($common['filename'],"mea_data_c_14")) {
            
        } else {
            echo "<script>alert('해당 메뉴에 대한 권한이 없습니다.');history.go(-1);</script>";
            exit;    
        }
    }
    */
    if($cookieInfo[3] == "Y") $right = "Y";
} else {
    $right = "Y";
}
if($searchCon) {
    $word = $searchCon;
    $key = "make_sample_name";
}
?>