<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arResult["DATA"] = array();
$i=-1;
foreach($arResult["ITEMS"] as $arItem){
    if($key%14==0 || $key%14==5 || $key%14==9) $i++;
	if(intval($arItem["~IBLOCK_SECTION_ID"])>0){
		$arResult["DATA"][$i][] = array(
			"ID" => $arItem["ID"],
			"NAME" => $arItem["NAME"],
			"SECTION_ID" => $arItem["~IBLOCK_SECTION_ID"],
			"LINK" => $arItem["DETAIL_PAGE_URL"],
			"IMAGE" => CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"],array("width"=>380,"height"=>200)),
			"PRICE" => $arItem["CATALOG_PRICE_1"],
			"PROMO" => $arItem["PROPERTIES"]["PROMO"]["VALUE"],
		);
	}
}

$arResult["DATA_JSON"] = json_encode($arResult["DATA"]);