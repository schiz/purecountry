<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arResult["DATA"] = array();
foreach($arResult["ITEMS"] as $k => $arItem){
	$arResult["DATA"][] = array(
		"ID" => $arItem["ID"],
		"NAME" => $arItem["NAME"],
		"SECTION_ID" => $arItem["IBLOCK_SECTION_ID"],
		"IMAGE" => CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"],
			array("width"=>400,"height"=>300),
			BX_RESIZE_IMAGE_EXACT
		),
		"DESCRIPTION" => TruncateText($arItem["~PREVIEW_TEXT"], 120),
		"CTIME" => $arItem["PROPERTIES"]["TIME"]["VALUE"],
	);
}
$arResult["DATA_JSON"] = json_encode($arResult["DATA"]);