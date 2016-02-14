<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0):?>
	<ul class="catalog-main">
<?foreach($arResult["ITEMS"] as $arItem):?>
		<li<?if($arItem["SELECTED"]=="Y"):?> class="selected"<?endif?>><a href="<?=$arItem["LIST_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></li>
<?endforeach?>
	</ul>
<?endif?>
