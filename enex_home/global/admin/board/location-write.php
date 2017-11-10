<?
include $_SERVER["DOCUMENT_ROOT"]."/global/include/admin_header.php";
$boardConfig = new boardConfigClass();
$location_code = "false";

// 상품 리스트 불러오기

function get_location_select($search=""){
	$search = preg_replace("/\s+/", "", $search);

	$sql_query01 = mysql_query(" select * from gc_board_k_prod01 where replace(title,' ','') like '%".$search."%' ");
	$sql_query02 = mysql_query(" select * from gc_board_k_prod02 where replace(title,' ','') like '%".$search."%' ");
	$sql_query03 = mysql_query(" select * from gc_board_i_pakage where replace(title,' ','') like '%".$search."%' ");

	$prod01_select = "전시제품 : <select style='height:30px;'>";

	$prod01_select .= "<optgroup label='현재 전시 주방제품'>";
	while ($row = mysql_fetch_array($sql_query01)) {
		$prod01_select .= "<option value=00001".$row['idx'].">";
		$prod01_select .= $row['title'];
		$prod01_select .= "</option>";
	}
	$prod01_select .= "</optgroup>";

	$prod01_select .= "<optgroup label='현재 전시 주방제품'>";
	while ($row = mysql_fetch_array($sql_query02)) {
		$prod01_select .= "<option value=00002".$row['idx'].">";
		$prod01_select .= $row['title'];
		$prod01_select .= "</option>";
	}
	$prod01_select .= "</optgroup>";

	$prod01_select .= "<optgroup label='리빙가구'>";
	while ($row = mysql_fetch_array($sql_query03)) {
		$prod01_select .= "<option value=00003".$row['idx'].">";
		$prod01_select .= $row['title'];
		$prod01_select .= "</option>";
	}
	$prod01_select .= "</optgroup>";

	$prod01_select .= "</select>";

	return $prod01_select;
}

if($_REQUEST[action] == "addProduct")
{
	global $gDBInfo;
	$db = new dbClass();
	$db->openDB($gDBInfo);
	$sql = "insert into gc_branch_prd_list (br_idx, prd_kitchen, prd_kitchen_table, prd_kitchen_idx, prd_etc, prd_etc_table, prd_etc_idx) values(" .$_REQUEST[idx] . ", '" . serialize($prd_kitchen) . "', '".$_REQUEST[prd_kitchen_table]."','".$_REQUEST[prd_kitchen_idx]."', '" . $_REQUEST[prd_etc]  . "','".$_REQUEST[prd_etc_table]."','".$_REQUEST[prd_etc_idx]."')";

	echo $sql;

	$db->queryDB($sql);
}else if($_REQUEST[action] == "delProduct"){
	global $gDBInfo;
	$db = new dbClass();
	$db->openDB($gDBInfo);
	$sql = "delete from gc_branch_prd_list where idx = " . $_REQUEST[del_idx];
	$db->queryDB($sql);
	echo "<script text='javascript/text'>document.location='location-write.php?mode=" . $_REQUEST[mode]. "&code=" . $_REQUEST[code] . "&idx=". $_REQUEST[idx]. "'</script>";
}else if($_REQUEST[action] == "modifyProduct"){

}


if($_REQUEST[code] == "k_location" || $_REQUEST[code] == "i_location"){
	$location_code = "true";
}

$board = new locationClass();

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
if($_REQUEST[idx]) {
    $board->idx = $_REQUEST[idx];
    $board->getBoardInfo();
	$board->getProductList();
}
if($boardConfig->category_yn == "Y") {
    $board->getBoardCategoryList();
}

if( $board->write_name == "" )  {
	$board->write_name = $_COOKIE["ADMINUSERNAME"];
}

if( $board->write_id == "" )  {
	$board->write_id = $_COOKIE["ADMINUSERID"];
}

?>
<script type="text/javascript" src="/global/se_editor/js/HuskyEZCreator.js" charset="utf-8"></script>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="30">&nbsp;</td>
                      </tr>
                      <tr>
                        <td>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_ic_listbox01.gif" width="14" height="14" align="absmiddle"> <font color="000000" style="font-size:15px"><strong><?= $boardConfig->name ?> - 등록/수정</strong></font></td>
                              </tr>
                              <tr>
                                <td height="8"></td>
                              </tr>
                              <tr>
                                <td height="1" bgcolor="d8d8d8"></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="20">&nbsp;</td>
                          </tr>
                          <tr>
                            <td>

<script language="javascript">
function chkForm() {

  if($('#brName').val() == "") {
      alert('지점명을 입력해주세요.');
      return false;
  }
  if($('#brAddress').val() == "") {
      alert('주소를 입력해주세요.');
      return false;
  }
  if($('#brTel').val() == "") {
      alert('연락처를 입력해주세요.');
      return false;
  }
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="30">&nbsp;</td>
              </tr>
              <form method="post" action="http://www.enex.co.kr/global/admin/board/proc.php" name="gcForm" id="gcForm" enctype="multipart/form-data" onsubmit="return chkForm()">
              <input type="hidden" name="act" id="act" value="save">
              <input type="hidden" name="idx"  id="idx" value="<?=$_REQUEST[idx]?>">
              <input type="hidden" name="code"  id="code" value="<?=$_REQUEST[code]?>">
              <input type="hidden" name="opt1"  id="opt1" value="<?= $board->opt1?>">
              <input type="hidden" name="write_id" id="write_id" value="<?= $board->write_id ?>">

              <input type="hidden" name="mode" id="mode" value="<?=$_REQUEST[mode]=="location_write"||$_REQUEST[mode]==""?"location_write":"location_update"?>">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="100%" height="1" bgcolor="#e5e5e5"></td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                          <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="20">&nbsp;</td>
                                    <td><span style="padding-left:19px">지점명</span></td>
                                  </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td>
                                        <input type="text" size="90" name="brName" id="brName" class="txtbox"  value="<?=$board->brName[0]?>" />
                                    </td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>

						  <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="20">&nbsp;</td>
                                    <td><span style="padding-left:19px">노출선택</span></td>
                                  </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td>
                                        <input type="radio"  name="brType" id="brType1" class=""  value="1" <?=$board->brType[0] == '1' ? 'checked':'';?>/> 대리점
                                        <input type="radio"  name="brType" id="brType2" class=""  value="2" <?=$board->brType[0] == '2' ? 'checked':'';?>/> 쇼룸
                                        <!-- <input type="radio"  name="brType" id="brType3" class=""  value="3" <?=$board->brType[0] == '3' ? 'checked':'';?>/> 기타 -->
                                    </td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>

                          <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="20">&nbsp;</td>
                                    <td><span style="padding-left:19px">새주소(디스플레이주소)</span></td>
                                  </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td>
                                        (우)<input type="text" size="8" name="brZip" id="brZip" class="txtbox"  value="<?=$board->brZip[0]?>" />
                                        <input type="text" size="90" name="brAddress" id="brAddress" class="txtbox"  value="<?=$board->brAddress[0]?>" />
                                    </td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
                          <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="20">&nbsp;</td>
                                    <td><span style="padding-left:19px">번지주소(구글맵표시주소)</span></td>
                                  </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td>
                                        <input type="text" size="90" name="brOldAddr" id="brOldAddr" class="txtbox"  value="<?=$board->brOldAddr[0]?>" />
                                    </td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>


                          <tr>
                            <td height="32" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">연락처</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="10">&nbsp;</td>
                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="5"></td>
                                        </tr>
                                        <tr>
                                          <td>
										  <input type="text" size="90" name="brTel" id="brTel" class="txtbox"  value="<?=$board->brTel[0]?>" /></td>
                                        </tr>
                                        <tr>
                                          <td height="5"></td>
                                        </tr>
                                      </table></td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
                          <tr>
                            <td height="32" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">시도/구군</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="10">&nbsp;</td>
                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="5"></td>
                                        </tr>
                                        <tr>
                                          <td>
										  <input type="text" size="10" name="sido" id="sido" class="txtbox"  value="<?=$board->sido[0]?>" />/
										  <input type="text" size="10" name="gugun" id="gugun" class="txtbox"  value="<?=$board->gugun[0]?>" />
										  </td>
                                        </tr>
                                        <tr>
                                          <td height="5"></td>
                                        </tr>
                                      </table></td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
						  <? if($_REQUEST[mode]){?>
						                            <tr>
                            <td height="32" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">전시제품</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="10">&nbsp;</td>
                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="5"></td>
                                        </tr>
                                        <tr>
                                          <td>



																						<div style='padding:10px; height:30px;'>
																							<div class='select_area' style='float:left;'><?=get_location_select();?></div>&nbsp;<input type='text' class='select_word' name='search' style='height:100%;'> <button class='location_search' onclick="return false;" style='height:100%;'>검색</button>
																						</div>

										  <table width="100%" border="0" cellspacing="0" cellpadding="0">



                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td><table width="100%" border="1" cellspacing="0" cellpadding="0" >
									 <tr>
                                    <td width="400" align="center" style='height:35px;'>현재 전시 주방제품</td>
                                   <td width="400" align="center">&nbsp;현재 전시 붙박이, 인테리어제품</td>
                                   <td align="center">&nbsp;줄 삭제/추가</td>
									</tr>
								  								<?
                                  for($i=0;$i < $board->rowCnt; $i++) {
                                  ?>
																	<?$sql_values = mysql_query(" select * from gc_branch_prd_list where idx = ".$board->idx2[$i]);?>
																	<?while ($row = mysql_fetch_array($sql_values)) {?>
	                                  <tr>
	                                    <td width="400" align="center" style='padding:5px;'>
																				<input type='hidden' name="idx1[]" value="<?=$board->idx2[$i]?>">
																				<input class='prd_kitchen_table' type='hidden' name="prd_kitchen_table1[]" value="<?=$row['prd_kitchen_table']?>">
																				<input class='prd_kitchen_idx' type='hidden' name="prd_kitchen_idx1[]" value="<?=$row['prd_kitchen_idx']?>">
																				<input class='prd_kitchen' name="prd_kitchen1[]" style='height:30px; width:300px;' type='text' value='<?=$board->prd_kitchen[$i]?>'  <?if(!$board->prd_kitchen[$i]) echo "readonly";?> >
																				<button class='select_apply' style='height:30px; border:none; background:#ccc;' onclick='return false;'>적용</button>
																			</td>
	                                    <td align="center">
																				<input class='prd_etc_table' type='hidden' name="prd_etc_table1[]" value="<?=$row['prd_etc_table']?>">
																				<input class='prd_etc_idx' type='hidden' name="prd_etc_idx1[]" value="<?=$row['prd_etc_idx']?>">
																				<input class='prd_etc' name="prd_etc1[]" style='height:30px; width:300px;' type='text' value='<?=$board->prd_etc[$i]?>' <?if(!$board->prd_etc[$i]) echo "readonly";?> >
																				<button class='select_apply2' style='height:30px; border:none; background:#ccc;' onclick='return false;'>적용</button>
																			</td>
																			<td align="center"><a href="javascript:delProduct(<?=$board->idx2[$i]?>)">삭제</a></td>
	                                  </tr>
																		<?}?>
								  								<? } ?>

									 								<tr>
                                  	<td width="400" align="center" style='padding:5px;'>
																			<input class='prd_kitchen_table' name='prd_kitchen_table' type='hidden'>
																			<input class='prd_kitchen_idx' name='prd_kitchen_idx' type='hidden'>
																			<input class='prd_kitchen' name='prd_kitchen' style='height:30px; width:300px;' type='text' readonly>
																			<button class='select_apply' style='height:30px; border:none; background:#ccc; line-height: 0px;' onclick='return false;'>적용</button>
																		</td>

																		<td width="400" align="center" style='padding:5px;'>
																			<input class='prd_etc_table' name='prd_etc_table' type='hidden'>
																			<input class='prd_etc_idx' name='prd_etc_idx' type='hidden'>
																			<input class='prd_etc' name='prd_etc' style='height:30px; width:300px;' type='text' readonly>
																			<button class='select_apply2' style='height:30px; border:none; background:#ccc; line-height: 0px;' onclick='return false;'>적용</button>
																		</td>

                                   	<td align="center"><a href="javascript:addProduct(<?=$board->idx[$i]?>)">추가</a></td>
																 	</tr>

                                </table></td>
                                        </tr>
                                        <tr>
                                          <td height="5"></td>
                                        </tr>
                                      </table></td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
						<? } ?>

                          <tr>
                            <td height="20">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center"><table width="123" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><input type="image" src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_confirm.gif" alt="확인" border="0"></a></td>
                                <td width="3">&nbsp;</td>
                                <td><a href="javascript:history.back()"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_cancel.gif" alt="취소" border="0"></a></td>
                              </tr>
                            </table></td>
                          </tr>
                        </form>
                        </table></td>
                      </tr>

                    </table></td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>



                            </td>
                          </tr>
                        </table>
                        </td>
                      </tr>
                      <tr>
                        <td height="30">&nbsp;</td>
                      </tr>
                    </table>

<script type="text/javascript">
$(function(){

	$('.location_search').click(function(){
		$.ajax({
			url: "location.search.ajax.php",
			data: {
							"word":	$('.select_word').val()
						},
			success: function(data){
				$('.select_area').html(data);
			}
		})
	})

	$('.select_apply').click(function(){
		var vals = $('.select_area').children('select').val();

		if(vals.substring(0,5) == 00001){ // gc_board_k_prod01 일때
			$(this).parent().children("input.prd_kitchen_table").val("gc_board_k_prod01");
		}else if(vals.substring(0,5) == 00002){// gc_board_k_prod02 일때
			$(this).parent().children("input.prd_kitchen_table").val("gc_board_k_prod02");
		}else if(vals.substring(0,5) == 00003){// gc_board_k_prod02 일때
			$(this).parent().children("input.prd_kitchen_table").val("gc_board_i_pakage");
		}
		$(this).parent().children("input.prd_kitchen_idx").val(vals.substring(5));

		var th = $(this);

		$('.select_area').children('select').children('optgroup').children('option').each(function(index){
			if(vals == $(this).val()){
				th.parent().children("input.prd_kitchen").val($(this).text());
				th.parent().children("input.prd_kitchen").attr('readonly',false);
			}
		})
	})

	$('.select_apply2').click(function(){
		var vals = $('.select_area').children('select').val();
		if(vals.substring(0,5) == 00001){ // gc_board_k_prod01 일때
			$(this).parent().children("input.prd_etc_table").val("gc_board_k_prod01");
		}else if(vals.substring(0,5) == 00002){// gc_board_k_prod02 일때
			$(this).parent().children("input.prd_etc_table").val("gc_board_k_prod02");
		}else if(vals.substring(0,5) == 00003){// gc_board_k_prod02 일때
			$(this).parent().children("input.prd_etc_table").val("gc_board_i_pakage");
		}
		$(this).parent().children("input.prd_etc_idx").val(vals.substring(5));

		var th = $(this);

		$('.select_area').children('select').children('optgroup').children('option').each(function(index){
			if(vals == $(this).val()){
				th.parent().children("input.prd_etc").val($(this).text());
				th.parent().children("input.prd_etc").attr('readonly',false);
			}
		})

	})


})



function delProduct(idx){
	if(confirm("정말 삭제하시겠습니까?") == true){
		document.location = "location-write.php?action=delProduct" + "&mode=<?=$_REQUEST[mode]?>&code=<?=$_REQUEST[code]?>&del_idx=" + idx + "&idx=<?=$_REQUEST[idx]?>"
	}
}

function modifyProduct(idx){
	if(confirm("수정 하시겠습니까?") == true){
		document.location = "location-write.php?action=modifyProduct" + "&mode=<?=$_REQUEST[mode]?>&code=<?=$_REQUEST[code]?>&del_idx=" + idx + "&idx=<?=$_REQUEST[idx]?>"
	}
}

function addProduct(){
	if(confirm("추가하시겠습니까?") == true){
	var prd_kitchen = $("input.prd_kitchen").last().val();
	var prd_kitchen_table = $("input.prd_kitchen_table").last().val();
	var prd_kitchen_idx = $("input.prd_kitchen_idx").last().val();

	var prd_etc = $("input.prd_etc").last().val();
	var prd_etc_table = $("input.prd_etc_table").last().val();
	var prd_etc_idx = $("input.prd_etc_idx").last().val();



	$.ajax({
		url: "location.add.ajax.php",
		data: {
						"prd_kitchen":	prd_kitchen,
						"prd_kitchen_table":	prd_kitchen_table,
						"prd_kitchen_idx":	prd_kitchen_idx,
						"prd_etc":	prd_etc,
						"prd_etc_table":	prd_etc_table,
						"prd_etc_idx":	prd_etc_idx,
						"mode":	"<?=$_REQUEST[mode]?>",
						"code": "<?=$_REQUEST[code]?>",
						"idx": "<?=$_REQUEST[idx]?>"
					},
		success: function(){
			location.reload();
		}
	})

	//document.location = "location-write.php?prd_etc=" + prd_etc + "&prd_etc_table=" + prd_etc_table +"&prd_etc_idx=" + prd_etc_idx+"&prd_kitchen=" + prd_kitchen + "&prd_kitchen_table=" + prd_kitchen_table +"&prd_kitchen_idx=" + prd_kitchen_idx + "&action=addProduct" + "&mode=<?=$_REQUEST[mode]?>&code=<?=$_REQUEST[code]?>&idx=<?=$_REQUEST[idx]?>"
	}

}
</script>

<?
include $_SERVER["DOCUMENT_ROOT"]."/global/include/admin_footer.php";
?>
