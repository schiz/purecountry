<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<nav class="mainmenu">
<?foreach($arResult as $arItem):?>
		<a href="<?=$arItem["LINK"]?>"<?if($arItem["SELECTED"] == 1):?> class="selected"<?endif?>><?=$arItem["TEXT"]?></a>
<?endforeach?>
	</nav>
<?endif?>