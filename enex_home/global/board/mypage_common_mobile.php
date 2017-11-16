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

<style>
	.subMenu { margin-top: 30px; height: 30px; border-bottom: 1px solid black;}
	.subMenu ul { height: 100%; }
	.subMenu li { width: 24.95%; height: 100%; }
	.subMenu li a { height: 100%; }
	.comTitleArea { height: auto; }
	.myPage { height: auto; margin-top: 20px; }
</style>

<div class="subMenu">
		<ul>
			<li class="<?= ($_SERVER["HTTP_HOST"]=="mall.enex.co.kr")?"on":""?>"><a href="#" onclick="parent.location.href='http://mall.enex.co.kr/m2/myp/menu_list.php'">에넥스몰</a></li>
			<li class="<?= ($siteType == "kitchen")?"on":""?>"><a href="http://kitchen.enex.co.kr/member/mypage.php?mode=main&iframe=1">에넥스 키친</a></li>
			<li class="<?= ($siteType == "interior")?"on":""?>"><a href="http://interior.enex.co.kr/member/mypage.php?mode=main&iframe=1">에넥스 인테리어</a></li>
			<li class="<?= ($siteType == "ofella")?"on":""?>"><a href="http://ofella.enex.co.kr/member/mypage.php?mode=main&iframe=1">에넥스 오피스</a></li>
		</ul>
	</div>
<div class="comTitleArea">
	
	<h2 class="myPage">
		<span class="bold tGray02 maR7">에넥스</span> <span class="ftNormal">MY PAGE</span>
		<p>에넥스에서 활동하신 내역을 한번에 볼 수 있는 공간입니다.</p>
	</h2>
<!--
	<div class="comTitleRight">
		<div class="welcome">
			<span class="bold">에넥스몰</span>님 반갑습니다.
		</div>
		<p class="arRight maT10"><span class="txtBtn"><a href="http://mall.enex.co.kr/shop/member/myinfo.php">회원정보 변경</a></span></p>
	</div>
-->
</div>


			
			
			<!-- 일반 게시물 //-->
<!--
			<div class="mypageBox">
				<h2>마이페이지 리스트1</h2>

				<div class="combbsList">
					<ul>
						<li>
							<div class="lineBbsBox">
								<div class="bbsTitleArea">게시물 제목</div>
								<div class="bbsDateArea">
									<p>2015. 12. 34</p>
									<p>작성자</p>
								</div>
							</div>
						</li>
						<li>
							<div class="lineBbsBox">
								<div class="bbsTitleArea">게시물 제목</div>
								<div class="bbsDateArea">
									<p>2015. 12. 34</p>
									<p>작성자</p>
								</div>
							</div>
						</li>
					</ul>
				</div>

				<div class="myBtnArea">
					<div class="floatRight">
						<span class="myBtnNormal"><a href="#">글쓰기</a></span>
					</div>
				</div>

			</div>
-->
			<!-- 일반 게시물 //-->

<?
		include_once $_SERVER["DOCUMENT_ROOT"]."/global.inc.php";
		$boardConfig = new boardConfigClass();
		$board = new boardClass();

    $boardConfig->code = $code;
    $boardConfig->getBoardConfig();
    
    $board->code = $code;
    
//     if($_REQUEST[mode] == "list" || $_REQUEST[mode] == "") {
	if($_REQUEST[mode] == "list") {
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
        include "mypage_list_mobile.php";

    } else if($_REQUEST[mode] == "view") {
    	
        if($_REQUEST[idx] == "") exit;
        $board->idx = $_REQUEST[idx];
        
        $board->getBoardInfo();
        // 상세
        include "mypage_view_mobile.php";
    } else {
		?>
		    <!-- 마이페이지 메인 //-->
			<div class="mypageBox">
				
				<? if( $_SERVER["HTTP_HOST"]=="www.enex.co.kr" || $_SERVER["HTTP_HOST"]=="211.43.195.200" ) { ?>
					<div class="myMlist on"><a href="/member/mypage.php">리뷰</a></li>
				<? } else if( $_SERVER["HTTP_HOST"]=="kitchen.enex.co.kr" ) { ?>
					<div class="myMlist <?=($code=="k_estimate")?"on":""?>"><a href="/member/mypage.php?code=k_estimate&mode=list&iframe=1">셀프견적</a></div>
					<div class="myMlist <?=($code=="k_estimate_request")?"on":""?>"><a href="/member/mypage.php?code=k_estimate_request&mode=list&iframe=1">견적문의</a></div>
					<div class="myMlist <?=($code=="k_photoreview")?"on":""?>"><a href="/member/mypage.php?code=k_photoreview&mode=list&iframe=1">포토리뷰</a></div>
					<div class="myMlist <?=($code=="k_complaint")?"on":""?>"><a href="/member/mypage.php?code=k_complaint&mode=list&iframe=1">고객불만신고</a></div>
					<div class="myMlist <?=($code=="k_kind")?"on":""?>"><a href="/member/mypage.php?code=k_kind&mode=list&iframe=1">칭찬합시다</a></div>
				<? } else if( $_SERVER["HTTP_HOST"]=="interior.enex.co.kr" ) { ?>
					<div class="myMlist on"><a href="/member/mypage.php?mode=list&iframe=1">견적문의</a></div>
				<? } else if( $_SERVER["HTTP_HOST"]=="ofella.enex.co.kr" ) { ?>
					<div class="myMlist on"><a href="/member/mypage.php?mode=list&iframe=1">1:1문의</a></div>
				<? } ?>
				
			</div>
			<!-- 마이페이지 메인 //-->
		<?

    }
?>			


			<!-- 썸네일 게시물 //-->
<!--
			<div class="mypageBox">
				<h2>마이페이지 리스트1</h2>

				<div class="combbsList">
					<ul>
						<li>
							<div class="thumbBbsBox">
								<div class="thumbArea"><img src="http://image.enex.co.kr/images/home/m/temp.gif" /></div>
								<div class="bbsTitleArea">게시물 제목게시물 제목게시물 제목게시물 제목</div>
								<div class="bbsDateArea">
									2015. 12. 34
									<span class="bbsWriter">작성자</span>
								</div>
							</div>
						</li>
						<li>
							<div class="thumbBbsBox">
								<div class="thumbArea"><img src="http://image.enex.co.kr/images/home/m/temp.gif" /></div>
								<div class="bbsTitleArea">게시물 제목게시물 제목게시물 제목게시물 제목</div>
								<div class="bbsDateArea">
									2015. 12. 34
									<span class="bbsWriter">작성자</span>
								</div>
							</div>
						</li>
					</ul>
				</div>

				<div class="myBtnArea">
					<div class="floatRight">
						<span class="myBtnNormal"><a href="#">글쓰기</a></span>
					</div>
				</div>

			</div>
-->
			<!-- 썸네일 게시물 //-->

			<!-- 게시글 보기 //-->
<!--
			<div class="mypageBox">
				<h2>마이페이지 리스트1</h2>

				<div class="combbsView">

					<div class="subjectArea">
						타이틀
						<span class="wDate">2015. 12. 34</span>
					</div>

					<div class="bbsConArea">
						내용이 들어갑니다요
					</div>

				</div>

				<div class="myBtnArea">
					<div class="floatRight">
						<span class="myBtnNormal"><a href="#">목록으로</a></span>
					</div>
				</div>

			</div>
-->
			<!-- 게시글 보기 //-->

			
			

			