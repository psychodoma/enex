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
                                <td><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_ic_listbox01.gif" width="14" height="14" align="absmiddle">
								<font color="000000" style="font-size:15px"><strong><?= $boardConfig->name ?> - 상세보기</strong></font></td>
                              </tr>
							  
								<tr>
								<td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td>&nbsp;</td>
									<?
									if($boardConfig->comment_yn == "Y") {
									?>
									<td width="40"><a href="write.php?mode=reply&code=<?=$_REQUEST[code]?>&idx=<?=$_REQUEST[idx]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_reply.gif" alt="답변"  border="0"></a></td>
									<td width="3"></td>
									<?}?>
									<?if($location_code == "true"){ ?>
								   <td width="40"><a href="location-write.php?mode=location_update&code=<?=$_REQUEST[code]?>&idx=<?=$_REQUEST[idx]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_edit.gif" alt="수정" border="0"></a></td>
									<?}else{?>
								   <td width="40"><a href="write.php?mode=edit&code=<?=$_REQUEST[code]?>&idx=<?=$_REQUEST[idx]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_edit.gif" alt="수정" border="0"></a></td>
									<? } ?>

									<td width="3"></td>
									<td width="40">

									<a href="javascript:deleteInfo()"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_delete.gif" alt="삭제" border="0"></a>

									</td>

									<td width="3"></td>
									<td width="40"><a href="list.php?mode=list&code=<?=$_REQUEST[code]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_list.gif" alt="목록"  border="0"></a></td>
									<td width="3"></td>
									<?if($location_code == "true"){ ?>
									<td width="70"><a href="location-write.php?code=<?=$_REQUEST[code]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_write.gif" alt="글쓰기"  border="0"></a>
									</td>
									<?}else{?>
									<td width="70"><a href="write.php?mode=write&code=<?=$_REQUEST[code]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_write.gif" alt="글쓰기"  border="0"></a>
									</td>
									<? } ?>
							  </tr>

                              <tr>
                                <td height="20"></td>
                              </tr>

                            
                            </table></td>
                          </tr>

                          <tr>
                            <td height="20">&nbsp;</td>
                          </tr>
                          <tr>
                            <td>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="100%" height="1" colspan="2" bgcolor="#e5e5e5"></td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<? if($location_code == "true") {?>
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
                                      <td><strong><?=$board->brName[0]?></strong> </td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>

						  <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">노출</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="10">&nbsp;</td>
                                      <td><?if($board->brType[0] == '1') { echo '대리점';}else if($board->brType[0] == '2'){echo'쇼룸';}else{echo '기타';}?></td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>                          <tr>
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
                                    <td><?if(isset($board->brZip[0])){ echo '우('.$board->brZip[0].')';}?> <?=$board->brAddress[0]?></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
 </tr>                          <tr>
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
                                    <td><?=$board->brOldAddr[0]?></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
 </tr>                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
                          <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                                    <td><?=$board->brTel[0]?></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
 </tr>                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
						                            <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                                    <td><?=$board->sido[0]?>/<?=$board->gugun[0]?></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
 </tr>                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
                          <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                                    <td><table width="100%" border="1" cellspacing="0" cellpadding="0" >
									 <tr>
                                    <td width="300" align="center">현재 전시 주방제품</td>
                                   <td align="center">&nbsp;현재 전시 붙박이, 인테리어제품</td>
									</tr>
								  <?
                                  for($i=0;$i < $board->rowCnt; $i++) {
                                  ?>
                                  <tr>
                                    <td width="300" align="center">&nbsp;<?=$board->prd_kitchen[$i]?></td>
                                    <td align="center"><?=$board->prd_etc[$i]?></td>
                                  </tr>
								  <? } ?>
                                </table></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
						<? }else{ ?>
                          <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">제목</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="10">&nbsp;</td>
                                      <td><strong><?=$board->title?></strong> </td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
                          <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">작성자</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td><?=$board->write_name?></td>
                                  </tr>
                                </table></td>
                                <td width="140"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="20">&nbsp;</td>
                                    <td><span style="padding-left:19px">등록일</span></td>
                                  </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td width="200"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td><?=str_replace("-", ".", substr($board->regdate,0,10))?></td>
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
                                      <td><span style="padding-left:19px">작성자 ID</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td><?=$board->write_id?></td>
                                  </tr>
                                </table></td>
                                <td width="140"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="20">&nbsp;</td>
                                    <td><span style="padding-left:19px">연락처</span></td>
                                  </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td width="200"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td><?=$row["mobile"];?></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
						                            </tr>                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
						                            <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">주소</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="10">&nbsp;</td>
                                      <td><?=$row["zipcode"]?> &nbsp;<?=$row["address"]?><?=$row["address_sub"]?></td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>

						  <? } ?>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
                          
                        <? if( $board->link1 != "" ) { ?>
                          <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">링크주소</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="10">&nbsp;</td>
                                      <td><?=$board->link1 ?>  </td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
                        <?
                      	}
                        ?>
                          
                        <?
                        if($boardConfig->category_yn == "Y") {
                        ?>  
                          <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">카테고리</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="10">&nbsp;</td>
                                      <td><?=$board->category_name ?>  </td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
                        <?
                      	}
                        ?>
                                                  
                        <?
                        if($boardConfig->board_upload_count > 0) {
                        ?>
                          <tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">첨부파일</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td>
                                        <?
                                        for($i=0; $i < $board->file_cnt;$i++) {
											$file_str = str_replace("/www/enex_home/","",$board->file_path[$i]);
											$file_str = str_replace("/www/enex_kitchen/","",$file_str);
											$img_str = str_replace("/www/enex_home/","",$board->file_path[$i]);
											$img_str = str_replace("/www/enex_kitchen/","",$img_str);
                                        ?>
                                        <a href="/<?=$file_str ?>" target="_new"><?=$board->file_name[$i]?></a>
										<img src="/<?=$img_str?>" width="30px" height="30px">
                                        <?
                                        }
                                        ?>
                                    </td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
                          
                          <?}?>
                          
						<tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="20">
                              <tr>
                                <td class="txt_h_20">
                                    <?=stripslashes($board->content)?>
                                  </td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>
                          <?
                          if($board->prev_idx){
                          ?>
						  						<tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">이전글</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="10">&nbsp;</td>
                                      <td><a href="?mode=<?=$_REQUEST[mode]?>&code=<?=$_REQUEST[code]?>&idx=<?=$board->prev_idx?>"><?=$board->prev_title?></a> </td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr> 
                          <?}?>
                          <?
                          if($board->next_idx){
                          ?>
						  						<tr>
                            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20">&nbsp;</td>
                                      <td><span style="padding-left:19px">다음글</span></td>
                                    </tr>
                                </table></td>
                                <td width="1" valign="bottom"><img src="/images/board_ic_dline.gif" width="1" height="10"></td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="10">&nbsp;</td>
                                      <td><a href="?mode=<?=$_REQUEST[mode]?>&code=<?=$_REQUEST[code]?>&idx=<?=$board->next_idx?>"><?=$board->next_title?></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="1" bgcolor="#e5e5e5"></td>
                          </tr>                                
                          <?}?>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="20" colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>&nbsp;</td>
                            <?
                            if($boardConfig->comment_yn == "Y") {
                            ?>
                            <td width="40"><a href="write.php?mode=reply&code=<?=$_REQUEST[code]?>&idx=<?=$_REQUEST[idx]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_reply.gif" alt="답변"  border="0"></a></td>
                            <td width="3"></td>
                            <?}?>
							<?if($location_code == "true"){ ?>
                           <td width="40"><a href="location-write.php?mode=location_update&code=<?=$_REQUEST[code]?>&idx=<?=$_REQUEST[idx]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_edit.gif" alt="수정" border="0"></a></td>
							<?}else{?>
                           <td width="40"><a href="write.php?mode=edit&code=<?=$_REQUEST[code]?>&idx=<?=$_REQUEST[idx]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_edit.gif" alt="수정" border="0"></a></td>
							<? } ?>

                            <td width="3"></td>
                            <td width="40">

							<a href="javascript:deleteInfo()"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_delete.gif" alt="삭제" border="0"></a>

							</td>
                            <td width="3"></td>
                            <td width="40"><a href="list.php?mode=list&code=<?=$_REQUEST[code]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_list.gif" alt="목록"  border="0"></a></td>
                            <td width="3"></td>
							<?if($location_code == "true"){ ?>
							<td width="70"><a href="location-write.php?code=<?=$_REQUEST[code]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_write.gif" alt="글쓰기"  border="0"></a>
							</td>
							<?}else{?>
                            <td width="70"><a href="write.php?mode=write&code=<?=$_REQUEST[code]?>"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_write.gif" alt="글쓰기"  border="0"></a></td>
							<? } ?>
                          </tr>
                        </table></td>
                      </tr>
                     	<?
                    	// 채용공고 - 지원자목록
                      if( $board->code == "h_recruit" ) {
                      ?>
                      <tr>
                        <td height="20" colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                      	<td colspan="2"><strong> * 지원자 목록 </strong></td>
                      </tr>
                      <tr>
                      	<td colspan="2"><hr /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                          	<th style="size:10pt">번호</th>
                          	<th style="size:10pt">구분</th>
                          	<th style="size:10pt">지원직무</th>
                          	<th style="size:10pt">지원지역</th>
                          	<th style="size:10pt">이름</th>
                          	<th style="size:10pt">이메일</th>
                          	<th style="size:10pt">휴대폰</th>
                          	<th style="size:10pt">상태</th>
                          	<th style="size:10pt">상세보기</th>
													</tr>
                          <tr>
                            <td height="1" colspan="10" bgcolor="e5e5e5"></td>
                          </tr>
                      <?
                      $b_query = "SELECT * FROM gc_incruit_baseinfo WHERE m_idx='{$idx}'";
                      $b_res = mysql_query($b_query);
                      $totalCnt = mysql_num_rows($b_res);
                      while( $b_row = mysql_fetch_array($b_res) ) {
                      ?>
                          <tr height="20">
                          	<td align="center"><?= $totalCnt ?></td>
                          	<td align="center"><?= $b_row["gubun"] ?></td>
                          	<td align="center"><?= $b_row["job"] ?></td>
                          	<td align="center"><?= $b_row["area"] ?></td>
                          	<td align="center"><?= $b_row["name"] ?></td>
                          	<td align="center"><?= $b_row["email"] ?></td>
                          	<td align="center"><?= $b_row["hp"] ?></td>
                          	<td align="center"><?= $b_row["status"] ?></td>
                          	<td align="center">
                          		<a href="javascript:;" onclick="preview('<?= $b_row["idx"] ?>')">[보기]</a>
                          	</td>
													</tr>
                          <tr>
                            <td height="1" colspan="10" bgcolor="e5e5e5"></td>
                          </tr>
											<?
											}
											?>
												</td>
											</tr>
                      <tr>
                        <td height="20" colspan="2">&nbsp;</td>
                      </tr>
											<form name="tf" id="tf" method="post">
											<input type="hidden" name="idx" id="idx" value="">
											<input type="hidden" name="r_idx" id="r_idx" value="<?= $idx ?>">
											</form>
                      <?
                    	}
                      ?>
                    </table>
                    </td>
                </tr>
                </table>
                </td>
            </tr>
            </table>
            </td>
        </tr>
        </table>
                    
                    
                        
                            
                        
            <script language="javascript">
								//미리보기	
								function preview(idx) {
									var viewWin = window.open('','viewWin','width=1024,height=768,scrollbars=yes,toolbars=no,menubars=no');
									$('#tf #idx').val(idx);
									$('#tf').attr('target','viewWin');
									$('#tf').attr('action','http://www.enex.co.kr/recruit/pop_preview.php');
									$('#tf').submit();
								}
                function deleteInfo() {
                    if(confirm('삭제하시겠습니까?')) {
                        location = "proc.php?mode=delete&code=<?=$_REQUEST[code]?>&idx=<?=$_REQUEST[idx]?>&act=delete";
                    }
                }
            </script>