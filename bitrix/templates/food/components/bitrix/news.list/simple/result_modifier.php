<?
foreach($arResult["ITEMS"] as $k => $arItem):
	$arResult["ITEMS"][$k]["ISODATE"] = ConvertDateTime($arItem["ACTIVE_FROM"],"Y-m-d");
endforeach;
?>