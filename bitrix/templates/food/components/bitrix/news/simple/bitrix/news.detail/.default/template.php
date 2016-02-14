<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div class="news-detail">
<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h1><?=$arResult["NAME"]?></h1>
<?endif?>
<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<figure class="detail_picture">
			<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" />
		</figure>
<?endif?>
<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<time datetime="<?=$arResult["ISODATE"]?>"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></time>
<?endif?>
<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<article><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"])?></article>
<?endif?>
<?if($arResult["NAV_RESULT"]):?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
<?=$arResult["NAV_STRING"]?>
<?endif?>
		<article><?=$arResult["NAV_TEXT"]?></article>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<?=$arResult["NAV_STRING"]?>
<?endif?>
<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<article>
<?=$arResult["DETAIL_TEXT"]?>

		</article>
<?else:?>
		<article><?=$arResult["PREVIEW_TEXT"]?></article>
<?endif?>
<?if(count($arResult["FIELDS"])>0):?>
		<dl class="fields">
<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<dt><?=GetMessage("IBLOCK_FIELD_".$code)?>:</dt><dd><?=$value?></dd>
<?endforeach?>
		</dl>
<?endif?>
<?if(count($arResult["DISPLAY_PROPERTIES"])>0):?>
		<dl class="properties">
<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<dt><?=$arProperty["NAME"]?>:</dt><dd><?if(is_array($arProperty["DISPLAY_VALUE"])):?><?=implode(" / ", $arProperty["DISPLAY_VALUE"])?><?else:?><?=$arProperty["DISPLAY_VALUE"]?><?endif?></dd>
<?endforeach?>
		</dl>
<?endif?>
<?if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y"):?>
		<div class="news-detail-share">
<?$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
		"HANDLERS" => $arParams["SHARE_HANDLERS"],
		"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
		"PAGE_TITLE" => $arResult["~NAME"],
		"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"HIDE" => $arParams["SHARE_HIDE"],
	),
	$component,
	array("HIDE_ICONS" => "Y")
);
?>
		</div>
<?endif?>
	</div>
