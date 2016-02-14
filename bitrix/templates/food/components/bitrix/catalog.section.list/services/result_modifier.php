<?
if(!function_exists("findSelectedUp")) {
	function findSelectedUp(&$array, $id) {
		foreach($array as $k => $arSection) {
			if($arSection["ID"] == $id) {
				$array[$k]["SELECTED"] = "Y";
				findSelectedUp($array,$arSection["IBLOCK_SECTION_ID"]);
			}
		}
	}
}



foreach($arResult["SECTIONS"] as $k => $arSection) {
	if(stripos($_SERVER["REQUEST_URI"], $arSection["SECTION_PAGE_URL"]) === 0) {
		$arResult["SECTIONS"][$k]["SELECTED"] = "Y";
		findSelectedUp($arResult["SECTIONS"],$arSection["IBLOCK_SECTION_ID"]);
	}
	if(strlen(trim($arSection["UF_SHORTNAME"]))>0) {
		$arResult["SECTIONS"][$k]["NAME"] = $arSection["UF_SHORTNAME"];
	}
}
?>