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
			<span class="elements"><?=$arResult["NavFirstRecordShow"]?> - <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?></span>
			<ul class="pages">
<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
<?if($arResult["bSavePage"]):?>
				<li class="begin"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_begin")?></a></li>
				<li class="prev"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_prev")?></a></li>
<?else:?>
				<li class="begin"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a></li>
<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
				<li class="prev"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_prev")?></a></li>
<?else:?>
				<li class="prev"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_prev")?></a></li>
<?endif?>
<?endif?>
<?else:?>
				<li class="begin"><?=GetMessage("nav_begin")?></li>
				<li class="prev"><?=GetMessage("nav_prev")?></li>
<?endif?>
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
<?if ($arResult["NavPageNomer"] > 1):?>
				<li class="next"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_next")?></a></li>
				<li class="end"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_end")?></a></li>
<?else:?>
				<li class="next"><?=GetMessage("nav_next")?></li>
				<li class="end"><?=GetMessage("nav_end")?></li>
<?endif?>
<?else:?>
			<span class="elements"><?=$arResult["NavFirstRecordShow"]?> — <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?></span>
			<ul class="pages">
<?if ($arResult["NavPageNomer"] > 1):?>
<?if($arResult["bSavePage"]):?>
				<li class="begin"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_begin")?></a></li>
				<li class="prev"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a></li>
<?else:?>
				<li class="begin"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a></li>
<?if ($arResult["NavPageNomer"] > 2):?>
				<li class="prev"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a></li>
<?else:?>
				<li class="prev"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_prev")?></a></li>
<?endif?>
<?endif?>
<?else:?>
				<li class="begin"><?=GetMessage("nav_begin")?></li>
				<li class="prev"><?=GetMessage("nav_prev")?></li>
<?endif?>
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
<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
				<li class="next"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_next")?></a></li>
				<li class="end"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_end")?></a></li>
<?else:?>
				<li class="next"><?=GetMessage("nav_next")?></li>
				<li class="end"><?=GetMessage("nav_end")?></li>
<?endif?>
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
