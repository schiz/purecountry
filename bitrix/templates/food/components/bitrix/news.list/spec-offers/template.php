<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div class="row">
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
		<div class="<?if($arItem["DISPLAY_PROPERTIES"]["FORMAT"]["VALUE_XML_ID"]=="wide"):?>col-sm-12 wide clearfix"<?else:?>col-sm-4<?endif?>"<?if($USER->IsAdmin()):?> id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?endif?>>
			<div class="spec-offer">
			<a href="/soon/">
<?if(is_array($arItem["ICON"])):?>
				<img src="<?=$arItem["ICON"]["src"]?>" class="so-icon pull-left">
<?endif?>
				<h4><?=$arItem["~NAME"]?></h4>
<?if(is_array($arItem["DISPLAY_PROPERTIES"]["DESCRIPTION"])):?>
				<div class="description"><?=$arItem["DISPLAY_PROPERTIES"]["DESCRIPTION"]["DISPLAY_VALUE"]?></div>
<?endif?>
			</a>
			</div>
		</div>
<?endforeach?>
	</div>
<div class="string">
    <div id="marquee"><?echo COption::GetOptionString("conf","run_string");?></div>
</div>
