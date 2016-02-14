<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div class="reason_list clearfix">
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
		<article class="pull-left"<?if($USER->IsAdmin()):?> id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?endif?>>
<?if($arItem["ANONS_PIC"]):?>
	<img class="img-circle" src="<?=$arItem["ANONS_PIC"]["src"]?>">

<?endif?>
		
		
		
		
		
		
<?if($arItem["NAME"]):?>
	<div class="reason text-center"><?=$arItem["NAME"]?></div>
<?endif?>





		</article>
<?endforeach;?>
	</div>
