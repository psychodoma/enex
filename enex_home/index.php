<?
include_once($_SERVER["DOCUMENT_ROOT"]."/global.inc.php");
include_once($_SERVER["DOCUMENT_ROOT"]._GLOBAL_INC_."/dtd_ehome.php");

$db = new dbClass();
$db->openDB($gDBInfo);

?>



<!-- AceCounter Log Gathering Script V.7.5.20151110_HAN -->
<script language='javascript'>
	var _AceGID=(function(){var Inf=['gtp2.acecounter.com','8080','AH2A40197664641','AW','0','NaPm,Ncisy','ALL','0']; var _CI=(!_AceGID)?[]:_AceGID.val;var _N=0;var _T=new Image(0,0);if(_CI.join('.').indexOf(Inf[3])<0){ _T.src =( location.protocol=="https:"?"https://"+Inf[0]:"http://"+Inf[0]+":"+Inf[1]) +'/?cookie'; _CI.push(Inf);  _N=_CI.length; } return {o: _N,val:_CI}; })();
	var _AceCounter=(function(){var G=_AceGID;if(G.o!=0){var _A=G.val[G.o-1];var _G=( _A[0]).substr(0,_A[0].indexOf('.'));var _C=(_A[7]!='0')?(_A[2]):_A[3];	var _U=( _A[5]).replace(/\,/g,'_');var _S=((['<scr','ipt','type="text/javascr','ipt"></scr','ipt>']).join('')).replace('tt','t src="'+location.protocol+ '//cr.acecounter.com/Web/AceCounter_'+_C+'.js?gc='+_A[2]+'&py='+_A[4]+'&gd='+_G+'&gp='+_A[1]+'&up='+_U+'&rd='+(new Date().getTime())+'" t');document.writeln(_S); return _S;} })();
</script>
<noscript><img src='http://gtp2.acecounter.com:8080/?uid=AH2A40197664641&je=n&' border='0' width='0' height='0' alt=''></noscript>	
<!-- AceCounter Log Gathering Script End -->


<!-- 팝업 -->
<style type="text/css">
#layerPopBg #layerPop{width:460px; height:420px; position:absolute; left:50px; top:150px; border:2px solid #ed1651; background:#ed1651; display:block; z-index:9999;}
#layerPopBg #layerPop .close{position:absolute;bottom:5px;right:5px; color:white; background-color: black; width:50px; height:30px; line-height: 30px;text-align: center;}
#layerPopBg #layerPop .go_event{position:absolute; bottom:10px;left:130px; font-size:16px;color:white; background-color:#6d2a3c; width:200px; height:40px; line-height: 40px;text-align: center;}
#layerPopBg {z-index:1;}

#layerPopBg2 #layerPop{width:460px; height:460px; position:absolute; left:120px; top:240px; border:2px solid black; background:black; display:block; z-index:8888;}
#layerPopBg2 #layerPop .close{position:absolute; bottom:5px;right:5px; color:white; background-color: gray; width:45px; height:30px; line-height: 30px;text-align: center;}
#layerPopBg2 #layerPop .go_event{position:absolute; bottom:5px;left:205px; font-size:15px;color:black;background-color:white; width:200px; height:30px; line-height: 30px;text-align: center;}
#layerPopBg2 {z-index:2;}

</style>
<script type="text/javascript">
 function closeLayer(){
  var layerPopBg = document.getElementById("layerPopBg");
  layerPopBg.style.display = "none";
 }
  function closeLayer2(){
  var layerPopBg = document.getElementById("layerPopBg2");
  layerPopBg.style.display = "none";
 }
</script>




</head>
<body>


<!-- 레이어 팝업 처리 arcthan 20160112 -->

<!-- 주방가구 아이디어 공모전 팝업
<div id="layerPopBg">
 <div id="layerPop">
	 <a href="http://www.enex.co.kr/event/idea"><img src="http://image.enex.co.kr/images/home/popup/newidea_popup.jpg" /></a>
	 <a href="http://www.enex.co.kr/event/idea" class="go_event" >▷ 공모전 참여하기</a>
	 <a href="#" class="close" onclick="closeLayer();">닫기</a>
 </div>
</div>

<!-- 주방 리모델링 이벤트 
<div id="layerPopBg2">
 <div id="layerPop">
 <a href="http://kitchen.enex.co.kr/global/board/list.php?code=k_event&mode=view&idx=34"><img src="http://image.enex.co.kr/images/home/popup/new_remodeling_pop.gif" /></a>
 <a href="http://kitchen.enex.co.kr/global/board/list.php?code=k_event&mode=view&idx=34" class="go_event" > 이벤트 내용보러가기</a>
 <a href="#" class="close" onclick="closeLayer2();">닫기</a>
 </div>
</div>

<!-- 팝업 끝 -->

<!-- #wrap //-->
<div id="wrap">

	<!-- #globalHeader //-->
	<?
	include_once($_SERVER["DOCUMENT_ROOT"]._GLOBAL_INC_."/glo_header.php");
	?>
	<!-- #globalHeader //-->

	<!-- #homeHeader //-->
	<?
	include_once($_SERVER["DOCUMENT_ROOT"]."/_inc/gnb.php");
	?>
	<!-- #homeHeader //-->

	<!-- #homeVisual //-->
	<div id="homeVisual">
		<div class="sliderkit photoslider-1click">	
			<div class="sliderkit-nav">
				<div class="sliderkit-nav-clip">
					<ul>
						<li><a href="#" title=""></a></li>
						<li><a href="#" title=""></a></li>
						<li><a href="#" title=""></a></li>
						<li><a href="#" title=""></a></li>
					</ul>
				</div>
			</div>

			<div class="sliderkit-go-btn sliderkit-go-prev" style="position:absolute; left:0; top:240px; z-index:999;">
				<a rel="nofollow" href="#" title="Previous" onfocus="blur()"><span><img src="<?=_IMAGES_URL_?>/home/common/ar_left.png" alt="왼쪽이미지" /></span></a>
			</div>
			<div class="sliderkit-go-btn sliderkit-go-next" style="position:absolute; right:0; top:240px; z-index:999;">
				<a rel="nofollow" href="#" title="Next"  onfocus="blur()"><span><img src="<?=_IMAGES_URL_?>/home/common/ar_right.png" alt="오른쪽 이미지" /></span></a>
			</div>

			<div class="sliderkit-panels">
				<div class="sliderkit-panel">
					<a href=""><img src="<?=_IMAGES_URL_?>/home/common/main_20171109.jpg" alt=""/></a>
				</div>
				<div class="sliderkit-panel">
					<a href=""><img src="<?=_IMAGES_URL_?>/home/common/main-20170529_1.jpg" alt=""/></a>
				</div>
				<div class="sliderkit-panel">
					<a href="http://enex.co.kr/global/board/list.php?code=h_media&mode=view&idx=25"><img src="<?=_IMAGES_URL_?>/home/common/main-20170529_2.jpg" alt=""/></a>
				</div>

				<div class="sliderkit-panel">
					<a href="http://ofella.enex.co.kr/catalog/catalog.php"><img src="<?=_IMAGES_URL_?>/home/common/main-20170529_3.jpg" alt=""/></a>
				</div>
			</div>

		</div>
	</div>
	<!-- #homeVisual //-->

	<!-- #brandPart //-->
	<div id="brandPart">
		<ul>
			<li><a href="http://mall.enex.co.kr"><img src="<?=_IMAGES_URL_?>/home/common/go_mall_off.gif" alt="에넥스 몰" /></a></li>
			<li><a href="http://kitchen.enex.co.kr"><img src="<?=_IMAGES_URL_?>/home/common/go_kitchen_off.gif" alt="에넥스 키친&붙박이장" /></a></li>
			<li><a href="http://interior.enex.co.kr"><img src="<?=_IMAGES_URL_?>/home/common/go_living_off.gif" alt="에넥스 리빙가구" /></a></li>
			<li><a href="http://ofella.enex.co.kr"><img src="<?=_IMAGES_URL_?>/home/common/go_opella_off.gif" alt="에넥스 오펠라 사무가구" /></a></li>
		</ul>
	</div>
	<!-- #brandPart //-->
	
	<!-- #partArea //-->

	<?
		$boarddb = new boardClass();
		$mRes = $boarddb->getboardbanner("홈배너-몰");
?>

<style>
	.partSec a:hover .partitem{border:1px solid #333;}
</style>
	<div id="partArea">
		<!-- 에넥스 몰 //-->
		<div class="partSec padR37" style="padding-right:20px">

			<ul>
				<?
//				$array_res = mysql_fetch_array($mRes);
				$mQuery = "SELECT * FROM enex_shop.gd_banner where sno = 140 or sno = 139 ";
				$mRes2 = mysql_query($mQuery);
				$array_res2 = mysql_fetch_array($mRes2);
				//while( $mRow = mysql_fetch_array($mRes) ) {
				?>
				<li>

					<a href="<?=$array_res2["linkaddr"]?>" target="_blank">
						<div class="partitem">
							<p><img src="http://mall.enex.co.kr/shop/data/skin/standard/img/banner/<?=$array_res2["img"]?>" alt="" /></p>
							<div class="sumTxt"><!--<p class="subCopy padB03">에넥스 몰</p>--><p class="headCopy_s bold padTB10"><?=$array_res2["bannersubject"]?></p> <p class="summery_s"><?=$array_res2["bannertext"]?></p></div>

						</div>
					</a>
				</li>
				<!-- <li style="display:none">

					<a href="<?=$array_res["opt1"]?>" target="_blank">
					<div class="partitem">
						<p><img src="<?=str_replace("/www/enex_home","http://www.enex.co.kr",$array_res["filepath"])?>" alt="" /></p>
						<div class="sumTxt">
							<?=str_replace("\\","",$array_res["content"])?>
						</div>
					</div>
					</a>
				</li> -->
				<?
					$array_res2 = mysql_fetch_array($mRes2);

				?>
				<!-- <li>
					<a href="<?=$array_res["opt1"]?>" target="_blank">
					<div class="partitem">
						<p><img src="<?=str_replace("/www/enex_home","http://www.enex.co.kr",$array_res["filepath"])?>" alt="" /></p>
						<div class="sumTxt"><p class="headCopy_s bold padTB10"><?=$array_res["opt2"]?></p> <p class="summery_s"><?=$array_res["content"]?></p></div>
					</div>
					</a>
				</li> -->
				<li>

					<a href="<?=$array_res2["linkaddr"]?>" target="_blank">
						<div class="partitem">
							<p><img src="http://mall.enex.co.kr/shop/data/skin/standard/img/banner/<?=$array_res2["img"]?>" alt="" /></p>
							<div class="sumTxt"><!--<p class="subCopy padB03">에넥스 몰</p>--><p class="headCopy_s bold padTB10"><?=$array_res2["bannersubject"]?></p> <p class="summery_s"><?=$array_res2["bannertext"]?></p></div>

						</div>
					</a>
				</li>
			</ul>

		</div>

		<div class="partSec" style="margin-right:16px;width:1px; height:500px; margin-top: 50px;  margin-bottom:100px; background:#efefef; display:block;float:left;"> </div>
		<!-- 에넥스 몰 //-->
		

		<!-- 에넥스 키친 //-->
		<div class="partSec padR37" style="padding-right:20px">
			<ul>
				<?
				$mRes = $boarddb->getboardbanner("홈배너-키친");
					$array_res = mysql_fetch_array($mRes);
				?>
				<li>
					<a href="<?=$array_res["opt1"]?>" target="_blank">
					<div class="partitem">
						<p><img src="<?=str_replace("/www/enex_home","http://www.enex.co.kr",$array_res["filepath"])?>" alt="" /></p>
						<div class="sumTxt">
								<!--<p class="subCopy padB03">에넥스 키친</p>-->
								<p class="headCopy_s bold padTB10"><?=$array_res["opt2"]?></p>
								<p class="summery_s"><?=str_replace("\\","",$array_res["content"])?></p>
						</div>
					</div>
					</a>
				</li>
				<?
					$array_res = mysql_fetch_array($mRes);
				?>
				<li>
					<a href="<?=$array_res["opt1"]?>" target="_blank">
					<div class="partitem">
						<p><img src="<?=str_replace("/www/enex_home","http://www.enex.co.kr",$array_res["filepath"])?>" alt="" /></p>
						<div class="sumTxt">
<!--							<p class="subCopy padB03">에넥스 키친</p>-->
							<p class="headCopy_s bold padTB10"><?=$array_res["opt2"]?></p>
							<p class="summery_s"><?=str_replace("\\","",$array_res["content"])?></p>
						</div>
					</div>
					</a>
				</li>
			</ul>
		</div>
		<!-- 에넥스 키친 //-->
		<div class="partSec" style="margin-right:16px;width:1px; height:500px; margin-top: 50px;  margin-bottom:100px; background:#efefef; display:block;float:left;"> </div>
		
		<!-- 에넥스 인테리어 //-->
		<div class="partSec padR36" style="padding-right:20px">
			<ul>
				<?
				$mRes = $boarddb->getboardbanner("홈배너-인테리어");
					$array_res = mysql_fetch_array($mRes);
				?>
				<li>
					<a href="<?=$array_res["opt1"]?>" target="_blank">
					<div class="partitem">
						<p><img src="<?=str_replace("/www/enex_home","http://www.enex.co.kr",$array_res["filepath"])?>" alt="" width="223px" height="207px" /></p>
						<div class="sumTxt">
							<!--<p class="subCopy padB03">에넥스 인테리어</p>-->
							<p class="headCopy_s bold padTB10"><?=$array_res["opt2"]?></p>
							<p class="summery_s"><?=str_replace("\\","",$array_res["content"])?></p>
						</div>
					</div>
					</a>
				</li>
				<?
					$array_res = mysql_fetch_array($mRes);
				?>
				<li>
					<a href="<?=$array_res["opt1"]?>" target="_blank">
					<div class="partitem">
						<p><img src="<?=str_replace("/www/enex_home","http://www.enex.co.kr",$array_res["filepath"])?>" alt="" width="223px" height="207px" /></p>
						<div class="sumTxt">
							<!--<p class="subCopy padB03">에넥스 인테리어</p>-->
							<p class="headCopy_s bold padTB10"><?=$array_res["opt2"]?></p>
							<p class="summery_s"><?=str_replace("\\","",$array_res["content"])?></p>
						</div>
					</div>
					</a>
				</li>
			</ul>
		</div>
		<!-- 에넥스 인테리어 //-->
		<div class="partSec" style="margin-right:16px;width:1px; height:500px; margin-top: 50px;  margin-bottom:100px; background:#efefef; display:block;float:left;"> </div>
		

		<!-- 오펠라 //-->
		<div class="partSec">

			<ul>
				<?
				$mRes = $boarddb->getboardbanner("홈배너-오펠라");
					$array_res = mysql_fetch_array($mRes);
				?>
				<li>
					<a href="<?=$array_res["opt1"]?>" target="_blank">
					<div class="partitem">
						<p><img src="<?=str_replace("/www/enex_home","http://www.enex.co.kr",$array_res["filepath"])?>" alt="" /></p>
						<div class="sumTxt">
							<!--<p class="subCopy padB03">에넥스오피스</p>-->
							<p class="headCopy_s bold padTB10"><?=$array_res["opt2"]?></p>
							<p class="summery_s"><?=str_replace("\\","",$array_res["content"])?></p>
						</div>
					</div>
					</a>
				</li>
				<?
					$array_res = mysql_fetch_array($mRes);
				?>
				<li>
					<a href="<?=$array_res["opt1"]?>" target="_blank">
					<div class="partitem">
						<p><img src="<?=str_replace("/www/enex_home","http://www.enex.co.kr",$array_res["filepath"])?>" alt="" /></p>
						<div class="sumTxt">
							<!--<p class="subCopy padB03">에넥스오피스</p>-->
							<p class="headCopy_s bold padTB10"><?=$array_res["opt2"]?></p>
							<p class="summery_s"><?=str_replace("\\","",$array_res["content"])?></p>
						</div>
					</div>
					</a>
				</li>
			</ul>

		</div>
		<!-- 오펠라 //-->

		<div class="partShow">

			<div class="tShow">
				<!--
				<p class="subTitle">에넥스 매장정보</p>
				<h2>스마트 홈인테리어<br/>매장 오픈</h2>
				<p class="summery">
					스마트 부산 직영점에서 주방과<br/>
					거실, 침실, 욕실까지 리모델링에<br/>
					필요한 모든 시스템 가구를<br/>
					원스톱으로 편리하게 이용하세요.
				</p>
				-->

				<p class="subTitle">에넥스 VIDEO</p>
				<h2>
					스타일에 취하다<br/>
					논현 멀티플렉스샵
				</h2>
				<p class="summery">
					에넥스의 다양한 가구와 건자재까지<br/>
					보다 손쉽게 만나보는 멀티플렉스샵!
				</p>
				<p class="summery">
					앞선 인테리어 트랜드와 공간별<br/>
					다양하게 꾸민 홈 스타일링도 만나보세요.
				</p>

				<!--
				<div class="partLocation">
					<p><a href="http://smart.enex.co.kr/images/kitchen/smart/smart_store.png" target="_blank">스마트 부산 직매장 위치보기</a></p>
					<p><a href="/store/store.php">전국 에넥스 매장 보기</a></p>
				</div>
				-->
			</div>

			<div class="tPhoto">
				<!--<img src="<?=_IMAGES_URL_?>/home/common/temp_showroom1.jpg" alt="" />-->
				<iframe width="483" height="300" src="https://www.youtube.com/embed/7edGekXc8f0" frameborder="0" allowfullscreen></iframe>
			</div>

		</div>

		<div class="partSec">
			<?
			$boarddb = new boardClass();
			$mRes = $boarddb->getboardbanner("에넥스홈-매장정보오른쪽배너");
			?>
			<ul>
				<li>
					<?
					$array_res = mysql_fetch_array($mRes);
					?>
					<a href="<?=$array_res["opt1"]?>" target="_blank">
					<div class="partitem">
						<!--<p><img src="<?=_IMAGES_URL_?>/home/common/brand_thumb/home_1_150722.jpg" alt="" /></p>
						<div class="sumTxt">
							<p class="headCopy_s bold padTB10">에넥스 유저 리뷰</p>
							<p class="summery_s">에넥스를 사용 하는 고객님이 직접 올려주시는 생생리뷰!</p>
						</div>
						-->
						<div class="sumTxt">
							<p class="summery_s"><?=str_replace("\\","",$array_res["content"])?></p>
							<p class="headCopy_s bold padTB10"><?=$array_res["opt2"]?></p>
						</div>
						<p class="store_photo"><img src="<?=str_replace("/www/enex_home","http://www.enex.co.kr",$array_res["filepath"])?>" alt="<?=$array_res["opt2"]?>"</p>
						
						<div class="partLocation">
							<p><a href="http://smart.enex.co.kr/images/kitchen/smart/smart_store.png" target="_blank">홈 스마트 매장 위치보기</a></p>
							<p><a href="/store/store.php">전국 에넥스 매장 보기</a></p>
						</div>

					</div>
					</a>
				</li>
			</ul>

		</div>
	</div>
	<!-- #partArea //-->

	<!-- #blogArea //-->
	<div id="blogArea">
		<div class="blogSummery">
			<h2>에넥스 블로그</h2>
			<p>
				에넥스의 다양한 소식과 정보!<br>
				이웃과 함께 하는 즐거운 이야기를<br>
				블로그에서 지금 만나보세요.
			</p>
			<div class="goSnsBtn">
				<p><a href="http://blog.naver.com/enexhome" target="_blank"><img src="<?=_IMAGES_URL_?>/home/common/btn_blog.gif" alt="" /></a></p>
				<p><a href="https://www.facebook.com/enexhome" target="_blank"><img src="<?=_IMAGES_URL_?>/home/common/btn_fb.gif" alt="" /></a></p>
			</div>
		</div>
		<div class="blogList">
			<ul>
				<?
				$boarddb = new boardClass();
				$mRes = $boarddb->getboardbanner("에넥스홈-블로그");

				//$array_res = mysql_fetch_array($mRes);
				//print_r($array_res);
				while( $mRow = mysql_fetch_array($mRes) ) {
				?>
					<li>
						<a href="<?=$mRow["opt1"]?>" target="_blank">
							<div class="blogSec">
								<p class="padT03"><img src="<?=str_replace("/www/enex_home","http://www.enex.co.kr",$mRow["filepath"])?>" alt="" width="157" height="157"/></p>
								<h2><?=$mRow["opt2"]?></h2>
								<p class="padB10">
									<?=mb_strimwidth($mRow["content"],0,150,"...","utf-8")?>
								</p>
							</div>
						</a>
					</li>
				<?}?>
			</ul>
		</div>
	</div>
	<!-- #blogArea //-->

	<!-- #bbsArea //-->
	<div id="bbsArea">

		<div class="prZone">
			<h2 class="wd125">휴먼퍼니쳐 에넥스</h2>
			<div class="prSec">
				<dl>
					<dt><img src="<?=_IMAGES_URL_?>/home/common/thumb.gif" alt="" /></dt>
					<dd>
						<p class="tBlack">
							공간은 더 아름답게, 생활은 더 편리하게! 에넥스는 고객에게 최고의 제품과 최상의 서비스를 제공함으로써 보다 나은 생활과 인간행복, 환경친화적 공간을 창조하고자 합니다.
						</p>
						<p>
							<span class="bulletAr tGray"><a href="/company/overview.php">회사소개 <img src="<?=_IMAGES_URL_?>/home/common/bullet_ar01.png" alt="" /></a></span>&nbsp;
							<span class="bulletAr tGray"><a href="/operate/rnd.php">지속가능경영 <img src="<?=_IMAGES_URL_?>/home/common/bullet_ar01.png" alt="" /></a></span>
						</p>
					</dd>
				</dl>
			</div>
		</div>

		<div class="bbsNotice">
			<h2><a href="/global/board/list.php?code=h_notice">공지사항</a></h2>
			<ul>
<?
$mQuery = "SELECT * FROM gc_board_h_notice ORDER BY idx DESC limit 4";
$mRes = mysql_query($mQuery);
while( $mRow = mysql_fetch_array($mRes) ) {
?>
		<li><a href="/global/board/list.php?code=h_notice&mode=view&idx=<?=$mRow["idx"]?>"><?= $mRow["title"] ?> <span class="mDate"><?= str_replace("-"," .",substr($mRow["regdate"],0,10))?></span></a></li>
<?
}
?>

			</ul>
		</div>

	</div>
	<!-- #bbsArea //-->

	<!-- #footer //-->
	<?
	include_once($_SERVER["DOCUMENT_ROOT"]._GLOBAL_INC_."/glo_footer.php");
	?>
	<!-- #footer //-->

</div>
<!-- #wrap //-->

</body>
</html>

