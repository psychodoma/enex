<?
include $_SERVER["DOCUMENT_ROOT"]."/global.inc.php";

extract($_POST);
if($_COOKIE["ADMINUSERID"] == "") {
    utilClass::redirectPage("/");
    exit;
}

$adminInfo = array("member" => "회원관리",
                   "base"   => "기본관리",
                   "board"  => "게시판관리",
                   "admin"   => "예약관리",
                   "base" => "기본관리");
/*
$baseConfig = new baseConfigClass();
$baseConfig->nowPage= $baseConfig->startPage          = $_REQUEST['nowPage']?$_REQUEST['nowPage']:1;
if($_REQUEST[key]) 
    $baseConfig->key = $_REQUEST[key];
if($_REQUEST[word]) 
    $baseConfig->word = $_REQUEST[word];
if($_REQUEST[sdate]) 
    $baseConfig->sdate = $_REQUEST[sdate];
if($_REQUEST[edate]) 
    $baseConfig->edate = $_REQUEST[edate];
    
$baseConfig->searchId = $_COOKIE['ADMINUSERID'];
$baseConfig->getBaseConfigInfo();*/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?= $gcBoardPathWeb ?>/admin/css/admin.css" rel="stylesheet" type="text/css">
<link href="<?= $gcBoardPathWeb ?>/admin/css/jquery-ui-1.8.11.custom.css" rel="stylesheet" type="text/css">

<style type="text/css"> 
.tmenu {height:28px;width:109px;color:#000;}
.tmenu a{color:#000}
.tmenu div{color:#000;padding:0px 0px 0px 28px}
.tmenu div a{color:#000}
.tmenu div a:hover{color:#000;font-weight:bold}
.tmenu div a:visited{color:#000;}
.tmenuOver {height:28px;width:109px;color:#000}
.tmenuOver a{color:#000}
.tmenuOver div{color:#000;padding:0px 0px 0px 28px;}
.tmenuOver div a{color:#000;font-weight:bold}
.tmenuOver div a:visited{color:#000;font-weight:bold}
.tmenuOver div a:hover{color:#000;font-weight:bold}
h1,h2,h3,h4,h5,h6 {margin: 0;padding: 0;border: 0;outline: 0;font-size: 100% ;vertical-align: baseline;background: transparent;}
h1{font-size:60px;letter-spacing:-4px;text-transform:uppercase;font-weight:bold;line-height:.9;}
h2{font-size:32px;text-transform:uppercase;line-height:.9;letter-spacing:-2px;font-weight:bold;}
h3{font-size:16px;text-transform:uppercase;;letter-spacing:-2px;font-weight:bold;}
h1,h2,h3{font-family:Arial,Sans-Serif;}
h4,h5,h6{font-family:Georgia,serif;font-size:11px;font-weight:normal;}
.leftMenuTop h3 {margin-left:20px; color:#000}
</style>
<title>ADMIN - 관리자 모드</title>


<script type="text/javascript" src="<?= $gcBoardPathWeb ?>/js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="<?= $gcBoardPathWeb ?>/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?= $gcBoardPathWeb ?>/js/common.func.js"></script>
<script type="text/javascript" src="<?= $gcBoardPathWeb ?>/js/jquery.filestyle.js"></script>
<!-- <script>document.domain="enex.co.kr";</script> -->
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="87"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="87" background="<?= $gcBoardPathWeb ?>/admin/images/ad_top_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="188" height="87" style="padding-left: 45px;">
                <img src="http://image.enex.co.kr/images/home/common/logo.gif" style="width:100px;height:31px" alt="로고(188 X 87)" >
            </td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="36" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="2" background="<?= $gcBoardPathWeb ?>/admin/images/ad_top_barline.gif"></td>
                    <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="10">&nbsp;</td>
                        <td><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_ic_admin.gif" width="7" height="7"> <font color="c32a1c" style="font-size:11px"><strong><?=$_COOKIE["ADMINUSERNAME"]?></strong></font> <font style="font-size:11px">님으로 관리자에 접속하셨습니다.</font> <a href="<?= $gcBoardPathWeb ?>/lib/process/logoutAdminProc.php"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_btn_logout.gif" width="54" height="15" border="0" align="absmiddle"></a></td>
                        <td width="79"><a href="/" target="_blank" onFocus="this.blur()"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_top_mb_site.gif" width="79" height="10" border="0"></a></td>
                        <td width="10">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="28"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="109" class="tmenu<?=$fileInfo[3]=="base"?"Over":"";?>" style="height:100%;">
                        <div><a href="../base/menu_config.php" onFocus="this.blur()">기본관리</a></div>
                    </td>
                    <td width="109" class="tmenu<?=$fileInfo[3]=="board"?"Over":"";?>">
                        <div><a href="../board/board_list.php">게시판관리</a></div>
                    </td>
                    <td width="109" class="tmenu<?=$fileInfo[3]=="member"?"Over":"";?>">
                        <div><a href="../member/member_list.php" onFocus="this.blur()">회원관리</a></div>
                    </td>
					
                    <td style="float:right;"><div style="color:red;font-weight:bold;width:100%;text-algin:right;float:right;margin-top:-10px;margin-right:5px;" class="fix_btn">
						<a href="/global/admin/board/fixed.php"><img src="/global/include/btn.png"></a></div>
					</td>
					<td></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="23"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_ic_arrow01.gif" width="2" height="5"> 
					<font style="font-size:11px">HOME &gt; <?=$adminInfo[$fileInfo[3]]?></font></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="494a4b"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="5"></td>
      </tr>
      <tr>
        <td valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="5">&nbsp;</td>
            <td width="180" valign="top">
            <?include $_SERVER["DOCUMENT_ROOT"].$gcBoardPathWeb."/include/admin_left.php";?>
            </td>
            <td width="3"></td>
            <td valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5" height="5" background="<?= $gcBoardPathWeb ?>/admin/images/ad_ctnbox_bg01.gif"></td>
                    <td bgcolor="#FFFFFF"><img src="<?= $gcBoardPathWeb ?>/admin/images/ad_ctnbox_bg.gif" width="1" height="5"></td>
                    <td width="5" height="5" background="<?= $gcBoardPathWeb ?>/admin/images/ad_ctnbox_bg02.gif"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" bgcolor="#FFFFFF"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="20">&nbsp;</td>
                    <td valign="top">