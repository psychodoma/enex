<html>
<head>
<?
include_once($_SERVER["DOCUMENT_ROOT"]."/global.inc.php");

$brIdx = $_GET['idx'];

$db = new dbClass();
$db->openDB($gDBInfo);

$q = "SELECT * FROM gc_branch_location WHERE idx = $brIdx";
$res = mysql_query($q);
$row = mysql_fetch_array($res);
$title = $row["brName"];

if ($brIdx == 11 || $brIdx == 12 || $brIdx == 14 || $brIdx == 17) {
	$brIdx = 158;
} else if ($brIdx == 10 || $brIdx == 15 || $brIdx == 2) {
	$brIdx = 160;
} else if ($brIdx == 51 || $brIdx == 53 || $brIdx == 50) {
	$brIdx = 166;
} else if ($brIdx == 59 || $brIdx == 58) {
	$brIdx = 163;
} else if ($brIdx == 47 || $brIdx == 46 || $brIdx == 43 || $brIdx == 44) {
	$brIdx = 165;
}


$whereStr = " WHERE br_idx=$brIdx ";

$query = "SELECT * FROM gc_branch_prd_list {$whereStr}";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
// $totalCnt = $row["cnt"];

//echo $query;
$res = mysql_query($query);


/*
$rows = array();
while ($row = mysql_fetch_array($res, MYSQL_ASSOC))
{
	$rows[] = $row;
}
echo json_encode($rows);
*/

function get_prd_table_id($table,$idx){
	$query = " select * from ".$table."_file where board_idx =".$idx;
  $res = mysql_query($query);
	$row = mysql_fetch_array($res);
	$result = explode('global',$row['file_path']);
	echo $result[1];
}

?>
<script>
	function closePopup() {
		parent.close();
		window.close();
		self.close();
	}
</script>
<style>
	* { font-family: notokr-regular, 'Nanum Barun Gothic'; font-size:13px; }
	body { padding: 30px; }
	table { width: 100%; margin-top: 20px; }
	table * { border: 1px solid #eeeeee;  }
	th, td { padding:10px 10px; width: 50%; }
	th { font-family: notokr-bold, 'Nanum Barun Gothic'; font-size:13px; background: #ebebeb; color: black; }
	td { font-family: notokr-regular, 'Nanum Barun Gothic'; font-size:13px; color: #494949; }
	button { position: absolute; top: 35px; right: 40px; width: 100px; text-align: center; padding: 5px 0; border: none; color: white; background: #f63333; }
	h1 { font-size: 18px; font-family: notokr-bold, 'Nanum Barun Gothic'; color: #494949; }
	p { font-family: notokr-bold, 'Nanum Barun Gothic'; color: #494949; }
</style>
</head>
<body>
	<h1><?=$title?></h1>
	<button onclick="closePopup();">닫기</button>
<table cellpadding="0" cellspacing="0">
	<tr><th>현재 전시 주방제품</th><th>현재 전시 붙박이, 인테리어제품</th></tr>
	<? while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) { ?>
		<tr>
			<td>
				<?php if($row['prd_kitchen']){?>
					<a href="/global<?get_prd_table_id($row['prd_kitchen_table'],$row['prd_kitchen_idx']) ?>" onClick="window.open(this.href, '', 'width=1000, height=550'); return false;"><?=$row['prd_kitchen']?></a>
				<?}?>
			</td>

			<td>
				<?php if($row['prd_etc']){?>
					<a href="/global<?get_prd_table_id($row['prd_etc_table'],$row['prd_etc_idx']) ?>" onClick="window.open(this.href, '', 'width=1000, height=550'); return false;"><?=$row['prd_etc']?></a>
				<?}?>
			</td>
		</tr>
	<? } ?>
</table>
<p>대리점 진열 제품 현황은 신제품 출시 및 제품 단종에 따라 변동될 수 있습니다.</p>
</body>
</html>
