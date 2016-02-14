<?
foreach($arResult["ITEMS"] as $k => $arItem):
	$arResult["ITEMS"][$k]["ISODATE"] = ConvertDateTime($arItem["ACTIVE_FROM"],"Y-m-d");
	$arResult["ITEMS"][$k]["ANONS_PIC"] = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>'220', 'height'=>'220'), BX_RESIZE_IMAGE_EXACT, true);
endforeach;
?>