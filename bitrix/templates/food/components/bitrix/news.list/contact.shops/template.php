<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><div class="contact">
<div class="row text-center cm_info">
	<div class="col-sm-4"> 		
		<h5>диспетчер</h5>
		<p class="c_info phone"><?=$arParams["DISPATCHER_PHONE"]?></p>
	</div>
	<div class="col-sm-4"> 		
		<h5>интернет-магазин</h5>
		<p class="c_info phone"><?=$arParams["ESHOP_PHONE"]?></p>
	</div>
	<div class="col-sm-4"> 		
		<h5>Email</h5>
		<p class="c_info"><a href="mailto:info@pure-country.ru">info@pure-country.ru</a></p>
	</div>
</div>
<div class="row central-office">
	<div class="col-sm-8">
		<div class="contact-block" id="central-office-map"></div>
	</div>
	<div class="col-sm-4">
		<div class="contact-block office-info text-center"> 			
			<h4><?=$arResult["CENTRAL_OFFICE"]["NAME"]?></h4>
			<?if($arResult["CENTRAL_OFFICE"]["SUBHEADER"]):?>
				<p><?=$arResult["CENTRAL_OFFICE"]["SUBHEADER"]?></p>
			<?endif?>
			<?if($arResult["CENTRAL_OFFICE"]["ADDRESS"]):?>
				<p class="office-address"><?=$arResult["CENTRAL_OFFICE"]["ADDRESS"]?></p>
			<?endif?>
			<?if($arResult["CENTRAL_OFFICE"]["PHONE"]):?>
				<p class="office-phone"><?=$arResult["CENTRAL_OFFICE"]["PHONE"]?></p>
			<?endif?>
			
			<h4>Производство</h4>
            <p class="office-address">Москва, ул. Маршала Захарова 6А</p>                      
			<h4>Распределительный центр</h4>
            <p class="office-address">Москва, ул. Годовикова 9</p>

		</div>
	</div>
</div>

<!--
<h3 class="text-center">Точки продаж</h3>
<div class="row">
	<div class="col-xs-12">
		<div class="contact-block shops-map" id="shops-map"></div>
	</div>
</div>

<div class="row shop-list">
<?$c=0;
foreach($arResult["ITEMS"] as $arItem):?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<?if($c>0&&$c%3==0):?><div class="clearfix visible-md visible-lg"></div><?endif?>
<?if($c>0&&$c%2==0):?><div class="clearfix visible-sm"></div><?endif?>

<div class="col-md-4 col-sm-6 shop-info"<?if($USER->IsAdmin()):?> id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?endif?>>
	<hgroup>
		<h4><?=$arItem["NAME"]?></h4>
<?if(is_array($arItem["DISPLAY_PROPERTIES"]["SUBHEADER"])):?>
		<p class="subheader"><?=$arItem["DISPLAY_PROPERTIES"]["SUBHEADER"]["DISPLAY_VALUE"]?></p>
<?endif?>
	</hgroup>
<?if(is_array($arItem["DISPLAY_PROPERTIES"]["ADDRESS"])):?>
	<p><?=$arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]?></p>
<?endif?>
<?if(is_array($arItem["DISPLAY_PROPERTIES"]["PHONE"])):?>
	<p><?=$arItem["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"]?></p>
<?endif?>
</div>
<?$c++;endforeach?>
</div>
--!>
<script type="json/data" id="map-data">(<?=$arResult["DATA_JSON"]?>)</script>
</div>