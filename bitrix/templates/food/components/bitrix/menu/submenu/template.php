<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<nav class="submenu">
<?foreach($arResult as $arItem):?>
		<a href="<?=$arItem["LINK"]?>"<?if($arItem["SELECTED"] == 1):?> class="active"<?endif?>><?=$arItem["TEXT"]?></a>
<?endforeach?>
	</nav>
<?endif?>