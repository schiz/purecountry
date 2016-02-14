<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->RestartBuffer();
header("Content-Type: application/json; charset=utf-8");
echo $arResult["DATA_JSON"];
die();