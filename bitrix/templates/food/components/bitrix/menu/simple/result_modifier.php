<?
foreach($arResult as $k => $arItem) {
	if ($arItem["PERMISSION"] <= "D") {
		unset($arResult[$k]);
	}
}
?>