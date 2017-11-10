<?
include_once $_SERVER["DOCUMENT_ROOT"]."/global.inc.php";
@header("Content-Type: text/html; charset=utf-8");
extract($_POST);


$location_code = "false";

if($_REQUEST[code] == "k_location" || $_REQUEST[code] == "i_location"){
	$location_code = "true";
}
if($location_code == "true"){
	$board = new locationClass();
}else{
	$board = new boardClass();
}

$board->code = $_POST[code];
for($i=0;$i<count($_POST[idx]);$i++) {
    $board->idx = $_POST[idx][$i];
    $board->deleteboard();

		if($_REQUEST['code'] == "k_location"){
			mysql_query("DELETE FROM gc_branch_prd_list WHERE br_idx='".$board->idx."'");
		}
}
    echo "<script name='javascript'>alert('삭제되었습니다.');location='list.php?code=".$_REQUEST[code]."';</script>";



?>
