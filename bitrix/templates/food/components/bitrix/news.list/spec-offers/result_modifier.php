<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult["ITEMS"] as $k => $arItem){
	$arResult["ITEMS"][$k]["ICON"] = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"],array("width"=>100,"height"=>100),BX_RESIZE_IMAGE_EXACT);
}
?>