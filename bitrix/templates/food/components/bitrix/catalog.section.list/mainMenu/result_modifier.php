<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$arResult["DATA"] = array();
foreach($arResult["SECTIONS"] as $arSection){
	if($arSection["GLOBAL_ACTIVE"]){
		$arResult["DATA"][] = array(
			"ID" => $arSection["ID"],
			"CODE" => $arSection["CODE"],
			"SECTION_ID" => intval($arSection["IBLOCK_SECTION_ID"]),
			"NAME" => $arSection["NAME"],
			"ORDER" => $arSection["LEFT_MARGIN"],
			"LINK" => $arSection["SECTION_PAGE_URL"]
		);
	}
}
$arResult["DATA_JSON"] = json_encode($arResult["DATA"]);