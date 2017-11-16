<?
include_once($_SERVER["DOCUMENT_ROOT"]."/global.inc.php");
include_once($_SERVER["DOCUMENT_ROOT"]._GLOBAL_INC_."/dtd_kitchen.php");
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

	<!-- location //-->
	<div class="location_s">
		매장안내 > 매장안내
	</div>
	<!-- location //-->

	<!-- #subCon //-->
	<div id="subCon">

		<!-- tabMenu //-->
		<div class="tabMenu">
			<ul>
				<li class="on"><a href="<?= $gEnexKitchenUrl ?>/store/store.php?sido=서울특별시"">매장안내</a></li>
				<li class=""><a href="/store/chain_info.php">대리점 개설안내</a></li>
			</ul>
		</div>
		<!-- tabMenu //-->
		
		<!-- conBox //-->
		<div class="conBox">

		<? include_once($_SERVER["DOCUMENT_ROOT"]._GLOBAL_INC_."/inc_map.php"); ?>

		</div>
		<!-- conBox //-->

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