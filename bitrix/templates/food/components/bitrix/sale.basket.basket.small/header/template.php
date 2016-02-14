<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="headerbasket">
	<h3><?=GetMessage("TSBS_READY")?></h3>
<?if ($arResult["READY"]=="Y" || $arResult["DELAY"]=="Y" || $arResult["NOTAVAIL"]=="Y"):?>
	<div class="basketfull" id="cart_data">
		<p class="total"><?=GetMessage("TSBS_TOTAL")?><span class="number"><?=$arResult["TOTAL"]?></span></p>
		<p class="pricetotal"><?=GetMessage("TSBS_PRICETOTAL")?><span class="number"><?=$arResult["TOTALPRICE_FORMATTED"]?></span></p>
	</div>
<?else:?>
	<div class="basketempty" id="cart_data">
		<p><?=GetMessage("TSBS_EMPTY")?></p>
	</div>
<?endif?>
		<p class="links">
<?if (strlen($arParams["PATH_TO_BASKET"])>0):?>
			<span><?=GetMessage("TSBS_2BASKET")?> <a href="<?=$arParams["PATH_TO_BASKET"]?>"><?=GetMessage("TSBS_2BASKET_LINK")?></a></span><?endif?><?if (strlen($arParams["PATH_TO_ORDER"])>0):?><span><?=GetMessage("TSBS_2FREEFORMORDER")?> <a href="/freeformorder/"><?=GetMessage("TSBS_2FREEFORMORDER_LINK")?></a></span>
<?endif?>
		</p>
</div>
