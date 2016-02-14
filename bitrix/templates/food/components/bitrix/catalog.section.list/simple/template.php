<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<ul class="catalog-section-list">
<?
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
?>
<?if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"]):?>
	<?=str_repeat("		", $CURRENT_DEPTH - $arResult["SECTION"]["DEPTH_LEVEL"])?><ul>
<?elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"]):?>
	<?=str_repeat("		", $CURRENT_DEPTH - $arResult["SECTION"]["DEPTH_LEVEL"]-1)?>
<?echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);?>

<?endif;
$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
<?=str_repeat("		", $CURRENT_DEPTH - $arResult["SECTION"]["DEPTH_LEVEL"])?><li<?if($arSection["SELECTED"]=="Y"):?> class="selected"<?endif?><?if(is_array($arSection['EDIT_LINK']) && is_array($arSection['DELETE_LINK'])):?> id="<?=$this->GetEditAreaId($arSection['ID'])?>"<?endif?>><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif?>

<?endforeach?>
<?if($CURRENT_DEPTH - $arResult["SECTION"]["DEPTH_LEVEL"]-1>0):?>
	<?=str_repeat("		", $CURRENT_DEPTH - $arResult["SECTION"]["DEPTH_LEVEL"]-1)?>
<?=str_repeat("</ul>", $CURRENT_DEPTH - $arResult["SECTION"]["DEPTH_LEVEL"]-1)?>
<?endif?>
	</ul>
