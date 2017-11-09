<?
//include $_SERVER["DOCUMENT_ROOT"]."/global/include/admin_header.php";
include_once($_SERVER["DOCUMENT_ROOT"]."/global.inc.php");
//include_once($_SERVER["DOCUMENT_ROOT"]._GLOBAL_INC_."/dtd_ehome.php");
$db = new dbClass();
$db->openDB($gDBInfo);


$search = preg_replace("/\s+/", "", $word);

$sql_query01 = mysql_query(" select * from gc_board_k_prod01 where title like '%".$search."%' ");
$sql_query02 = mysql_query(" select * from gc_board_k_prod02 where title like '%".$search."%' ");

$prod01_select = "전시제품 : <select style='height:30px;'>";

$prod01_select .= "<optgroup label='현재 전시 주방제품'>";
while ($row = mysql_fetch_array($sql_query01)) {
	$prod01_select .= "<option>";
	$prod01_select .= $row['title'];
	$prod01_select .= "</option>";
}
$prod01_select .= "</optgroup>";

$prod01_select .= "<optgroup label='현재 전시 주방제품'>";
while ($row = mysql_fetch_array($sql_query02)) {
	$prod01_select .= "<option>";
	$prod01_select .= $row['title'];
	$prod01_select .= "</option>";
}
$prod01_select .= "</optgroup>";

$prod01_select .= "</select>";


echo $prod01_select;

?>
