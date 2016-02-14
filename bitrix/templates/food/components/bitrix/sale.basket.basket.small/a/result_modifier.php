<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(CModule::IncludeModule("currency")){
$totalSum = 0;
foreach($arResult["ITEMS"] as $arItem){
	$totalSum += $arItem["PRICE"]*$arItem["QUANTITY"];
}
$arResult["TOTAL"] = CCurrencyLang::CurrencyFormat($totalSum, "RUB");
}