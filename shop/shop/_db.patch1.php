<?

// C1. ���̺귯�� �ε�
include "lib/library.php";

// C2. ��������
$query[] = "ALTER TABLE `gd_goods` ADD `naver_shopping_yn` VARCHAR( 1 ) NOT NULL DEFAULT 'Y' COMMENT '���̹����� ���� ����';";
$query[] = "ALTER TABLE `gd_goods` ADD `naver_shopping_chk` VARCHAR( 1 ) NOT NULL DEFAULT 'N' COMMENT '���̹����� ���̱׷��̼� üũ';";

// C3. �����߻�����
$occursError = false;

// C4. ���� ����
if (strtoupper(get_class($db)) === 'GODO_DB') { // GODO DB��ü�϶�(����4 �̻�)
	foreach ($query as $v) {
		$db->query($v);
		if ($db->errorCode()) {
			debug($db->errorInfo());
			$occursError = true;
		}
	}
}
else if (strtoupper(get_class($db)) === 'DB') { // DB��ü�϶�(����1,2,3)
	foreach ($query as $v) {
		$db->query($v);
		if (mysql_errno($db->db_conn)) {
			debug(mysql_error($db->db_conn));
			$occursError = true;
		}
	}
}
else { // ������ DB��ü�� �ƴѰ��
	debug('DB��ü�� ã�� �� �����ϴ�. �����ͷ� �����ֽñ� �ٶ��ϴ�.');
	$occursError = true;
}

// C5. ������ �߻����� �ʾҴٸ� ��ġ�������� ���
if ($occursError === false) debug('���������� DB��ġ�� �Ϸ�Ǿ����ϴ�.');

?>