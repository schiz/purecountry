<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="row">
	<div class="col-xs-12">
		<div class="map" id="farm-map"></div>
	</div>
</div>
<div class="row">
<?foreach($arResult["ITEMS"] as $k => $arItem):?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<?if($k>0&&$k%3==0):?><div class="clearfix visible-md visible-lg"></div><?endif?>
<?if($k>0&&$k%2==0):?><div class="clearfix visible-sm"></div><?endif?>
	<div class="col-sm-6 col-md-4 farm-info"<?if($USER->IsAdmin()):?> id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?endif?>>
		<div class="media">
<?if(is_array($arItem["ICON"])):?>
			<div class="pull-left icon text-center"><img class="media-object pull-left" src="<?=$arItem["ICON"]["src"]?>"></div>
<?else:?>
			<div class="media-object pull-left no-icon"></div>
<?endif?>
			<div class="media-body">
				<h4 class="media-heading"><?=$arItem["NAME"]?></h4>
<?if($arItem["DISPLAY_PROPERTIES"]["PLACE"]["DISPLAY_VALUE"]):?>
				<p><?=$arItem["DISPLAY_PROPERTIES"]["PLACE"]["DISPLAY_VALUE"]?></p>
<?endif?>
			</div>
		</div>
	</div>
<?endforeach?>
</div>
<script type="json/data" id="map-data">(<?=$arResult["DATA_JSON"]?>)</script>