<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["FILE"] <> '') {
	echo(strip_tags(file_get_contents($arResult["FILE"])));
}
?>
