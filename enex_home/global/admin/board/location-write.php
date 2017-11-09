<?
include $_SERVER["DOCUMENT_ROOT"]."/global/include/admin_header.php";
$boardConfig = new boardConfigClass();
$location_code = "false";

if($_REQUEST[action] == "addProduct")
{
	global $gDBInfo;
	$db = new dbClass();
	$db->openDB($gDBInfo);
	$sql = "insert into gc_branch_prd_list (br_idx, prd_kitchen, prd_etc) values(" .$_REQUEST[idx] . ", '" . $_REQUEST[prd_kitchen] . "', '" . $_REQUEST[prd_etc]  . "')";

	$db->queryDB($sql);
}else if($_REQUEST[action] == "delProduct"){
	global $gDBInfo;
	$db = new dbClass();
	$db->openDB($gDBInfo);
	$sql = "delete from gc_branch_prd_list where idx = " . $_REQUEST[del_idx];
	$db->queryDB($sql);
	echo "<script text='javascript/text'>document.location='location-write.php?mode=" . $_REQUEST[mode]. "&code=" . $_REQUEST[code] . "&idx=". $_REQUEST[idx]. "'</script>";
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
										  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td><table width="100%" border="1" cellspacing="0" cellpadding="0" >
									 <tr>
                                    <td width="300" align="center">현재 전시 주방제품</td>
                                   <td align="center">&nbsp;현재 전시 붙박이, 인테리어제품</td>
                                   <td align="center">&nbsp;줄 삭제/추가</td>
									</tr>
								  <?
                                  for($i=0;$i < $board->rowCnt; $i++) {
                                  ?>
                                  <tr>
                                    <td width="300" align="center">&nbsp;<?=$board->prd_kitchen[$i]?></td>
                                    <td align="center"><?=$board->prd_etc[$i]?></td>
									<td align="center"><a href="javascript:delProduct(<?=$board->idx2[$i]?>)">삭제</a></td>
                                  </tr>
								  <? } ?>
									 <tr>
                                    <td width="300" align="center"><input type="text" id="prd_kitchen" name="prd_kitchen"></td>
                                   <td align="center">&nbsp;<input type="text" id="prd_etc" name="prd_etc">  </td>
                                   <td align="center">&nbsp;<a href="javascript:addProduct(<?=$board->idx[$i]?>)">추가</a></td>
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
function delProduct(idx){
	if(confirm("정말 삭제하시겠습니까?") == true){
		document.location = "location-write.php?action=delProduct" + "&mode=<?=$_REQUEST[mode]?>&code=<?=$_REQUEST[code]?>&del_idx=" + idx + "&idx=<?=$_REQUEST[idx]?>"
	}
}
function addProduct(){
	if(confirm("추가하시겠습니까?") == true){
	var prd_kitchen = $("#prd_kitchen").val();
	var prd_etc = $("#prd_etc").val();
	document.location = "location-write.php?prd_kitchen=" + prd_kitchen + "&prd_etc=" + prd_etc + "&action=addProduct" + "&mode=<?=$_REQUEST[mode]?>&code=<?=$_REQUEST[code]?>&idx=<?=$_REQUEST[idx]?>"
	}

}
</script>

<?
include $_SERVER["DOCUMENT_ROOT"]."/global/include/admin_footer.php";
?>
