<?
//include $_SERVER["DOCUMENT_ROOT"]."/global/include/admin_header.php";
include_once($_SERVER["DOCUMENT_ROOT"]."/global.inc.php");
//include_once($_SERVER["DOCUMENT_ROOT"]._GLOBAL_INC_."/dtd_ehome.php");
$db = new dbClass();
$db->openDB($gDBInfo);

$sql = "insert into gc_branch_prd_list (br_idx, prd_kitchen, prd_kitchen_table, prd_kitchen_idx, prd_etc, prd_etc_table, prd_etc_idx) values(" .$_REQUEST[idx] . ", '" . $_REQUEST[prd_kitchen] . "', '".$_REQUEST[prd_kitchen_table]."','".$_REQUEST[prd_kitchen_idx]."', '" . $_REQUEST[prd_etc]  . "','".$_REQUEST[prd_etc_table]."','".$_REQUEST[prd_etc_idx]."')";

$db->queryDB($sql);
?>
