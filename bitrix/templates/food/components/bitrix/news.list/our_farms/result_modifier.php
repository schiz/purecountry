<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arResult["DATA"] = array();
foreach($arResult["ITEMS"] as $k => $arItem){
	$arIcon = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"],array("width"=>50,"height"=>50),BX_RESIZE_IMAGE_EXACT);
	$arResult["ITEMS"][$k]["ICON"] = $arIcon;
	$arResult["DATA"][] = array(
		"NAME" => $arItem["NAME"],
		"ICON" => $arIcon,
		"PLACE" => $arItem["DISPLAY_PROPERTIES"]["PLACE"]["DISPLAY_VALUE"],
		"COORDS" => explode(",", $arItem["DISPLAY_PROPERTIES"]["YAMAP"]["VALUE"])
	);
}
$arResult["DATA_JSON"] = json_encode($arResult["DATA"]);
?>