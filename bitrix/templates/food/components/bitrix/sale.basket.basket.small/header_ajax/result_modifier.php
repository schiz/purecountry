<?
$arResult["TOTAL"] = 0;
$arResult["TOTALPRICE"] = 0;
foreach($arResult["ITEMS"] as $arItem) {
	$arResult["TOTAL"] += $arItem["QUANTITY"];
	$arResult["TOTALPRICE"] += $arItem["PRICE"]*$arItem["QUANTITY"];
}
$arResult["TOTALPRICE_FORMATTED"] = CurrencyFormat($arResult["TOTALPRICE"],$arResult["ITEMS"][0]["CURRENCY"]);
?>