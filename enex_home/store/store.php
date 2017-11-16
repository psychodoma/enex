<?
include_once($_SERVER["DOCUMENT_ROOT"]."/global.inc.php");
include_once($_SERVER["DOCUMENT_ROOT"]._GLOBAL_INC_."/dtd_ehome.php");
?>

<body>
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

	<!-- #naviArea //-->
	<div id="naviArea">
		<?
		include_once($_SERVER["DOCUMENT_ROOT"]."/_inc/navi.php");
		?>
		<div class="subMenuSet">
			<div class="location">
				에넥스홈 > 매장찾기
			</div>
		</div>
	</div>
	<!-- #naviArea //-->

	<!-- #subCon //-->
	<div id="subCon">

		<!-- conBox //-->
		<div class="conBox">

		<? include_once($_SERVER["DOCUMENT_ROOT"]._GLOBAL_INC_."/inc_map.php"); ?>

		</div>
		<!-- conBox //-->

		<!-- goTop //-->
		<div class="goTop">
			<div class="btnTop"><a href="#wrap">TOP</a></div>
		</div>
		<!-- goTop //-->

	</div>
	<!-- #subCon //-->

	<!-- #footer //-->
	<?
	include_once($_SERVER["DOCUMENT_ROOT"]._GLOBAL_INC_."/glo_footer.php");
	?>
	<!-- #footer //-->

</div>
<!-- #wrap //-->

</body>
</html>

