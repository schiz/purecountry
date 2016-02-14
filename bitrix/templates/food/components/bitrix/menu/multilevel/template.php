<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<nav class="multilevelmenu">
		<ul>
<?foreach($arResult as $arItem):?>
<?if($arItem["SUBMENU"]=="OPEN"):?>
			<ul>
<?endif?>
<?if($arItem["SUBMENU"]=="CLOSE"):?>
			</ul>
<?endif?>
			<li<?if(!empty($arItem["CLASS"])):?> class="<?=$arItem["CLASS"]?>"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
<?endforeach?>
<?if($arResult[0]["LAST_DEPTH_LEVEL"]> 0):?>
			<?=str_repeat("</ul>",$arResult[0]["LAST_DEPTH_LEVEL"])?>
<?endif?>
		</ul>
	</nav>
<?endif?>