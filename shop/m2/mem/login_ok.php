<?php
include("../lib/library.php");
include dirname(__FILE__)."/../lib/loginFailCheck.class.php";


if (get_magic_quotes_gpc()) {
	stripslashes_all($_POST);
	stripslashes_all($_GET);
}

if ($_POST['mode']=="guest"){ // 비회원 주문목록보기
	$ordno = (string)$_POST['ordno'];
	$nameOrder = (string)$_POST['ord_name'];

	// 변수 유효성 검증
	$validation_check = array(
		'ordno'=>array('require'=>true,'pattern'=>'/^[0-9]+$/'),
		'nameOrder'=>array('require'=>true),
	);
	$chk_result = array_value_cheking($validation_check,array('ordno'=>$ordno,'nameOrder'=>$nameOrder));
	if(count($chk_result)) {
		msg("주문자명과 주문번호가 존재하지 않습니다",-1);
	}

	// 주문번호와 주문자명으로 조회
	$query = $db->_query_print("select ordno from gd_order where ordno=[s] and nameOrder=[s]",$ordno,$nameOrder);
	$result = $db->_select($query);
	if($result[0]['ordno']) {
		setcookie("guest_ordno",$ordno,0,'/');
		setcookie("guest_nameOrder",$nameOrder,0,'/');
		go('../myp/orderlist.php');
	}
	else {
		msg("주문자명과 주문번호가 일치하는 주문이 존재하지 않습니다",-1);
	}
	exit;
}
else if ($_POST['mode']=="adult_guest") {

	include "../conf/fieldset.php";

	if ( $realname[useyn] == 'y' && !empty($realname[id]) ){

		// 인증 처리 및 페이지 이동은 아래 파일에서 처리 함.
		require_once( "./realname/RNCheckRequest.php" );
		exit;
	}
	else {
		msg("성인인증 서비스를 사용하고 있지 않습니다.",-1);
	}
}
else { // 회원 로그인 부분
	if ($_GET['SOCIAL_CODE']) {
		include dirname(__FILE__).'/../../shop/lib/SocialMember/SocialMemberServiceLoader.php';
		$socialMember = SocialMemberService::getMember($_GET['SOCIAL_CODE']);
		$result = $socialMember->login();
		$_POST['returnUrl'] = $_GET['returnUrl'];
	}
	else {
		$m_id = (string)$_POST['m_id'];
		$password = (string)$_POST['password'];
		$saveLoginStatus = ($_POST['save_login_status'] == 'y' ? true : false);
		$result = $session->login($m_id, $password);
	}

	if($result!==true) {
		if (class_exists('loginFailCheck') === true && ($msg=loginFailCheck::msgSetting($result)) != '') {
			msg($msg, -1);
		}
		else if($result==='NOT_FOUND') {
			msg('아이디 또는 비밀번호 오류입니다',-1);
		}
		elseif($result==='NOT_ACCESS') {
			msg('고객님은 본 사이트에서 승인되지 않아 로그인이 제한됩니다.',-1);
		}
		else if($result==='NOT_VALID') {
			msg('아이디 또는 비밀번호 입력 형식 오류입니다',-1);
		}
		exit;
	}

	// 브랜드몰 통합 로그인 처리 (COOKIE) -- 도메인별로 추가
	setcookie("ENEXTOTALID", $_SESSION["sess"]["m_id"], 0, "/", "enex.co.kr");
	setcookie("ENEXTOTALNAME", iconv("euc-kr","utf-8",$_SESSION["member"]["name"]), 0, "/", "enex.co.kr");

	setcookie("ENEXTOTALID", $_SESSION["sess"]["m_id"], 0, "/", "enexkitchen.co.kr");
	setcookie("ENEXTOTALNAME", iconv("euc-kr","utf-8",$_SESSION["member"]["name"]), 0, "/", "enexkitchen.co.kr");

	setcookie("ENEXTOTALID", $_SESSION["sess"]["m_id"], 0, "/", "enexsmart.co.kr");
	setcookie("ENEXTOTALNAME", iconv("euc-kr","utf-8",$_SESSION["member"]["name"]), 0, "/", "enexsmart.co.kr");

	setcookie("ENEXTOTALID", $_SESSION["sess"]["m_id"], 0, "/", "enexinterior.co.kr");
	setcookie("ENEXTOTALNAME", iconv("euc-kr","utf-8",$_SESSION["member"]["name"]), 0, "/", "enexinterior.co.kr");

	setcookie("ENEXTOTALID", $_SESSION["sess"]["m_id"], 0, "/", "ofella.co.kr");
	setcookie("ENEXTOTALNAME", iconv("euc-kr","utf-8",$_SESSION["member"]["name"]), 0, "/", "ofella.co.kr");

	// 에넥스 홈 임시 쿠키
	setcookie("ENEXTOTALID", $_SESSION["sess"]["m_id"], 0, "/", "211.43.195.200");
	setcookie("ENEXTOTALNAME", iconv("euc-kr","utf-8",$_SESSION["member"]["name"]), 0, "/", "211.43.195.200");

	if( $_REQUEST["save_id"] == "y" ) {
		setcookie("ENEXREMAINID", $_SESSION["sess"]["m_id"],  time()+2592000, "/", "enex.co.kr");
	} else {
		setcookie("ENEXREMAINID", $_SESSION["sess"]["m_id"],  time() - 3600, "/", "enex.co.kr");
	}

	//출석체크관련 처리
	$attendance = Core::loader('attendance');
	$attendanceNo = $attendance->login_check($session->m_no, true);
	if ($attendanceNo) {
		$_SESSION['attendance'] = $attendanceNo;
	}

	// 자동로그인
	if ($saveLoginStatus === true) {
		// 관리자인 경우 자동로그인 제한
		if ($session->level >= 80) {
			expireCookieMemberInfo();
			msg('자동로그인 기능은 관리자로 로그인시 보안상의 이유로 사용할 수 없습니다.');
		}
		else {
			// 회원인 경우에만 자동로그인 처리
			storeCookieMemberInfo($m_id, $password);
		}
	}


	### ace카운터 처리 부분
	$Acecounter = &load_class('Acecounter','Acecounter');
	$Acecounter->get_common_script();
	$Acecounter->member_login($session->m_id);
	if($Acecounter->scripts){
		echo $Acecounter->scripts;
	}

	## 로그인 내역 기록
	member_log( $session->m_id );

	## 운영 체크
	if ($session->level > 80) {
		include(SHOPROOT.'/proc/shop_warning_msg.php');
	}

	// 투데이샵 분류 설정
	$todayshop = & load_class('todayshop','todayshop');
	if ($todayshop->auth() && $todayshop->cfg['useTodayShop'] == 'y') {
		$ts_interest = unserialize(stripslashes($todayshop->cfg['interest']));
		if ($ts_interest['use'] == 'y') {
			// 관심 분류가 등록되어 있는가
			list($sc) = $db->fetch("SELECT category FROM ".GD_TODAYSHOP_SUBSCRIBE." WHERE m_id = '".$session->m_id."' AND category <> '' ");

			if (!$sc) $ext_param = '&interest=1';
			else	 {
				$ext_param = '&category='.$sc;
				$_POST['returnUrl'] = isset($_POST['returnUrl']) ? str_replace('today_goods.php','today_list.php',$_POST['returnUrl']) : str_replace('today_goods.php','today_list.php',$_SERVER['HTTP_REFERER']);
			}

		}
	}
}

if($_GET['sess_id'])
{
	$returnUrl = $sitelink->link('main/index.php','regular');
	go($returnUrl);
	exit;
}

if (!$_POST['returnUrl']) $_POST['returnUrl'] = $_SERVER['HTTP_REFERER'];
$div = explode("/",$_POST['returnUrl']);
if (preg_match("/http/",$div[0]) && in_array($div[count($div)-2],array("member","mypage"))) $_POST['returnUrl'] = "../main/index.php";
$_POST['returnUrl'] = preg_match('/\?/',$_POST['returnUrl']) ? $_POST['returnUrl'].$ext_param : $_POST['returnUrl'].'?'.$ext_param;
go($_POST['returnUrl']);

?>
