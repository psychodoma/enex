<?

// C1. 라이브러리 로드
include "lib/library.php";

// C2. 실행쿼리
$query[] = "
CREATE TABLE `gd_comeback_coupon` (
  `sno` int(10) NOT NULL auto_increment,
  `copysno` int(10) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '이름',
  `type` int(10) NOT NULL COMMENT '대상',
  `step` varchar(20) NOT NULL,
  `date` int(10) NOT NULL,
  `price` varchar(50) default NULL,
  `goodsno` text,
  `couponyn` enum('y','n') NOT NULL COMMENT '쿠폰사용여부',
  `couponcd` int(10) default NULL COMMENT '사용쿠폰번호',
  `smsyn` enum('y','n') NOT NULL COMMENT 'sms 사용여부',
  `sms_type` varchar(10) NOT NULL COMMENT '문자 발송 타입',
  `lms_subject` varchar(255) default NULL COMMENT 'lms 제목',
  `msg` text COMMENT '메세지',
  `linkyn` enum('y','n') default NULL COMMENT '모바일샵 링크 사용여부',
  `sendyn` enum('y','n') NOT NULL default 'n' COMMENT '발송여부',
  `applysno` int(10) NOT NULL COMMENT '쿠폰지급번호',
  `sms_logNo` int(10) NOT NULL COMMENT 'SMS발송번호',
  `visit` int(10) NOT NULL,
  `senddt` datetime default NULL,
  `regdt` datetime default NULL,
  PRIMARY KEY  (`sno`)
) ENGINE=MyISAM  DEFAULT CHARSET=euckr;
";

// C3. 에러발생여부
$occursError = false;

// C4. 쿼리 실행
if (strtoupper(get_class($db)) === 'GODO_DB') { // GODO DB객체일때(시즌4 이상)
	foreach ($query as $v) {
		$db->query($v);
		if ($db->errorCode()) {
			debug($db->errorInfo());
			$occursError = true;
		}
	}
}
else if (strtoupper(get_class($db)) === 'DB') { // DB객체일때(시즌1,2,3)
	foreach ($query as $v) {
		$db->query($v);
		if (mysql_errno($db->db_conn)) {
			debug(mysql_error($db->db_conn));
			$occursError = true;
		}
	}
}
else { // 지정된 DB객체가 아닌경우
	debug('DB객체를 찾을 수 없습니다. 고객센터로 문의주시기 바랍니다.');
	$occursError = true;
}

// C5. 에러가 발생하지 않았다면 패치성공여부 출력
if ($occursError === false) debug('정상적으로 DB패치가 완료되었습니다.');

?>
