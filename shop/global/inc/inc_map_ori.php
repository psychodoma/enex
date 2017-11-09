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
			<!-- conBlock //-->
			<div class="conBlock">
				
				<div class="storeTitle">
					<h2>
						전국 각 지역별 에넥스 매장을 만나보세요.
						<p>항상 고객님의 곁에서 든든한 파트너가 되어 드리겠습니다.</p>
					</h2>
				</div>

				

				<div class="mapArea" id="brandMap"></div>

				<script type="text/javascript" src="http://openapi.map.naver.com/openapi/naverMap.naver?ver=2.0&key=973fa2a6a19a7fb22ddcdd337eb12850"></script>
        <script type="text/javascript">
        	var markerArr = new Array();
          var oPoint = new nhn.api.map.LatLng(37.5010226, 127.0396037);
          var oSize = new nhn.api.map.Size(28, 37);
          var oOffset = new nhn.api.map.Size(14, 37);
					var oIcon = new nhn.api.map.Icon('http://static.naver.com/maps2/icons/pin_spot2.png', oSize, oOffset);
          nhn.api.map.setDefaultPoint('LatLng');
          oMap = new nhn.api.map.Map('brandMap' ,{
                                  point : oPoint,
                                  zoom : 10,
                                  enableWheelZoom : true,
								  <?php if ($_SESSION['ismobile']){ ?>
                                  enableDragPan : false,
								  <?php } else { ?>
                                  enableDragPan : true,
								  <?php } ?>
                                  enableDblClickZoom : false,
                                  mapMode : 0,
                                  activateTrafficMap : false,
                                  activateBicycleMap : false,
                                  minMaxLevel : [ 1, 14 ],
                                  
                                   <? if ($_SESSION['ismobile']) { ?>

										size : new nhn.api.map.Size(window.innerWidth, 354)
		
							        <? } else { ?>
		
										size : new nhn.api.map.Size(1000, 354)
		
									<? } ?>
                                  
                                  
                          });
                          
          var mapZoom = new nhn.api.map.ZoomControl(); // - 줌 컨트롤 선언
          mapZoom.setPosition({left:20, bottom:20}); // - 줌 컨트롤 위치 지정
          oMap.addControl(mapZoom); // - 줌 컨트롤 추가.
          var oLabel = new nhn.api.map.MarkerLabel(); // - 마커 라벨 선언.
          oMap.addOverlay(oLabel); // - 마커 라벨 지도에 추가. 기본은 라벨이 보이지 않는 상태로 추가됨.
                
          oMap.attach('mouseenter', function(oCustomEvent) {

                  var oTarget = oCustomEvent.target;
                  // 마커위에 마우스 올라간거면
                  if (oTarget instanceof nhn.api.map.Marker) {
                          var oMarker = oTarget;
                          oLabel.setVisible(true, oMarker); // - 특정 마커를 지정하여 해당 마커의 title을 보여준다.
                  }
          });

          oMap.attach('mouseleave', function(oCustomEvent) {

                  var oTarget = oCustomEvent.target;
                  // 마커위에서 마우스 나간거면
                  if (oTarget instanceof nhn.api.map.Marker) {
                          oLabel.setVisible(false);
                  }
          });


					var MarkerCnt = 0;
          function getLatLon(addr, tit) {
          	var gUrl = "/global/inc/ajax_geocode.php";
          	var pars = "addr=" + addr;
				    $.ajax ({
				      type: 'POST', // POST 로 전송
				      url: gUrl, // 호출 URL
				      data: pars, // 파라메터 정보 전달
				      success:function(retStr){
				      	//alert(retStr);
								var row = retStr.split("|");
								//alert( row[0]);
															
								var oPoint2 = new nhn.api.map.LatLng(row[1],row[0]);
								
								markerArr[MarkerCnt] = oPoint2;
								
								var oMarker = new nhn.api.map.Marker(oIcon,{ title: tit });
								oMarker.setPoint(oPoint2);
								oMap.addOverlay(oMarker);
								
								if( MarkerCnt == 0 ) {	//첫번째 마커 위치로 이동
									oMap.setCenter(oPoint2);
								}

								oMap.setBound(markerArr);
								console.log(row[0] + ' : ' + row[1]);
								MarkerCnt++;
				      },
				      error:function(e) {
				      	console.log(e.responseText);
// 				        alert("주소값 변환 오류.");
				      }
				    });
          }
          
          function setFocus(addr) {
          	var gUrl = "/global/inc/ajax_geocode.php";
          	var pars = "addr=" + addr;
				    $.ajax ({
				      type: 'POST', // POST 로 전송
				      url: gUrl, // 호출 URL
				      data: pars, // 파라메터 정보 전달
				      success:function(retStr){

								var row = retStr.split("|");
								var oPoint2 = new nhn.api.map.LatLng(row[1],row[0]);

								oMap.setCenterAndLevel(oPoint2,10);
				      },
				      error:function(e) {
				      	console.log(e.responseText);
// 				        alert("주소값 변환 오류.");
				      }
				    });
          }
          
          $(window).load( function() {
												
          });
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
							$markerStr .= "getLatLon('".$row["brOldAddr"]."','".$row["brName"]."');".chr(13);
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
							<td><span class="btnView"><a href="#brandMap" onclick="setFocus('<?= $row["brOldAddr"] ?>')">바로보기</a></span></td>
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
							$markerStr .= "getLatLon('".$row["brOldAddr"]."','".$row["brName"]."');".chr(13);
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
							<td><span class="btnView"><a href="#brandMap" onclick="setFocus('<?= $row["brOldAddr"] ?>')">바로보기</a></span></td>
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