<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?
foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as $photo){
	$rPhoto = CFile::ResizeImageGet($photo,array("width"=>570,"height"=>1000));
	$arPhoto[] = $rPhoto["src"];
}
if(CModule::IncludeModule("iblock")){
foreach($arResult["PROPERTIES"]["PRODUCTS"]["VALUE"] as $p){
	$arProduct = CIBlockElement::GetByID($p)->GetNext();
	$productImage = CFile::ResizeImageGet($arProduct["PREVIEW_PICTURE"],array("width"=>400,"height"=>180));
	$productSection = CIBlockSection::GetByID($arProduct["IBLOCK_SECTION_ID"])->GetNext();
	$products[] = array(
		"ID" => $arProduct["ID"],
		"NAME" => $arProduct["NAME"],
		"IMAGE" => $productImage["src"],
		"SECTION" => array(
			"NAME" => $productSection["NAME"],
			"CODE" => $productSection["CODE"],
		),
		"LINK" => $arProduct["DETAIL_PAGE_URL"]
	);
}
}
foreach($arResult["PROPERTIES"]["INSTRUCTION"]["VALUE"] as $ht){
	$instruction[] = $ht["TEXT"];
}
foreach($arResult["PROPERTIES"]["INGREDIENTS"]["VALUE"] as $ht){
	if(!empty($ht["NAME"])){
		$ingredients[] = $ht;
	}
}
$arResult["DATA"] = array(
	"ID" => $arResult["ID"],
	"SECTION_ID" => $arResult["IBLOCK_SECTION_ID"],
	"NAME" => $arResult["NAME"],
	"IMAGE" => $arPhoto,
	"METHOD" => array("NAME" => $arResult["PROPERTIES"]["METHOD"]["VALUE"], "CODE" => $arResult["PROPERTIES"]["METHOD"]["VALUE_XML_ID"]),
	"TIME" => $arResult["PROPERTIES"]["TIME"]["VALUE"],
    "QUANTITY" => $arResult["PROPERTIES"]["QUANTITY"]["VALUE"],
	"KOEF" => $arResult["PROPERTIES"]["KOEF"]["VALUE"],
	"PRODUCTS" => $products,
	"INGREDIENTS" => $ingredients,
	"INSTRUCTION" => $instruction,
);
$arResult["DATA_JSON"] = json_encode($arResult["DATA"]);