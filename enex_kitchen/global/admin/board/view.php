<?
include $_SERVER["DOCUMENT_ROOT"]."/global/include/admin_header.php";
$boardConfig = new boardConfigClass();
$location_code = "false";

if($_REQUEST[code] == "k_location" || $_REQUEST[code] == "i_location"){
	$location_code = "true";
}
if($location_code == "true"){
	$board = new locationClass();
}else{
	$board = new boardClass();
}



// BOARD CONFIG READ
if($_REQUEST[code]) {
    $boardConfig->code = $_REQUEST[code];
    $boardConfig->getBoardConfig();
    if($boardConfig->code == "") {
        echo "<script>alert('CODE 정보가 없습니다.');</script>";
        exit;        
    }
} else {
    echo "<script>alert('CODE 정보가 없습니다.');</script>";
    exit;
}

$board->code = $_REQUEST[code];
$board->key = $_REQUEST[key];
$board->word = $_REQUEST[word];

$board->idx = $_REQUEST[idx];
$board->category_yn = $boardConfig->category_yn;
$board->getBoardInfo();

if($location_code == "true"){
$board->getProductList();
}

$sql = "select mobile,phone,zipcode,address,road_address,address_sub,email from enex_shop.gd_member where m_id = '{$board->write_id}'";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);



// 슈퍼관리자 설정
if($_SERVER["REMOTE_ADDR"] == "210.96.212.116" || $_SERVER["REMOTE_ADDR"] == "210.96.212.118") $super=true;


// 관리자 View 스킨 설정
switch ($boardConfig->code) {
	case "h_main":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "h_recruit":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "h_event":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "h_social":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "h_media":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "h_report":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "h_review":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "h_notice":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "h_info_news":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "h_ir":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;

	case "i_pakage":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "i_event":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "i_enexin":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "i_location":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "i_inquire":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "i_notice":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "i_space":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;

	case "k_event":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_event_data":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_bestreview":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_prod01":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_prod02":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_prod03":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_prod04":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_prod05":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_photoreview":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_design":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_kind":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_location":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_estimate":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_estimate_request":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "k_complaint":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;

	case "o_prd_meeting":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_special":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_execute":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_chair":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_amenity":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_office":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_edu":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_soho":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_portfolio":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_inquire":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_notice":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;

	case "o_prd_new_execute":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_new_chair":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_new_amenity":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_new_special":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_new_soho":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_new_office":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	case "o_prd_new_edu":$gcAdminSkinDir = "./skin/".$boardConfig->code;break;
	default:$gcAdminSkinDir = "./skin/";
}
//$gcAdminSkinDir;
/*
if($boardConfig->board_skin == "o_product_new"){
	$gcAdminSkinDir = "./skin/".$boardConfig->board_skin;

}
*/
// debug

if($super){
	echo "SKIN : ". $gcAdminSkinDir."<br><br>";
	echo "BOARD_SKIN : ".$boardConfig->board_skin."<br><br>";
}

// 스킨 인클루드
include $gcAdminSkinDir."/view.php";


include $_SERVER["DOCUMENT_ROOT"]."/global/include/admin_footer.php";
?>