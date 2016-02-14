<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!CModule::IncludeModule("iblock")){ die("Инфоблоки тут нужны"); }
$arResult["DATA"] = array();
foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arItem){
	$image = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array("width"=>110,"height"=>90));
	$arProduct = CIBlockElement::GetByID($arItem["PRODUCT_ID"])->GetNext();
	$arSection = CIBlockSection::GetByID($arProduct["IBLOCK_SECTION_ID"])->GetNext();
	$arResult["DATA"][] = array(
		"ID" => $arItem["ID"],
		"PRODUCT_ID" => $arItem["PRODUCT_ID"],
		"IMAGE" => $image["src"],
		"NAME" => $arItem["NAME"],
		"SECTION" => $arSection["NAME"],
		"QUANTITY" => $arItem["QUANTITY"],
		"PRICE" => $arItem["PRICE"],
		"DETAIL_PAGE_URL" => $arItem["DETAIL_PAGE_URL"]
	);
}
$arResult["DATA_JSON"] = json_encode($arResult["DATA"]);