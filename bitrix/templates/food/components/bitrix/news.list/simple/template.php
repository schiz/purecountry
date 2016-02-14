<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
<?=$arResult["NAV_STRING"]?>
<?endif?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
		<article<?if($USER->IsAdmin()):?> id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?endif?>>
<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
			<h3><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h3>
<?else:?>
<h3><?=$arItem["NAME"]?></h3>
<?endif?>
<?endif?>
<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<figure class="preview">
<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"></a>
<?else:?>
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
<?endif?>
			</figure>
<?endif?>
<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<time datetime="<?=$arItem["ISODATE"]?>"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></time>
<?endif?>
<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
<?=$arItem["PREVIEW_TEXT"]?>
<?endif?>
<?if(count($arItem["FIELDS"])>0):?>
			<dl class="fields">
<?foreach($arItem["FIELDS"] as $code=>$value):?>
				<dt><?=GetMessage("IBLOCK_FIELD_".$code)?>:</dt><dd><?=$value?></dd>
<?endforeach?>
			</dl>
<?endif?>
<?if(count($arItem["DISPLAY_PROPERTIES"])>0):?>
			<dl class="properties">
<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
				<dt><?=$arProperty["NAME"]?>:</dt><dd><?if(is_array($arProperty["DISPLAY_VALUE"])):?><?=implode(" / ", $arProperty["DISPLAY_VALUE"])?><?else:?><?=$arProperty["DISPLAY_VALUE"]?><?endif?></dd>
<?endforeach?>
			</dl>
<?endif?>

		</article>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<?=$arResult["NAV_STRING"]?>
<?endif?>
	</div>
