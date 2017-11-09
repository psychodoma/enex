<?
include_once($_SERVER["DOCUMENT_ROOT"]."/global.inc.php");

$db = new dbClass();
$db->openDB($gDBInfo);

if( $brand == "" ) {
	if( $_SERVER["HTTP_HOST"]=="home.enex.co.kr" || $_SERVER["HTTP_HOST"]=="211.43.195.200" ) $brand = "ehome";
	else if( $_SERVER["HTTP_HOST"]=="mall.enex.co.kr" ) $brand = "mall";
	else if( $_SERVER["HTTP_HOST"]=="kitchen.enex.co.kr" ) $brand = "kitchen";
	else if( $_SERVER["HTTP_HOST"]=="interior.enex.co.kr" ) $brand = "interior";
	else if( $_SERVER["HTTP_HOST"]=="ofella.enex.co.kr" ) $brand = "ofella";
	else $brand = "ehome";
}

$whereStr = " WHERE 1=1 ";
$whereStr2 = " WHERE 1=1 ";

if( $brand != "ehome" ) {
	$whereStr .= " AND brCate = '{$brand}' ";
	$whereStr2 .= " AND brCate = '{$brand}' ";
}

if( $sido != "" ) {
	$whereStr .= " AND sido = '{$sido}' ";
} else {
	$gugun = "";
}

if( $gugun != "" ) {
	$whereStr .= " AND gugun = '{$gugun}' ";
}

if( $selTab != "" ) {
	if($selTab == "1"){
	$whereStr .= " AND (brType = '{$selTab}' OR brType = '3') ";
	}else{
	$whereStr .= " AND brType = '{$selTab}' ";
	}

}

if( $sword != "" ) {
	$whereStr .= " AND ( brName LIKE '%{$sword}%' OR brAddress LIKE '%{$sword}%' ) ";
}

if($_GET["zoom"]){
	$zoomcode = 8;
}else{
	$zoomcode = 6;
}


$query = "SELECT count(*) as cnt FROM gc_branch_location {$whereStr}";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$totalCnt = $row["cnt"];

$pageCnt = 10;
$startPage = $nowPage?$nowPage:1;
$limitStr       = " LIMIT ".(($startPage-1)*$pageCnt).", ".$pageCnt;

$query = "SELECT * FROM gc_branch_location {$whereStr} {$limitStr}";
$total_query = "SELECT * FROM gc_branch_location {$whereStr}";
//echo $query;
$res = mysql_query($query);
$total_res = mysql_query($total_query);
?>
<script language="javascript">
function sel_tab(no) {
	$('#selTab').val(no);
	$('#sf').submit();
}
</script>
		<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=slz8lZq_5I82pbWbNYeI&submodules=geocoder"></script>
		<!--<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=_43VhDmUbNG3sqV9ZS79&submodules=geocoder"></script>-->
		
			<!-- conBlock //-->
			<div class="conBlock">
				
				<div class="storeTitle">
					<h2>
						전국 각 지역별 에넥스 매장을 만나보세요.
						<p>항상 고객님의 곁에서 든든한 파트너가 되어 드리겠습니다.</p>
					</h2>
				</div>

				

			<div class="mapArea" id="brandMap" ></div>
			<style>
			
				.iw_inner{padding:10px;}
				.iw_inner div{display:inline-block;}
				.iw_inner div img{margin-top:-10px}
				.iw_inner h1{margin-left:10px;padding-top:3px;font-size:22px;color:black;line-height:30px;}
			</style>

			<script>

			/* NAVER API V3 교체 _ 170310_arcthan */
			var HOME_PATH = window.HOME_PATH || 'https://navermaps.github.io/maps.js/docs/';
			var position = new naver.maps.LatLng(37.5010226, 127.0396037);


			var map = new naver.maps.Map('brandMap', {
				center: position,
				zoom: 5
			});

			
			var markers = [];
			var MarkerCnt = 0;
			var ArrayNum = [];
			var infoWindows = new Array;
			
			function getLatLon(addr,tit,idx){
					//console.log(addr + " / " + tit + "/" + idx);
					naver.maps.Service.geocode({
					address: addr
					}, function(status, response) {
						if (status !== naver.maps.Service.Status.OK) {
							return console.log(tit + ' 검색에 문제가 있습니다.');

						}

						var result = response.result, // 검색 결과의 컨테이너
							items = result.items; // 검색 결과의 배열
							//console.log(result);
							var row = items[0]["point"];
							//console.log(row + " | addr " + tit +" / "+ idx)
							var oPoint2 = new naver.maps.LatLng(row["y"],row["x"])
							
							var marker = new naver.maps.Marker(
							{
									position : oPoint2,
									map: map,
									title : tit,
									icon: {
									url: HOME_PATH +'/img/example/pin_default.png',
									size: new naver.maps.Size(22, 35),
									origin: new naver.maps.Point(0, 0),
									anchor: new naver.maps.Point(11, 35)
									},
									//shadow: {
										//url: HOME_PATH +'/img/example/shadow-pin_default.png',
									//	size: new naver.maps.Size(40, 35),
										//origin: new naver.maps.Point(0, 0),
										//anchor: new naver.maps.Point(11, 35)
									//},
									zIndex:MarkerCnt
							}
							);
							
							markers.push(marker);
							naver.maps.Event.addListener(marker, 'click', function(){onClick()});

							var contentString = [
									'<div id="pp" class="iw_inner"><div><img src="http://image.enex.co.kr/images/global/logo.gif"></div>',
									'   <div id="cc" class="inner"><h1>'+tit+'</h1></div>',
									'</div>'
								].join('');

							var infowindow = new naver.maps.InfoWindow({
								content: contentString
							});
							
							infoWindows.push(infowindow);
							infoWindows[MarkerCnt].open(map,markers[MarkerCnt]);
							infoWindows[MarkerCnt].close();

							ArrayNum.push(tit)
							
							MarkerCnt++;
							
							<?php if($sido != ""){?>
								map.setCenter(oPoint2);
							<?}else{?>
								map.setZoom(4);
								map.setCenter(37.5010226, 127.0396037);
							<?}?>

							if(MarkerCnt == 0 ) {	//첫번째 마커 위치로 이동
								
							}else{

								MarkerCnt
							}
					});
			}



		function onClick(e) {
			var event= e||window.event;
			var eNum = event.currentTarget.style["z-index"];

			//alert(markers.indexOf("title"));
			//console.log(event.currentTarget.style["z-index"]);
			//console.log($(event.currentTarget).attr('title'))
			
			console.log(eNum)

			if(infoWindows[eNum].getMap())
			{
				infoWindows[eNum].close();
			}else{
				infoWindows[eNum].open(map,markers[eNum]);
			}
			
		}
	


		function setFocus(addr,tit,idx) {
			
					//console.log(addr + " / " + tit);
					naver.maps.Service.geocode({
					address: addr
					}, function(status, response) {
						if (status === naver.maps.Service.Status.ERROR) {
							return console.log(tit + '검색에 문제가 있습니다1.');
						}

						var result = response.result, // 검색 결과의 컨테이너
							items = result.items; // 검색 결과의 배열
							
							var row = items[0]["point"];
							//console.log(row + " | addr " + tit + " | idx" + idx)
							var oPoint3 = new naver.maps.LatLng(row["y"],row["x"])

							marker = new naver.maps.Marker(
							{
									position : oPoint3,
							});

							map.setCenter(oPoint3);
							map.setZoom(12);
							
							var pNum = 	ArrayNum.indexOf(" "+tit+" ");

							//console.log()
							infoWindows[pNum].open(map,markers[pNum]);
							map.setCenter(oPoint3);
					});
			}

			//getLatLon("경상남도 진주시 솔밭로 148 (상대동)","진주동부대리점");
			//http://image.enex.co.kr/images/global/logo_interior.gif
			</script>


        

			</div>
			<!-- conBlock //-->

			<div class="storeSearch maB20">
				<form method="GET" id="sf">
					<input type="hidden" name="selTab" id="selTab" value="<?= $selTab ?>">
					<div class="searchBox maR10" id="selEnexCategory">
						<div class="innerSearch">
							<select name="brand" onchange="$('#sf').submit();">
								<option value="ehome"    <?= ($brand=="ehome")?"selected":"" ?>>에넥스 홈</option>
								<option value="kitchen"  <?= ($brand=="kitchen")?"selected":"" ?>>에넥스 키친</option>
								<option value="interior" <?= ($brand=="interior")?"selected":"" ?>>에넥스 인테리어</option>
								<option value="ofella"   <?= ($brand=="ofella")?"selected":"" ?>>에넥스 오피스</option>
							</select>
						</div>
					</div>

					<div class="searchBox maR10">
						<div class="innerSearch">
							<select name="sido" onchange="$('#sf').submit();">
								<option value="" selected>시/도 전체</option>
					<?
					$sQuery = "SELECT sido FROM gc_branch_location {$whereStr2} GROUP BY sido";
					$sRes = mysql_query($sQuery);
					while( $sRow = mysql_fetch_array($sRes) ) {
					?>
								<option value="<?= $sRow["sido"] ?>"  <?= ($sido==$sRow["sido"])?"selected":"" ?>><?= $sRow["sido"] ?></option>
					<?
					}
					?>
							</select>
						</div>
					</div>
					
					<div class="searchBox">
						<div class="innerSearch">
							<select name="gugun" onchange="$('#sf').submit();">
								
					<?
					if( $sido != "" ) {
						echo "<option value=\"\" selected>구/군 전체</option>";
						$sQuery = "SELECT gugun FROM gc_branch_location {$whereStr2} AND sido='{$sido}' GROUP BY gugun";
						$sRes = mysql_query($sQuery);
						while( $sRow = mysql_fetch_array($sRes) ) {
					?>
								<option value="<?= $sRow["gugun"] ?>"  <?= ($gugun==$sRow["gugun"])?"selected":"" ?>><?= $sRow["gugun"] ?></option>
					<?
						}
					} else {
						echo "<option value=\"\" selected>시/도를 선택하세요.</option>";
					}

					?>
							</select>
						</div>
					</div>

					<div class="storeinputBox">
						<input type="text" value="<?= $sword ?>" name="sword" id="sword" class="inputStore" />
						<span class="btnStoreSearch"><a href="javascript:;" onclick="$('#sf').submit();">검색</a></span>
					</div>
				</form>
				</div>

			<div class="conDivComm maT20">

				<div class="storeTab">
					<ul>
						<li class="<?=($selTab=="")?"on":"" ?>"><a href="javascript:sel_tab('');">전체보기</a></li>
						<li class="<?=($selTab=="2")?"on":"" ?>"><a href="javascript:sel_tab('2');">쇼룸</a></li>
						<li class="<?=($selTab=="1")?"on":"" ?>"><a href="javascript:sel_tab('1');">대리점</a></li>
<!-- 						<li class="<?=($selTab=="3")?"on":"" ?>"><a href="javascript:sel_tab('3');">기타</a></li> -->
					</ul>
				</div>

				<div class="storeTable">
					
					<? if ($_SESSION['ismobile']) { ?>
					
					<table>
<!--
						<colgroup>
						<col width="150px;" />
						<col width="*" />
						<col width="130px;" />
						<col width="85px;" />
						<col width="85px;" />
						<col width="100px;" />
						</colgroup>
-->
						<tr>
							<th>지점</th>
							<th>전시제품</th>
							<th>위치보기</th>
							<th><img src="<?=_IMAGES_URL_?>/kitchen/common/t_yid.gif" alt="Yellow ID" /></th>
						</tr>
					<?
					if( mysql_num_rows($res) == 0 ) {
					?>
						<tr>
							<td colspan="5" height="100" align="center">조회된 매장이 없습니다.</td>
						</tr>
					<?
					} else {
						$markerStr = "";
						while( $row = mysql_fetch_array($total_res) ) {
							$markerStr .= "getLatLon('".$row["brOldAddr"]."','".$row["brName"]."','".$row["idx"]."');".chr(13);
						}
						while( $row = mysql_fetch_array($res) ) {
							$brandStr = "";
							switch( $row["brCate"] ) {
								case "kitchen" : $brandStr = "에넥스 키친"; break;
								case "interior" : $brandStr = "에넥스 인테리어"; break;
								case "ofella" : $brandStr = "에넥스 오피스"; break;
							}
							//($row["brZip"])
					?>
						<tr>
							<!--td><?= $brandStr ?></td-->
							<td>
								<p><?= $row["brName"] ?></p>
								<p><?= $row["brAddress"] ?></p>
								<p><?= $row["brTel"] ?></p>
							</td>
							<td><span class="btnView"><a href="javascript:;" onclick="openPopup(<?=$row["idx"]?>)">바로보기</a></span></td>
							<td><span class="btnView"><a href="#brandMap" onclick="setFocus('<?= $row["brOldAddr"] ?>','<?= $row["brName"]?>','<?= $row["idx"]?>')">바로보기</a></span></td>
							<td><span class="btnView"><a href="javascript:;" onclick="alert('매장 아이디 입력 전입니다.')">미정</a></span></td>
						</tr>
							
					<?
						}
					}
					?>
					</table>
						
					<? } else { ?>
						
					
					
					<table>
						<colgroup>
						<col width="150px;" />
						<col width="*" />
						<col width="130px;" />
						<col width="85px;" />
						<col width="85px;" />
						<col width="100px;" />
						</colgroup>
						<tr>
							<th>지점명</th>
							<th>주소</th>
							<th>전화</th>
							<th>전시제품</th>
							<th>위치보기</th>
							<th><img src="<?=_IMAGES_URL_?>/kitchen/common/t_yid.gif" alt="Yellow ID" /></th>
						</tr>
					<?

					if( mysql_num_rows($res) == 0 ) {
					?>
						<tr>
							<td colspan="5" height="100" align="center">조회된 매장이 없습니다.</td>
						</tr>
					<?
					} else {
						$markerStr = "";
						while( $row = mysql_fetch_array($total_res) ) {
							$markerStr .= "getLatLon('".$row["brOldAddr"]." ',' ".$row["brName"]." ',' ".$row["idx"]."');".chr(13);
						}
						while( $row = mysql_fetch_array($res) ) {
							$brandStr = "";
							switch( $row["brCate"] ) {
								case "kitchen" : $brandStr = "에넥스 키친"; break;
								case "interior" : $brandStr = "에넥스 인테리어"; break;
								case "ofella" : $brandStr = "에넥스 오피스"; break;
							}
							//($row["brZip"])

					?>
						<tr>
							<!--td><?= $brandStr ?></td-->
							<td><?= $row["brName"] ?></td>
							<td><?= $row["brAddress"] ?></td>
							<td><?= $row["brTel"] ?></td>
							<td><span class="btnView"><a href="javascript:;" onclick="openPopup(<?=$row["idx"]?>)">바로보기</a></span></td>
							<td><span class="btnView"><a href="#brandMap" onclick="setFocus('<?= $row["brOldAddr"] ?>','<?= $row["brName"]?>','<?= $row["idx"]?>')">바로보기</a></span></td>
							<td><span class="btnView"><a href="javascript:;" onclick="alert('매장 아이디 입력 전입니다.')">미정</a></span></td>
						</tr>
							
					<?
						}
					}
					?>
					</table>
					<? } ?>
					<br><br>
					<!-- #paging -->
          <?
          echo baseClass::drawPagingUserNavi($totalCnt, $nowPage);
          ?>
					<!-- /#paging -->
				                	
          <script language="javascript">
                function goPage(pgNum) {
                 location.href = '?<?=utilClass::url_parse("nowPage")?>&nowPage='+pgNum;
                }
          </script>  
	          
				</div>

			</div>

<script language="javascript">

$(window).load( function() {
<?= $markerStr ?>
});


function openPopup(idx) {
	var oUrl = "./store_info_popup.php?idx="+idx;
	window.open(oUrl, "ENEXSEARCHPOPUP", "width=600, height=500, toolbars=no, menubars=no, scrollbars=yes");
}

</script>




