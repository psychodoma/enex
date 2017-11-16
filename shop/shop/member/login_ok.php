<?php
include("../lib/library.php");
include "../lib/validation.class.php";
include dirname(__FILE__)."/../lib/loginFailCheck.class.php";

if (get_magic_quotes_gpc()) {
	stripslashes_all($_POST);
	stripslashes_all($_GET);
}

// ����Ÿ�� ����
$returnBack = -1;
$returnTarket = '';
if ($_POST['ifm_login'] == '1') {
	$returnBack = null;
	$returnTarket = 'parent';

}


// ������ �α��ο��� �����ں��� �������� üũ
$_ref = parse_url($_SERVER['HTTP_REFERER']);
if (preg_match('/admin\/login\/login\.php$/',$_ref['path']) || $_POST['adm_login']) {
	$alCert = Core::loader('adminLoginCert');
	$alStat = $alCert->loginStatus();
	if ($alStat == 'failure') {
		$certUrl = $sitelink->link('admin/login/adm_login_cert.php', "regular");
		msg('������ �޴��� ���� ������ ���� �ϼ���.', $certUrl, $returnTarket);

	}
}



$result_db_login = $db->fetch(" select * from gd_member where  m_id = '".$m_id."'");

//$date("Y-m-d H:i:s",time());
//$result_db_login['account_lock_time']



if( date("Y-m-d H:i:s", strtotime('-15 minutes')) > $result_db_login['account_lock_time'] ){
	
	if($result_db_login['account_lock_yn'] == 'Y' && !$result_db_login['account_lock_time']){
		msg('������ ���� �Ǿ��ֽ��ϴ�. �����ڿ��� �����ϼ���.', $returnBack);
	}

}else{

	if($result_db_login['account_lock_yn'] == 'Y'){
		msg('�α����� �����Ͽ� 10�� ���� ������ ���ѵ˴ϴ�.', $returnBack);
	}
}




if ($_POST['mode']=="guest"){ // ��ȸ�� �ֹ���Ϻ���
	$ordno = (string)$_POST['ordno'];
	$nameOrder = (string)$_POST['nameOrder'];

	$nameOrder = iconv("UTF-8", "EUC-KR", $nameOrder);
	// ���� ��ȿ�� ����
	$validation_check = array(
		'ordno'=>array('require'=>true,'pattern'=>'/^[0-9]+$/'),
		'nameOrder'=>array('require'=>true),
	);
	$chk_result = array_value_cheking($validation_check,array('ordno'=>$ordno,'nameOrder'=>$nameOrder));

	if(count($chk_result)) {
		msg("�ֹ��ڸ�� �ֹ���ȣ�� ��ġ�ϴ� �ֹ��� �������� �ʽ��ϴ�", $returnBack);
	}

	// �ֹ���ȣ�� �ֹ��ڸ����� ��ȸ
	$query = $db->_query_print("select ordno,nameOrder from gd_order where ordno=[s] and (nameOrder=[s] or nameReceiver=[s])",$ordno,$nameOrder,$nameOrder);
	$result = $db->_select($query);
	if($result[0]['ordno']) {
		$nameOrder = $result[0]['nameOrder'];
		setcookie("guest_ordno",$ordno,0,'/');
		setcookie("guest_nameOrder",$nameOrder,0,'/');
		go('../mypage/mypage_orderlist.php', $returnTarket);
	}
	else {
		msg("�ֹ��ڸ�� �ֹ���ȣ�� ��ġ�ϴ� �ֹ��� �������� �ʽ��ϴ�", $returnBack);
	}
	exit;
}
else if ($_POST['mode']=="adult_guest") {

	include "../conf/fieldset.php";

	if ( $realname[useyn] == 'y' && !empty($realname[id]) ){

		// ���� ó�� �� ������ �̵��� �Ʒ� ���Ͽ��� ó�� ��.
		require_once( "./realname/RNCheckRequest.php" );
		exit;
	}
	else {
		msg("�������� ���񽺸� ����ϰ� ���� �ʽ��ϴ�.",-1);
	}
}
else { // ȸ�� �α��� �κ�
	if ($_GET['SOCIAL_CODE']) {
		include dirname(__FILE__).'/../lib/SocialMember/SocialMemberServiceLoader.php';
		$socialMemberService = SocialMemberService::getMember($_GET['SOCIAL_CODE']);
		$result = $socialMemberService->login();
		$_POST['returnUrl'] = $_GET['return_url'];
	}
	else {
		$m_id = (string)$_POST['m_id'];
		$password = (string)$_POST['password'];
		$result = $session->login($m_id, $password);
	}
	/*if($_SERVER['REMOTE_ADDR'] == "210.96.212.118"){
		$result = true;
	}*/
	if($result!==true) {
		if (class_exists('loginFailCheck') === true && ($msg=loginFailCheck::msgSetting($result)) != '') {
			if ($result == 'LFC_adminLimitMsg') { // �� ������ > 5ȸ ���� �޽��� (�������)
				msg($msg, loginFailCheck::getAdminLimitMove($m_id));
			}
			else {
				msg($msg, $returnBack);
			}
		}
		else if($result==='NOT_FOUND') {
			msg('���̵� �Ǵ� ��й�ȣ �����Դϴ�', $returnBack);
		}
		elseif($result==='NOT_ACCESS') {
			msg('������ �� ����Ʈ���� ���ε��� �ʾ� �α����� ���ѵ˴ϴ�.', $returnBack);
		}
		else if($result==='NOT_VALID') {
			msg('���̵� �Ǵ� ��й�ȣ �Է� ���� �����Դϴ�', $returnBack);
		}
		exit;
	}

	// �귣��� ���� �α��� ó�� (COOKIE) -- �����κ��� �߰�
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
	
	// ���ؽ� Ȩ �ӽ� ��Ű
	setcookie("ENEXTOTALID", $_SESSION["sess"]["m_id"], 0, "/", "211.43.195.200");
	setcookie("ENEXTOTALNAME", iconv("euc-kr","utf-8",$_SESSION["member"]["name"]), 0, "/", "211.43.195.200");
	
	if( $_REQUEST["save_id"] == "y" ) {
		setcookie("ENEXREMAINID", $_SESSION["sess"]["m_id"],  time()+2592000, "/", "enex.co.kr");
	} else {
		setcookie("ENEXREMAINID", $_SESSION["sess"]["m_id"],  time() - 3600, "/", "enex.co.kr");
	}
	
	// �����ں��� ���� �α��� ó��
	if ($alStat == 'success') {
		$_SESSION['alcAccess'] = md5(crypt(''));
	}

	//�⼮üũ���� ó��
	if(!preg_match('/admin/',$_POST['returnUrl'])) {
		$attd = Core::loader('attendance');
		$result = $attd->login_check($session->m_no);
		if($result) {

			msg($attd->get_check_message($result));
		}
	}


	### aceī���� ó�� �κ�
	$Acecounter = Core::loader('Acecounter');
	$Acecounter->get_common_script();
	$Acecounter->member_login($session->m_id);
	if($Acecounter->scripts){
		echo $Acecounter->scripts;
	}

	## �α��� ���� ���
	member_log( $session->m_id );

	## � üũ
	if ($session->level > 80) {
		include(SHOPROOT.'/proc/shop_warning_msg.php');
	}

	// �����̼� �з� ����
	$todayshop = Core::loader('todayshop');
	if ($todayshop->auth() && $todayshop->cfg['useTodayShop'] == 'y') {
		$ts_interest = unserialize(stripslashes($todayshop->cfg['interest']));
		if ($ts_interest['use'] == 'y') {
			// ���� �з��� ��ϵǾ� �ִ°�
			list($sc) = $db->fetch("SELECT category FROM ".GD_TODAYSHOP_SUBSCRIBE." WHERE m_id = '".$session->m_id."' AND category <> '' ");

			if (!$sc) $ext_param = '&interest=1';
			else	 {
				$ext_param = '&category='.$sc;
				$_POST['returnUrl'] = isset($_POST['returnUrl']) ? str_replace('today_goods.php','today_list.php',$_POST['returnUrl']) : str_replace('today_goods.php','today_list.php',$_SERVER['HTTP_REFERER']);
			}

		}
	}

	// �н����� ���� ķ����
	$info_cfg = $config->load('member_info');
	$_ref = parse_url($_SERVER['HTTP_REFERER']);
	if (( preg_match('/admin\/login\/login\.php$/',$_ref['path']) || preg_match('/member\/login\.php$/',$_ref['path']) || preg_match('/main\/intro_adult\.php$/',$_ref['path']) || preg_match('/main\/intro_member\.php$/',$_ref['path']) )
		&&
		( $info_cfg['campaign_use'] && is_file('../data/skin/'.$cfg['tplSkin'].'/member/password_campaign.htm') )) {

		$show = true;

		// ������ �����ϱ�
		if ($show && $_COOKIE['campaign_disregarded_date']) {

			$operate = sprintf('%+d day', $info_cfg['campaign_next_term']);
			$tmp = strtotime($_COOKIE['campaign_disregarded_date']);
			$tmp = strtotime($operate ,$tmp);

			if ($tmp > time()) {
				$show = false;
			}

		}

		if ($show && ($tmp = (int)strtotime($_SESSION['member']['password_moddt'])) > 0) {

			$operate = sprintf('%+d %s', $info_cfg['campaign_period_value'], ($info_cfg['campaign_period_type'] == 'd' ? 'day' : 'month'));
			$tmp = strtotime($operate ,$tmp);

			if ($tmp > time()) {
				$show = false;
			}

		}

		if ($show) {
			$ext_param .= '&ori_returnUrl='.($_POST['returnUrl'] ? urlencode($_POST['returnUrl']) : urlencode($_SERVER['HTTP_REFERER']));
			$_POST['returnUrl'] = '../member/password_campaign.php';
		}

	}
}

if(strpos($_SERVER['HTTP_REFERER'], 'main/intro_adult.php') && ($auth_date == '0000-00-00' || $current_date > $auth_period) && ((int)($session->level) < 80) ){
	go($cfg[rootDir].'/main/intro_adult_login.php?returnUrl=' . urlencode($_POST['returnUrl']) . ($_SERVER['QUERY_STRING'] ? '&'.$_SERVER['QUERY_STRING'] : ''), $returnTarket);
}


if(!$_POST['returnUrl']) { $_POST['returnUrl'] = $_SERVER['HTTP_REFERER']; }
$div = explode("/",$_POST['returnUrl']);
if (preg_match("/http/",$div[0]) && in_array($div[count($div)-2],array("member","mypage"))) $_POST['returnUrl'] = "../main/index.php";
$_POST['returnUrl'] = preg_match('/\?/',$_POST['returnUrl']) ? $_POST['returnUrl'].$ext_param : $_POST['returnUrl'].'?'.$ext_param;

if (preg_match('/(^\.\.\/)|(^\/shop\/)/',$_POST['returnUrl'])) {
	$_POST['returnUrl'] = preg_replace('/(^\.\.\/)|(^\/shop\/)/', '', $_POST['returnUrl']);
	$_POST['returnUrl'] = $sitelink->link($_POST['returnUrl'],'regular');
}

go($_POST['returnUrl'], $returnTarket);




?>

<!-- ���̽�ī���� -->
<!-- This script is for AceCounter START -->
<script language='javascript'>

var _ag   = '' ;         // �α��λ���� ����
var _id   = {_sess.m_id};    		// �α��λ���� ���̵�
var _mr   = '';        	// �α��λ���� ��ȥ���� ('single' , 'married' )
var _gd   = {_sess.sex};         // �α��λ���� ���� ('man' , 'woman')

</script>
<!-- AceCounter END -->

<script language="javascript">
top.location.href = '<?= $_REQUEST['returnUrl'] ?>';
</script>