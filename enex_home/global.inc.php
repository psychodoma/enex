<?
/*************************************************
사이트 공통 인크루드 파일
*************************************************/
@header("Content-Type: text/html; charset=UTF-8");
@ini_set('display_errors','Off');
@session_start();
extract($_REQUEST);


// SSL 연결 정보
$gSSLUrl = "https://mall.enex.co.kr";


// site url 정보
$gImageServerUrl = "http://image.enex.co.kr";
$gEnexHomeUrl = "https://www.enex.co.kr";

$gEnexKitchenUrl = "http://kitchen.enex.co.kr";
$gEnexSmartUrl = "http://smart.enex.co.kr";
$gEnexOfellaUrl = "http://ofella.enex.co.kr";
$gEnexInreriorUrl = "http://interior.enex.co.kr";
$gEnexMallUrl = "http://mall.enex.co.kr/shop";
/*
$gEnexKitchenUrl = "http://www.enexkitchen.co.kr";
$gEnexSmartUrl = "http://www.enexsmart.co.kr";
$gEnexOfellaUrl = "http://www.ofella.co.kr";
$gEnexInreriorUrl = "http://www.enexinterior.co.kr";
*/

$siteType = "";
if( $_SERVER["HTTP_HOST"]=="home.enex.co.kr" || $_SERVER["HTTP_HOST"]=="211.43.195.200" || $_SERVER["HTTP_HOST"] == "enex.co.kr" || $_SERVER["HTTP_HOST"] == "www.enex.co.kr" ) {
	$siteType = "home";
} else if( $_SERVER["HTTP_HOST"]=="mall.enex.co.kr" || $_SERVER["HTTP_HOST"]=="" ) {
	$siteType = "mall";
} else if( $_SERVER["HTTP_HOST"]=="kitchen.enex.co.kr" || $_SERVER["HTTP_HOST"]=="www.enexkitchen.co.kr" || $_SERVER["HTTP_HOST"]=="enexkitchen.co.kr"
 				|| $_SERVER["HTTP_HOST"]=="www.enexsmart.co.kr" || $_SERVER["HTTP_HOST"]=="enexsmart.co.kr" || $_SERVER["HTTP_HOST"]=="smart.enex.co.kr" ) {
 	$siteType = "kitchen";
} else if( $_SERVER["HTTP_HOST"]=="interior.enex.co.kr" || $_SERVER["HTTP_HOST"]=="www.enexinterior.co.kr" || $_SERVER["HTTP_HOST"]=="enexinterior.co.kr" ) {
	$siteType = "interior";
} else if( $_SERVER["HTTP_HOST"]=="ofella.enex.co.kr" || $_SERVER["HTTP_HOST"]=="www.ofella.co.kr" || $_SERVER["HTTP_HOST"]=="ofella.co.kr" ) {
	$siteType = "ofella";
}	


define("_IMAGES_URL_", "/images");
define("_GLOBAL_CSS_", "/global/css");
define("_GLOBAL_JS_", "/global/js");
define("_GLOBAL_INC_", "/global/inc");

$gcBoardPathWeb = "/global";
$gcBoardSkinDir = $_SERVER["DOCUMENT_ROOT"]."/global/board/skin/";

$fileInfo = explode("/",$_SERVER["REQUEST_URI"]);

################# 모바일 체크 ####################
function MobileCheck() { 
    global $HTTP_USER_AGENT; 
    $MobileArray  = array("iphone","lgtelecom","skt","mobile","samsung","nokia","blackberry","android","android","sony","phone");

    $checkCount = 0; 
        for($i=0; $i<sizeof($MobileArray); $i++){ 
            if(preg_match("/$MobileArray[$i]/", strtolower($HTTP_USER_AGENT))){ $checkCount++; break; } 
        } 
   return ($checkCount >= 1) ? "Mobile" : "PC"; 
}

if(MobileCheck() == "Mobile" && $fileInfo[1] != "m"){ 

	$_SESSION['ismobile'] = true;
	$thisUrl = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; 
	if ($_SERVER["REQUEST_URI"] == '/') {
		echo "<script>window.location.href='/m/'</script>";
	}
/*
	if ((substr($thisUrl, -2) != '/m') && (substr($thisUrl, -3) != '/m/') || (strpos($thisUrl, 'content.php') == false)) {
		echo "<script>window.location.href='/m/'</script>";
	}
*/
	
}



//#

################# 모바일 체크 끝 ####################

// 기본 환경 설정 파일 로드
require_once $_SERVER["DOCUMENT_ROOT"]."/global/lib/config/config.inc.php";


// 클래스 파일 로드


require _CLASS_ROOT_."/baseClass.php";
require _CLASS_ROOT_."/dbClass.php";
require _CLASS_ROOT_."/msgClass.php";
require _CLASS_ROOT_."/utilClass.php";
require _CLASS_ROOT_."/stringClass.php";


// DAO Class
require _CLASS_ROOT_."/boardConfigClass.php";

require _CLASS_ROOT_."/codeClass.php";
require _CLASS_ROOT_."/codeGroupClass.php";
require _CLASS_ROOT_."/projectClass.php";
require _CLASS_ROOT_."/projectDateClass.php";
require _CLASS_ROOT_."/projectWorkersClass.php";


require _CLASS_ROOT_."/boardClass.php";
require _CLASS_ROOT_."/locationClass.php";
require _CLASS_ROOT_."/resumeClass.php";

require _CLASS_ROOT_."/companyClass.php";
require _CLASS_ROOT_."/memberClass.php";

// 기본정보
require _CLASS_ROOT_."/baseConfigClass.php";
require _CLASS_ROOT_."/baseBankConfigClass.php";



 
 

//기본 REQUEST 값 셋팅
$action = (isset($_REQUEST["action"]))?$_REQUEST["action"]:"";
$nowPage = (isset($_REQUEST["nowPage"]))?$_REQUEST["nowPage"]:"";

if( $nowPage == "" ) $nowPage = 1;



//페이지 이동용 폼생성(게시판 기능 포함)
$pagingFormString = '<form name="pagingForm" id="pagingForm" action="'.$_SERVER["PHP_SELF"].'">'.chr(13);
$pagingFormString.= '<input type="hidden" id="nowPage" name="nowPage" value="'.$nowPage.'">'.chr(13);
$pagingFormString.= '<input type="hidden" id="b_id" name="b_id">'.chr(13);
$pagingFormString.= '<input type="hidden" id="bbsId" name="bbsId">'.chr(13);


foreach( $_POST as $key => $val ){
	if( $key != "nowPage" && $key != "b_id" && $key != "bbsId"  )
		$pagingFormString.= '<input type="hidden" name="'.$key.'" value="'.$val.'">'.chr(13);
}

foreach( $_GET as $key => $val ){
	if( $key != "nowPage" && $key != "b_id" && $key != "bbsId" )
		$pagingFormString.= '<input type="hidden" name="'.$key.'" value="'.$val.'">'.chr(13);
}

$pagingFormString.= '</form>'.chr(13);
?>

