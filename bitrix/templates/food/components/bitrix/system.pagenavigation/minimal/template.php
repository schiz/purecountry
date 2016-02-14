<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

//echo "<pre>"; print_r($arResult);echo "</pre>\n";

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

?>
		<nav class="pager">
			<h6><?=$arResult["NavTitle"]?></h6>
<?if($arResult["bDescPageNumbering"] === true):?>
			<ul class="pages">
<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>
<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
				<li class="current"><?=$NavRecordGroupPrint?><li>
<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
				<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a></li>
<?else:?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a></li>
<?endif?>
<?$arResult["nStartPage"]--?>
<?endwhile?>
<?else:?>
			<ul class="pages">
<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
				<li class="current"><?=$arResult["nStartPage"]?></li>
<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
				<li class="current"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
<?else:?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
<?endif?>
<?$arResult["nStartPage"]++?>
<?endwhile?>
<?endif?>
<?if ($arResult["bShowAll"]):?>
<?if ($arResult["NavShowAll"]):?>
				<li class="all"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a></li>
<?else:?>
				<li class="all"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a></li>
<?endif?>
<?endif?>
			</ul>
		</nav>
