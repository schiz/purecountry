<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arData = array();
foreach($arResult["ITEMS"] as $k => $arItem){
	if($arItem["DISPLAY_PROPERTIES"]["CENTRAL"]["VALUE"]==1){
		$arResult["CENTRAL_OFFICE"] = array(
			"NAME" => $arItem["NAME"],
			"SUBHEADER" => $arItem["DISPLAY_PROPERTIES"]["SUBHEADER"]["VALUE"],
			"ADDRESS" => $arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"],
			"PHONE" => $arItem["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"],
			"COORDS" => explode(',', $arItem["DISPLAY_PROPERTIES"]["GMAP"]["VALUE"])
		);
		unset($arResult["ITEMS"][$k]);
	}else{
		$arShop = array(
			"NAME" => $arItem["NAME"],
			"SUBHEADER" => $arItem["DISPLAY_PROPERTIES"]["SUBHEADER"]["VALUE"],
			"ADDRESS" => $arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"],
			"PHONE" => $arItem["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"],
			"COORDS" => explode(',', $arItem["DISPLAY_PROPERTIES"]["GMAP"]["VALUE"])
		);
		$arData[] = $arShop;
	}
}
$arResult["DATA"] = array(
	"CENTRAL_OFFICE" => $arResult["CENTRAL_OFFICE"],
	"SHOPS" => $arData
);
$arResult["DATA_JSON"] = json_encode($arResult["DATA"]);
?>