<?
foreach($arResult["ITEMS"] as $k => $arItem) {
	if(stripos($_SERVER["REQUEST_URI"], $arItem["LIST_PAGE_URL"]) === 0) {
		$arResult["ITEMS"][$k]["SELECTED"] = "Y";
	}
}
?>