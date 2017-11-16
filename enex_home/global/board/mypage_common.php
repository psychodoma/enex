<?
if( $code == "" ) {
	if( $siteType == "home" ) {
		$code = "h_review";
	} else if( $siteType == "kitchen" ) {
		$code = "k_estimate";
	} else if( $siteType == "interior" ) {
		$code = "i_inquire";
	} else if( $siteType == "ofella" ) {
		$code = "o_inquire";
	}
}
?>

			<!-- comTitleArea //-->
			<div class="comTitleArea">
				<h2 class="myPage">
					<span class="bold tGray02 maR7">에넥스</span> <span class="ftNormal">MY PAGE</span>
					<p>에넥스의 모든 패밀리사이트에서 활동하신 내역을 한번에 볼 수 있는 공간입니다.</p>
				</h2>
				<div class="comTitleRight">
					<div class="welcome">
						<span class="bold"><?= $_COOKIE["ENEXTOTALNAME"] ?></span>님 반갑습니다.
					</div>
					<p class="arRight maT10"><span class="txtBtn"><a href="<?= $gEnexMallUrl ?>/member/myinfo.php">회원정보 변경</a></span></p>
				</div>
			</div>
			<!-- comTitleArea //-->
			
			<!-- mypageTab //-->
			<div class="mpTab">
				<ul>
					<!-- <li class="<?= ($siteType == "home")?"on":""?>"><a href="<?= $gEnexHomeUrl ?>/member/mypage.php">에넥스홈</a></li> -->
					<li class="<?= ($_SERVER["HTTP_HOST"]=="mall.enex.co.kr")?"on":""?>"><a href="http://mall.enex.co.kr/shop/mypage/mypage_orderlist.php">에넥스몰</a></li>
					<li class="<?= ($siteType == "kitchen")?"on":""?>"><a href="http://kitchen.enex.co.kr/member/mypage.php">에넥스 키친</a></li>
					<li class="<?= ($siteType == "interior")?"on":""?>"><a href="http://interior.enex.co.kr/member/mypage.php">에넥스 인테리어</a></li>
					<li class="<?= ($siteType == "ofella")?"on":""?>"><a href="http://ofella.enex.co.kr/member/mypage.php">에넥스 오피스</a></li>
				</ul>
			</div>
			<!-- mypageTab //-->
			
			
			<!-- myStatsBox //-->
			<div class="myStatsBox">
				<!-- left //-->
				<div class="myLeft">
					<div class="myLeftMenu">
						<ul>
						<? if( $_SERVER["HTTP_HOST"]=="home.enex.co.kr" || $_SERVER["HTTP_HOST"]=="211.43.195.200" ) { ?>
							<li class="on"><a href="/member/mypage.php">리뷰</a></li>
						<? } else if( $_SERVER["HTTP_HOST"]=="kitchen.enex.co.kr" ) { ?>
							<li class="<?=($code=="k_estimate")?"on":""?>"><a href="/member/mypage.php?code=k_estimate">셀프견적</a></li>
							<li class="<?=($code=="k_estimate_request")?"on":""?>"><a href="/member/mypage.php?code=k_estimate_request">견적문의</a></li>
							<li class="<?=($code=="k_photoreview")?"on":""?>"><a href="/member/mypage.php?code=k_photoreview">포토리뷰</a></li>
							<li class="<?=($code=="k_complaint")?"on":""?>"><a href="/member/mypage.php?code=k_complaint">고객불만신고</a></li>
							<li class="<?=($code=="k_kind")?"on":""?>"><a href="/member/mypage.php?code=k_kind">칭찬합시다</a></li>
						<? } else if( $_SERVER["HTTP_HOST"]=="interior.enex.co.kr" ) { ?>
							<li class="on"><a href="/member/mypage.php">견적문의</a></li>
						<? } else if( $_SERVER["HTTP_HOST"]=="ofella.enex.co.kr" ) { ?>
							<li class="on"><a href="/member/mypage.php">1:1문의</a></li>
						<? } ?>
						</ul>
					</div>
					<div class="myBnr"><img src="http://image.enex.co.kr/images/mall/left_customer.gif" alt="고객만족센터 02-2185-2000  평일 AM 09:00 ~ PM 06:00 토요일 AM 12:30 ~ PM 01:30 " /></div>
				</div>
				<!-- left //-->
			
<?
		include_once $_SERVER["DOCUMENT_ROOT"]."/global.inc.php";
		$boardConfig = new boardConfigClass();
		$board = new boardClass();

    $boardConfig->code = $code;
    $boardConfig->getBoardConfig();
    
    $board->code = $code;
    
    if($_REQUEST[mode] == "list" || $_REQUEST[mode] == "") {
        //게시판 사용 조건
        $board->category_yn        = $boardConfig->category_yn; 
        $board->comment_yn         = $boardConfig->comment_yn;
        $board->reply_yn           = 'Y';
        $board->board_upload_count = $boardConfig->board_upload_count;
        $board->pageCnt						 = $boardConfig->page_num;
        
        $board->key                = "write_id";
        $board->word               = $_COOKIE["ENEXTOTALID"];
        $board->nowPage						 = $_REQUEST["nowPage"] ? $_REQUEST["nowPage"]:1;

/*
        //내 글과 그에 대한 답변만 보여야 하는 게시판
        $arrOnlyMyArticle = array();

        if ($code == 'k_estimate') {
        	$board->key = 'write_id';
	        $board->word = $_COOKIE['ENEXTOTALNAME'];
        }
*/
        $board->getBoardList();
        
        // 리스트
        include "mypage_list.php";

    } else if($_REQUEST[mode] == "view") {
    	
        if($_REQUEST[idx] == "") exit;
        $board->idx = $_REQUEST[idx];
        
        $board->getBoardInfo();
         
        // 상세
        include "mypage_view.php";
    } else {


    }
?>
			
			</div>
			<!-- myStatsBox //-->