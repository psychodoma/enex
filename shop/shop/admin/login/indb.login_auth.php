<?
include '../../lib/library.php';
include '../../lib/smsAuth.class.php';

$smsAuth = new smsAuth();
$sess['m_id'] = $_POST['m_id'];

// 인증키 발급
if ($_POST['mode'] == 'getAuth') {
	$return = $smsAuth->getAuth();
}
// 인증키 체크
else if ($_POST['mode'] == 'chkAuth') {
	$return = $smsAuth->chkAuth($_POST['chkAuthKey'], $_POST['authType']);

	//로그인 인증 완료 시 db초기화
	if ($return == 'Y' && $_POST['authType'] === 'loginAuth' && $_POST['m_id']) {
		$query = "
		UPDATE
			".GD_MEMBER."
		SET
			account_lock_yn = 'N',
			login_fail_cnt = 0,
			account_lock_time = ''
		WHERE
			m_id = '".$_POST['m_id']."'";
		$db->query($query);
	}
	else {}
}
// 남은 시간 계산
else if ($_POST['mode'] == 'getTime') {
	$return = $_SESSION['smsAuthKey'] - time();
}
// 보안인증 브릿지
else if ($_GET['mode'] == 'bridge') {
	echo '<script src="../common.js"></script>
	<script>parent.popupLayer("../login/popup_login_auth.php?m_id='.$_GET["m_id"].'", 500, 300);</script>';
	exit;
}
else {}

echo $return;

?>
