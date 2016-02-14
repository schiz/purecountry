<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arResult["DATA"] = array(
	"SECTIONS" => array(),
	"ARTICLES" => array()
);
if(CModule::IncludeModule("iblock")){
	$rsSections = CIBlockSection::GetList(
		array("SORT"=>"ASC"),
		array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y")
	);
	while($arSection = $rsSections->GetNext()){
		$arResult["DATA"]["SECTIONS"][$arSection["ID"]] = array(
			"ID" => $arSection["ID"],
			"CODE" => $arSection["CODE"],
			"NAME" => $arSection["NAME"],
			"LINK" => $arSection["SECTION_PAGE_URL"]
		);
	}
}
foreach($arResult["ITEMS"] as $k => $arItem){
	$previewPicture = CFile::ResizeImageGet(
		$arItem["PREVIEW_PICTURE"],
		array("width"=>$arParams["PREVIEW_PICTURE_MAX_WIDTH"],"height"=>$arParams["PREVIEW_PICTURE_MAX_HEIGHT"]),
		BX_RESIZE_IMAGE_EXACT
	);
	$detailPicture = CFile::ResizeImageGet(
		$arItem["DETAIL_PICTURE"],
		array("width"=>$arParams["DETAIL_PICTURE_MAX_WIDTH"],"height"=>$arParams["DETAIL_PICTURE_MAX_HEIGHT"]),
		BX_RESIZE_IMAGE_EXACT
	);
    $obParser = new CTextParser;
	$arResult["DATA"]["ARTICLES"][] = array(
		"ID" => $arItem["ID"],
		"NAME" => $arItem["NAME"],
		"SECTION_ID" => $arItem["IBLOCK_SECTION_ID"],
		"PREVIEW_PICTURE" => $previewPicture,
        "PREVIEW_TEXT" => $obParser->html_cut($arItem["PREVIEW_TEXT"], 120),
		"PREVIEW_TEXT_FULL" => $arItem["PREVIEW_TEXT"],
		"DETAIL_PICTURE" => $detailPicture,
		"DETAIL_TEXT" => $arItem["DETAIL_TEXT"],
		"DETAIL_PAGE_URL" => $arItem["DETAIL_PAGE_URL"]
	);
}
$arResult["DATA_JSON"] = json_encode($arResult["DATA"]);
?>