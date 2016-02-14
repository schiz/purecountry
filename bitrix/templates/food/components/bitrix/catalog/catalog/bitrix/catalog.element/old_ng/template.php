<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);
CJSCore::Init(array('ajax', 'window'));
$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_stricker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'ZOOM_DIV' => $strMainID.'_zoom_cont',
	'ZOOM_PICT' => $strMainID.'_zoom_pict'
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);


/*
<h1>{{item.NAME}}</h1>
	<div class="row">
		<div class="col-sm-6 col-sm-push-3">
			<img ng-src="{{item.IMAGE.src}}" class="img-responsive detail-image center-block">
		</div>
		<div class="col-sm-3 col-sm-pull-6">
			<figure class="item-info-part clearfix" ng-if="item.PACK">
				<img ng-src="{{item.PACK.src}}" class="img-responsive pack-image center-block">
				<figcaption class="pack-info">Упаковка сделана из перерабатываемых материалов</figcaption>
			</figure>
			<div class="carcass" ng-if="item.CARCASE">
				<img ng-src="{{item.CARCASE.src}}" class="img-responsive pack-image center-block">
			</div>
			<div class="item-info-part" ng-if="item.METHOD">
				<div class="method">{{item.METHOD}}</div>
			</div>
			<div class="item-info-part" ng-if="item.PLACE">
				<div class="place">{{item.PLACE}}</div>
			</div>
			<div class="item-info-part" ng-if="item.CERT">
				<div class="cert"><a href="{{item.CERT.SRC}}" target="_blank">Сертификаты и вет. свидетельства</a></div>
			</div>
		</div>
		<div class="col-sm-3">
			<form class="buy-block text-center" action="/catalog/" method="post" ng-if="item.PRICE">
				<input type="hidden" name="id" value="{{item.ID}}">
				<div class="price">{{item.PRICE|prettynumber}} Р</div>
				<quantity value="1"></quantity>
				<button name="action" value="BUY" type="submit" class="btn to_cart btn-default">В корзину</button>
			</form>
            <div class="descr">
            <span style="">{{item.SUB_ADD_BASKET}}</span> {{item.SUB_ADD_BASKET_VALUE}}
            </div>
			<article ng-bind-html="item.DESCRIPTION" class="descr"></article>
			<div class="descr" ng-if="item.CONSIST"><span>Состав:</span> {{item.CONSIST}}</div>
			<div class="descr" ng-if="item.BEST_BEFORE"><span>Срок хранения:</span> {{item.BEST_BEFORE}}</div>
			<div class="descr" ng-if="item.ENERGY_VALUE"><span>Энергетическая ценность:</span> {{item.ENERGY_VALUE}}</div>
			<div class="descr">
			<span ng-if="item.PROTEINS||item.FAT||item.CARB">Содержание в 100 г</span>
			<table>
				<tr ng-if="item.PROTEINS"><td>белков</td><td>{{item.PROTEINS}}</td></tr>
				<tr ng-if="item.FAT"><td>жиров</td><td>{{item.FAT}}</td></tr>
				<tr ng-if="item.CARB"><td>углеводов</td><td>{{item.CARB}}</td></tr>
			</table>
			</div>
			<div class="descr" ng-if="item.GLYCEMIC_INDEX"><span>Гликемический индекс:</span> {{item.GLYCEMIC_INDEX}}</div>
		</div>
	</div>	
    <div ng-if="item.LINKED_ELEMENTS.length" style="height: 400px;">
        <h2 style="margin-bottom:30px;padding-top:20px;text-align: center;">Сопутствующие товары</h2>
        <div class="row catalog_list">
            <div class="col-xs-6 col-sm-4 col-md-3 wrap-index" ng-repeat-start="linkedElement in item.LINKED_ELEMENTS">
                <div class="item text-center" style="margin-bottom: 0;">                
                    <a class="preview-image" href="#/{{linkedElement.SECTION_CODE}}/{{linkedElement.ID}}/" style="background-image:url({{linkedElement.IMAGE.src}})"></a>
                    <hgroup>
                        <div class="section-name">{{linkedElement.SECTION_NAME}}</div>                        
                        <h4><a href="#/{{linkedElement.SECTION_CODE}}/{{linkedElement.ID}}/" class="catalog-item-link text-center">{{linkedElement.NAME}}</a></h4>
                    </hgroup>
                    <div class="price">{{linkedElement.PRICE|prettynumber}} <span class="currency">руб.</span></div>
                </div>
            </div>
            <div class="clearfix hide" ng-repeat-end ng-class="separatorClasses($index)"></div>
        </div>
    </div>
*/
//echo '<pre>'; var_dump($arResult); echo '</pre>';
?>

<h1><?=$arResult["NAME"]?></h1>
<div class="row">
		<div class="col-sm-6 col-sm-push-3">
			<img src="<? echo $arResult['DETAIL_PICTURE']['SRC']; ?>" class="img-responsive detail-image center-block">
		</div>
		<div class="col-sm-3 col-sm-pull-6">
			<figure class="item-info-part clearfix<?=($arResult['PACK']['src']?'':" hide")?>" >
				<img src="<?=$arResult['PACK']['src']?>" class="img-responsive pack-image center-block">
				<figcaption class="pack-info">Упаковка сделана из перерабатываемых материалов</figcaption>
			</figure>
			<div class="carcass<?=($arResult['CARCASE']['src']?'':" hide")?>"  >
				<img src="<?=$arResult['CARCASE']['src']?>" class="img-responsive pack-image center-block">
			</div>
			<div class="item-info-part<?=($arResult["DISPLAY_PROPERTIES"]["METHOD"]["DISPLAY_VALUE"]?'':" hide")?>" >
				<div class="method"><?=$arResult["DISPLAY_PROPERTIES"]["METHOD"]["DISPLAY_VALUE"]?></div>
			</div>
			<div class="item-info-part<?=($arResult["DISPLAY_PROPERTIES"]["PLACE"]["DISPLAY_VALUE"]?'':" hide")?>" >
				<div class="place"><?=$arResult["DISPLAY_PROPERTIES"]["PLACE"]["DISPLAY_VALUE"]?></div>
			</div>
			<div class="item-info-part<?=($arResult["CERTIFICATE"]?'':" hide")?>">
				<div class="cert"><a href="<?=$arResult["CERTIFICATE"]?>" target="_blank">Сертификаты и вет. свидетельства</a></div>
			</div>
		</div>
		<div class="col-sm-3">
			<?/*<form class="buy-block text-center" action="/catalog/" method="post" >
				<input type="hidden" name="id" value="<?=$arResult['ID']?>">*/?>
				<div class="price"><?=$arResult["PRICES"][ $arResult['type_price_user'] ]["VALUE_NOVAT"]?> Р</div>
				<div class="item_price">
				<?
				$boolDiscountShow = (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']);
				?>
					<div class="item_old_price" id="<? echo $arItemIDs['OLD_PRICE']; ?>" style="display: <? echo ($boolDiscountShow ? '' : 'none'); ?>"><? echo ($boolDiscountShow ? $arResult['MIN_PRICE']['PRINT_VALUE'] : ''); ?></div>
					<div class="item_current_price" id="<? echo $arItemIDs['PRICE']; ?>"><? echo $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?></div>
					<div class="item_economy_price" id="<? echo $arItemIDs['DISCOUNT_PRICE']; ?>" style="display: <? echo ($boolDiscountShow ? '' : 'none'); ?>"><? echo ($boolDiscountShow ? GetMessage('ECONOMY_INFO', array('#ECONOMY#' => $arResult['MIN_PRICE']['PRINT_DISCOUNT_DIFF'])) : ''); ?></div>
					<img
						id="<? echo $arItemIDs['PICT']; ?>"
						src="<? echo $arResult['DETAIL_PICTURE']['SRC']; ?>"
						alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
						title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
					>
                    <span class="bx_cnt_desc" id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"><? echo (isset($arResult['CATALOG_MEASURE_NAME']) ? $arResult['CATALOG_MEASURE_NAME'] : ''); ?></span>
				</div>
				<quantity value="1"></quantity>
				
				<!-- add block -->
				<span class="item_buttons_counter_block">
					<a href="javascript:void(0)" class="bx_bt_white bx_small bx_fwb" id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</a>
					<input id="<? echo $arItemIDs['QUANTITY']; ?>" type="text" class="tac transparent_input" value="<? echo (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])
							? 1
							: $arResult['CATALOG_MEASURE_RATIO']
						); ?>">
					<a href="javascript:void(0)" class="bx_bt_white bx_small bx_fwb" id="<? echo $arItemIDs['QUANTITY_UP']; ?>">+</a>
					
				</span>
				<a href="javascript:void(0);" class="bx_big bx_bt_blue bx_cart" id="<? echo $arItemIDs['BUY_LINK']; ?>"><button class="btn to_cart btn-default item_buttons_counter_block ">
					<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET']
							? $arParams['MESS_BTN_ADD_TO_BASKET']
							: GetMessage('CT_BCE_CATALOG_ADD')
						); ?>
				</button></a>
			<!-- end -->
				
			<?/*	<button name="action" value="BUY" type="submit" class="btn to_cart btn-default">В корзину</button>
			</form> */?>
            <div class="descr">
            <span style=""><?=$arResult['PROPERTIES']['SUB_ADD_BASKET']['DESCRIPTION']?></span> <?=$arResult['PROPERTIES']['SUB_ADD_BASKET']['VALUE']?>
            </div>
			<article ng-bind-html="" class="descr"><?=$arResult["~PREVIEW_TEXT"]?></article>
			<div class="descr<?=($arResult["PROPERTIES"]["CONSIST"]["VALUE"]?'':" hide")?>" ><span>Состав:</span> <?=$arResult['PROPERTIES']['CONSIST']['VALUE']?></div>
			<div class="descr<?=($arResult["PROPERTIES"]["BEST_BEFORE"]["VALUE"]?'':" hide")?>" ><span>Срок хранения:</span> <?=$arResult['PROPERTIES']['BEST_BEFORE']['VALUE']?></div>
			<div class="descr<?=($arResult["PROPERTIES"]["ENERGY_VALUE"]["VALUE"]?'':" hide")?>" ><span>Энергетическая ценность:</span> <?=$arResult['PROPERTIES']['ENERGY_VALUE']['VALUE']?></div>
			<div class="descr<?=($arResult["PROPERTIES"]["PROTEINS"]["VALUE"] || $arResult["PROPERTIES"]["FAT"]["VALUE"] || $arResult["PROPERTIES"]["CARB"]["VALUE"] ?'':" hide")?>">
			<span >Содержание в 100 г</span>
			<table>
				<tr  class="<?=($arResult["PROPERTIES"]["PROTEINS"]["VALUE"]?'':" hide")?>"><td>белков</td><td><?=$arResult['PROPERTIES']['PROTEINS']['VALUE']?></td></tr>
				<tr  class="<?=($arResult["PROPERTIES"]["FAT"]["VALUE"]?'':" hide")?>"><td>жиров</td><td><?=$arResult['PROPERTIES']['FAT']['VALUE']?></td></tr>
				<tr  class="<?=($arResult["PROPERTIES"]["CARB"]["VALUE"]?'':" hide")?>"><td>углеводов</td><td><?=$arResult['PROPERTIES']['CARB']['VALUE']?></td></tr>
			</table>
			</div>
			<div class="descr<?=($arResult["PROPERTIES"]["GLYCEMIC_INDEX"]["VALUE"]?'':" hide")?>" ><span>Гликемический индекс:</span> <?=$arResult['PROPERTIES']['GLYCEMIC_INDEX']['VALUE']?></div>
		</div>
</div>	

<div class="bx_item_detail <? echo $templateData['TEMPLATE_CLASS']; ?>" id="<? echo $arItemIDs['ID']; ?>">
<?
if ('Y' == $arParams['USE_VOTE_RATING'])
{
?><?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote",
	"stars",
	array(
		"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"ELEMENT_ID" => $arResult['ID'],
		"ELEMENT_CODE" => "",
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array("1", "2", "3", "4", "5"),
		"SET_STATUS_404" => "N",
		"DISPLAY_AS_RATING" => $arParams['VOTE_DISPLAY_AS_RATING'],
		"CACHE_TYPE" => $arParams['CACHE_TYPE'],
		"CACHE_TIME" => $arParams['CACHE_TIME']
	),
	$component,
	array("HIDE_ICONS" => "Y")
);?><?
}
?>
<?/*
	<h1>
		<span><? echo (
			isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
			? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
			: $arResult["NAME"]
		); ?></span>
	</h1>
	<div class="bx_item_container">
		<div class="bx_lt">
<div class="bx_item_slider" id="<? echo $arItemIDs['BIG_SLIDER_ID']; ?>">
	<div class="bx_bigimages">
		<div class="bx_bigimages_imgcontainer">
			<span class="bx_bigimages_aligner"></span><img
				id="<? echo $arItemIDs['PICT']; ?>"
				src="<? echo $arResult['DETAIL_PICTURE']['SRC']; ?>"
				alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
				title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			>
<?
if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
{
?>
			<div class="bx_stick_disc" id="<? echo $arItemIDs['DISCOUNT_PICT_ID'] ?>" style="display: none;"></div>
<?
}
if ($arResult['LABEL'])
{
?>
			<div class="bx_stick new" id="<? echo $arItemIDs['STICKER_ID'] ?>"><? echo $arResult['LABEL_VALUE']; ?></div>
<?
}
?>
		</div>
	</div>
<?
if ($arResult['SHOW_SLIDER'])
{
	if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS']))
	{
		if (5 < $arResult['MORE_PHOTO_COUNT'])
		{
			$strClass = 'bx_slider_conteiner full';
			$strOneWidth = (100/$arResult['MORE_PHOTO_COUNT']).'%';
			$strWidth = (20*$arResult['MORE_PHOTO_COUNT']).'%';
			$strSlideStyle = '';
		}
		else
		{
			$strClass = 'bx_slider_conteiner';
			$strOneWidth = '20%';
			$strWidth = '100%';
			$strSlideStyle = 'display: none;';
		}
?>
	<div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['SLIDER_CONT_ID']; ?>">
		<div class="bx_slider_scroller_container">
			<div class="bx_slide">
				<ul style="width: <? echo $strWidth; ?>;" id="<? echo $arItemIDs['SLIDER_LIST']; ?>">
<?
		foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto)
		{
?>
					<li data-value="<? echo $arOnePhoto['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"><a href="javascript:void(0)"><span style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span></a></li>
<?
		}
		unset($arOnePhoto);
?>
				</ul>
			</div>
			<div class="bx_slide_left" id="<? echo $arItemIDs['SLIDER_LEFT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
			<div class="bx_slide_right" id="<? echo $arItemIDs['SLIDER_RIGHT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
		</div>
	</div>
<?
	}
	else
	{
		foreach ($arResult['OFFERS'] as $key => $arOneOffer)
		{
			if (!isset($arOneOffer['MORE_PHOTO_COUNT']) || 0 >= $arOneOffer['MORE_PHOTO_COUNT'])
				continue;
			$strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');
			if (5 < $arOneOffer['MORE_PHOTO_COUNT'])
			{
				$strClass = 'bx_slider_conteiner full';
				$strOneWidth = (100/$arOneOffer['MORE_PHOTO_COUNT']).'%';
				$strWidth = (20*$arOneOffer['MORE_PHOTO_COUNT']).'%';
				$strSlideStyle = '';
			}
			else
			{
				$strClass = 'bx_slider_conteiner';
				$strOneWidth = '20%';
				$strWidth = '100%';
				$strSlideStyle = 'display: none;';
			}
?>
	<div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>" style="display: <? echo $strVisible; ?>;">
		<div class="bx_slider_scroller_container">
			<div class="bx_slide">
				<ul style="width: <? echo $strWidth; ?>;" id="<? echo $arItemIDs['SLIDER_LIST_OF_ID'].$arOneOffer['ID']; ?>">
<?
			foreach ($arOneOffer['MORE_PHOTO'] as &$arOnePhoto)
			{
?>
					<li data-value="<? echo $arOneOffer['ID'].'_'.$arOnePhoto['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>"><a href="javascript:void(0)"><span style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span></a></li>
<?
			}
			unset($arOnePhoto);
?>
				</ul>
			</div>
			<div class="bx_slide_left" id="<? echo $arItemIDs['SLIDER_LEFT_OF_ID'].$arOneOffer['ID'] ?>" style="<? echo $strSlideStyle; ?>" data-value="<? echo $arOneOffer['ID']; ?>"></div>
			<div class="bx_slide_right" id="<? echo $arItemIDs['SLIDER_RIGHT_OF_ID'].$arOneOffer['ID'] ?>" style="<? echo $strSlideStyle; ?>" data-value="<? echo $arOneOffer['ID']; ?>"></div>
		</div>
	</div>
<?
		}
	}
}
?>
</div>
		</div>

		<div class="bx_rt">

<?if ('Y' == $arParams['BRAND_USE']):?>
	<div class="bx_optionblock">
		<?$APPLICATION->IncludeComponent("bitrix:catalog.brandblock", ".default", array(
			"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
			"IBLOCK_ID" => $arParams['IBLOCK_ID'],
			"ELEMENT_ID" => $arResult['ID'],
			"ELEMENT_CODE" => "",
			"PROP_CODE" => $arParams['BRAND_PROP_CODE'],
			"CACHE_TYPE" => $arParams['CACHE_TYPE'],
			"CACHE_TIME" => $arParams['CACHE_TIME'],
			"WIDTH" => "",
			"HEIGHT" => ""
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);?>
	</div>
<?endif;?>

<div class="item_price">
<?
$boolDiscountShow = (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']);
?>
	<div class="item_old_price" id="<? echo $arItemIDs['OLD_PRICE']; ?>" style="display: <? echo ($boolDiscountShow ? '' : 'none'); ?>"><? echo ($boolDiscountShow ? $arResult['MIN_PRICE']['PRINT_VALUE'] : ''); ?></div>
	<div class="item_current_price" id="<? echo $arItemIDs['PRICE']; ?>"><? echo $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?></div>
	<div class="item_economy_price" id="<? echo $arItemIDs['DISCOUNT_PRICE']; ?>" style="display: <? echo ($boolDiscountShow ? '' : 'none'); ?>"><? echo ($boolDiscountShow ? GetMessage('ECONOMY_INFO', array('#ECONOMY#' => $arResult['MIN_PRICE']['PRINT_DISCOUNT_DIFF'])) : ''); ?></div>
</div>
<?
if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
{
?>
<div class="item_info_section">
<?
	if (!empty($arResult['DISPLAY_PROPERTIES']))
	{
?>
	<dl>
<?
		foreach ($arResult['DISPLAY_PROPERTIES'] as &$arOneProp)
		{
?>
		<dt><? echo $arOneProp['NAME']; ?></dt><?
			echo '<dd>', (
				is_array($arOneProp['DISPLAY_VALUE'])
				? implode(' / ', $arOneProp['DISPLAY_VALUE'])
				: $arOneProp['DISPLAY_VALUE']
			), '</dd>';
		}
		unset($arOneProp);
?>
	</dl>
<?
	}
	if ($arResult['SHOW_OFFERS_PROPS'])
	{
?>
	<dl id="<? echo $arItemIDs['DISPLAY_PROP_DIV'] ?>" style="display: none;"></dl>
<?
	}
?>
</div>
<?
}
if ('' == $arResult['DETAIL_TEXT'] && '' != $arResult['PREVIEW_TEXT'])
{
?>
<div class="item_info_section">
<?
	echo ('html' == $arResult['PREVIEW_TEXT_TYPE'] ? $arResult['PREVIEW_TEXT'] : '<p>'.$arResult['PREVIEW_TEXT'].'</p>');
?>
</div>
<?
}
if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) && !empty($arResult['OFFERS_PROP']))
{
	$arSkuProps = array();
?>
<div class="item_info_section" style="padding-right:150px;" id="<? echo $arItemIDs['PROP_DIV']; ?>">
<?
	foreach ($arResult['SKU_PROPS'] as &$arProp)
	{
		if (!isset($arResult['OFFERS_PROP'][$arProp['CODE']]))
			continue;
		$arSkuProps[] = array(
			'ID' => $arProp['ID'],
			'TYPE' => $arProp['PROPERTY_TYPE'],
			'VALUES_COUNT' => $arProp['VALUES_COUNT']
		);
		if ('L' == $arProp['PROPERTY_TYPE'])
		{
			if (5 < $arProp['VALUES_COUNT'])
			{
				$strClass = 'bx_item_detail_size full';
				$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
				$strWidth = (20*$arProp['VALUES_COUNT']).'%';
				$strSlideStyle = '';
			}
			else
			{
				$strClass = 'bx_item_detail_size';
				$strOneWidth = '20%';
				$strWidth = '100%';
				$strSlideStyle = 'display: none;';
			}
?>
	<div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont">
		<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
		<div class="bx_size_scroller_container"><div class="bx_size">
			<ul id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;margin-left:0%;">
<?
			foreach ($arProp['VALUES'] as $arOneValue)
			{
?>
				<li
					data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID']; ?>"
					data-onevalue="<? echo $arOneValue['ID']; ?>"
					style="width: <? echo $strOneWidth; ?>;"
				><span></span>
				<a href="javascript:void(0)"><? echo htmlspecialcharsex($arOneValue['NAME']); ?></a></li>
<?
			}
?>
			</ul>
			</div>
			<div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
			<div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
		</div>
	</div>
<?
		}
		elseif ('E' == $arProp['PROPERTY_TYPE'])
		{
			if (5 < $arProp['VALUES_COUNT'])
			{
				$strClass = 'bx_item_detail_scu full';
				$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
				$strWidth = (20*$arProp['VALUES_COUNT']).'%';
				$strSlideStyle = '';
			}
			else
			{
				$strClass = 'bx_item_detail_scu';
				$strOneWidth = '20%';
				$strWidth = '100%';
				$strSlideStyle = 'display: none;';
			}
?>
	<div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont">
		<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
		<div class="bx_scu_scroller_container"><div class="bx_scu">
			<ul id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;margin-left:0%;">
<?
			foreach ($arProp['VALUES'] as $arOneValue)
			{
?>
				<li
					data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>"
					data-onevalue="<? echo $arOneValue['ID']; ?>"
					style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"
				><span title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></span>
				<a href="javascript:void(0)"><span
					style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
					title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"
				></span></a></li>
<?
			}
?>
			</ul>
			</div>
			<div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
			<div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
		</div>
	</div>
<?
		}
	}
	unset($arProp);
?>
</div>
<?
}

?>
<div class="item_info_section">
<?
if ((isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) || $arResult["CAN_BUY"])
{
	if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
	{
?>
	<span class="item_section_name_gray"><? echo GetMessage('CATALOG_QUANTITY'); ?></span>
	<div class="item_buttons vam">
	<??>
		<span class="item_buttons_counter_block">
			<a href="javascript:void(0)" class="bx_bt_white bx_small bx_fwb" id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</a>
			<input id="<? echo $arItemIDs['QUANTITY']; ?>" type="text" class="tac transparent_input" value="<? echo (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])
					? 1
					: $arResult['CATALOG_MEASURE_RATIO']
				); ?>">
			<a href="javascript:void(0)" class="bx_bt_white bx_small bx_fwb" id="<? echo $arItemIDs['QUANTITY_UP']; ?>">+</a>
			<span class="bx_cnt_desc" id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"><? echo (isset($arResult['CATALOG_MEASURE_NAME']) ? $arResult['CATALOG_MEASURE_NAME'] : ''); ?></span>
		</span>
		<span class="item_buttons_counter_block">
			<a href="javascript:void(0);" class="bx_big bx_bt_blue bx_cart" id="<? echo $arItemIDs['BUY_LINK']; ?>"><span></span><? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET']
					? $arParams['MESS_BTN_ADD_TO_BASKET']
					: GetMessage('CT_BCE_CATALOG_ADD')
				); ?></a>
<?
		if ('Y' == $arParams['DISPLAY_COMPARE'])
		{
?>
			<a href="javascript:void(0)" class="bx_big bx_bt_white bx_cart" style="margin-left: 10px"><? echo ('' != $arParams['MESS_BTN_COMPARE']
					? $arParams['MESS_BTN_COMPARE']
					: GetMessage('CT_BCE_CATALOG_COMPARE')
				); ?></a>
<?
		}
?>
		</span>
		
	</div>
<?
		if ('Y' == $arParams['SHOW_MAX_QUANTITY'])
		{
			if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
			{
?>
	<p id="<? echo $arItemIDs['QUANTITY_LIMIT']; ?>" style="display: none;"><? echo GetMessage('OSTATOK'); ?>: <span></span></p>
<?
			}
			else
			{
				if ('Y' == $arResult['CATALOG_QUANTITY_TRACE'] && 'N' == $arResult['CATALOG_CAN_BUY_ZERO'])
				{
?>
	<p id="<? echo $arItemIDs['QUANTITY_LIMIT']; ?>"><? echo GetMessage('OSTATOK'); ?>: <span><? echo $arResult['CATALOG_QUANTITY']; ?></span></p>
<?
				}
			}
		}
	}
	else
	{
?>
	<div class="item_buttons vam">
		<span class="item_buttons_counter_block">
			<a href="javascript:void(0);" class="bx_big bx_bt_blue bx_cart" id="<? echo $arItemIDs['BUY_LINK']; ?>"><span></span><? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET']
					? $arParams['MESS_BTN_ADD_TO_BASKET']
					: GetMessage('CT_BCE_CATALOG_ADD')
				); ?></a>
<?
		if ('Y' == $arParams['DISPLAY_COMPARE'])
		{
?>
			<a id="<? echo $arItemIDs['COMPARE_LINK']; ?>" href="javascript:void(0)" class="bx_big bx_bt_white bx_cart" style="margin-left: 10px"><? echo ('' != $arParams['MESS_BTN_COMPARE']
					? $arParams['MESS_BTN_COMPARE']
					: GetMessage('CT_BCE_CATALOG_COMPARE')
				); ?></a>
<?
		}
?>
		</span>
	</div>
<?
	}
}
else
{


}

?>

</div>
			<div class="clb"></div>
		</div>
<?*/?>
		<div class="bx_md">
<div class="item_info_section">
<?
if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
{
	if ($arResult['OFFER_GROUP'])
	{
		foreach ($arResult['OFFERS'] as $arOffer)
		{
			if (!$arOffer['OFFER_GROUP'])
				continue;
?>
	<span id="<? echo $arItemIDs['OFFER_GROUP'].$arOffer['ID']; ?>" style="display: none;">
<?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor",
	".default",
	array(
		"IBLOCK_ID" => $arResult["OFFERS_IBLOCK"],
		"ELEMENT_ID" => $arOffer['ID'],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	),
	$component,
	array("HIDE_ICONS" => "Y")
);?><?
?>
	</span>
<?
		}
	}
}
else
{
	if ($arResult['MODULES']['catalog'])
	{
?><?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor",
	".default",
	array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_ID" => $arResult["ID"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	),
	$component,
	array("HIDE_ICONS" => "Y")
);?><?
	}
}
?>
</div>
		</div>
<?/*
		<div class="bx_rb">
<div class="item_info_section">
<?
if ('' != $arResult['DETAIL_TEXT'])
{
?>
	<div class="bx_item_description">
		<div class="bx_item_section_name_gray" style="border-bottom: 1px solid #f2f2f2;"><? echo GetMessage('FULL_DESCRIPTION'); ?></div>
<?
	if ('html' == $arResult['DETAIL_TEXT_TYPE'])
	{
		echo $arResult['DETAIL_TEXT'];
	}
	else
	{
		?><p><? echo $arResult['DETAIL_TEXT']; ?></p><?
	}
?>
	</div>
<?
}
?>
</div>
		</div>
*/?>

		<div class="bx_lb">
<div class="tac ovh">
<?/*$APPLICATION->IncludeComponent(
	"bitrix:catalog.socnets.buttons",
	"",
	array(
		"URL_TO_LIKE" => $APPLICATION->GetCurPageParam(),
		"TITLE" => "",
		"DESCRIPTION" => "",
		"IMAGE" => "",
		"FB_USE" => "Y",
		"TW_USE" => "Y",
		"GP_USE" => "Y",
		"VK_USE" => "Y",
		"TW_VIA" => "",
		"TW_HASHTAGS" => "",
		"TW_RELATED" => ""
	),
	$component,
	array("HIDE_ICONS" => "Y")
);*/?>
</div>
<div class="tab-section-container">
<?
if ('Y' == $arParams['USE_COMMENTS'])
{
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.comments",
	"",
	array(
		"ELEMENT_ID" => $arResult['ID'],
		"ELEMENT_CODE" => "",
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"URL_TO_COMMENT" => "",
		"WIDTH" => "",
		"COMMENTS_COUNT" => "5",
		"BLOG_USE" => $arParams['BLOG_USE'],
		"FB_USE" => $arParams['FB_USE'],
		"FB_APP_ID" => $arParams['FB_APP_ID'],
		"VK_USE" => $arParams['VK_USE'],
		"VK_API_ID" => $arParams['VK_API_ID'],
		"CACHE_TYPE" => $arParams['CACHE_TYPE'],
		"CACHE_TIME" => $arParams['CACHE_TIME'],
		"BLOG_TITLE" => "",
		"BLOG_URL" => "",
		"PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
		"EMAIL_NOTIFY" => "N",
		"AJAX_POST" => "Y",
		"SHOW_SPAM" => "Y",
		"SHOW_RATING" => "N",
		"FB_TITLE" => "",
		"FB_USER_ADMIN_ID" => "",
		"FB_APP_ID" => $arParams['FB_APP_ID'],
		"FB_COLORSCHEME" => "light",
		"FB_ORDER_BY" => "reverse_time",
		"VK_TITLE" => "",
	),
	$component,
	array("HIDE_ICONS" => "Y")
);?>
<?
}
?>
</div>
		</div>
			<div style="clear: both;"></div>
	</div>
	<div class="clb"></div>
</div><?
if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
	{
		foreach ($arResult['JS_OFFERS'] as &$arOneJS)
		{
			if ($arOneJS['PRICE']['DISCOUNT_VALUE'] != $arOneJS['PRICE']['VALUE'])
			{
				$arOneJS['PRICE']['PRINT_DISCOUNT_DIFF'] = GetMessage('ECONOMY_INFO', array('#ECONOMY#' => $arOneJS['PRICE']['PRINT_DISCOUNT_DIFF']));
				$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'];
			}
			$strProps = '';
			if ($arResult['SHOW_OFFERS_PROPS'])
			{
				if (!empty($arOneJS['DISPLAY_PROPERTIES']))
				{
					foreach ($arOneJS['DISPLAY_PROPERTIES'] as $arOneProp)
					{
						$strProps .= '<dt>'.$arOneProp['NAME'].'</dt><dd>'.(
							is_array($arOneProp['VALUE'])
							? implode(' / ', $arOneProp['VALUE'])
							: $arOneProp['VALUE']
						).'</dd>';
					}
				}
			}
			$arOneJS['DISPLAY_PROPERTIES'] = $strProps;
		}
		if (isset($arOneJS))
			unset($arOneJS);
		$arJSParams = array(
			'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_ADD_BASKET_BTN' => true,
			'SHOW_BUY_BTN' => false,
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'VISUAL' => array(
				'BIG_SLIDER_ID' => $arItemIDs['ID'],
				'ID' => $arItemIDs['ID'],
				'PICT_ID' => $arItemIDs['PICT'],
				'QUANTITY_ID' => $arItemIDs['QUANTITY'],
				'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
				'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
				'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
				'QUANTITY_LIMIT' => $arItemIDs['QUANTITY_LIMIT'],
				'PRICE_ID' => $arItemIDs['PRICE'],
				'OLD_PRICE_ID' => $arItemIDs['OLD_PRICE'],
				'DISCOUNT_VALUE_ID' => $arItemIDs['DISCOUNT_PRICE'],
				'DISCOUNT_PERC_ID' => $arItemIDs['DISCOUNT_PICT_ID'],
				'NAME_ID' => $arItemIDs['NAME'],
				'TREE_ID' => $arItemIDs['PROP_DIV'],
				'TREE_ITEM_ID' => $arItemIDs['PROP'],
				'SLIDER_CONT_OF_ID' => $arItemIDs['SLIDER_CONT_OF_ID'],
				'SLIDER_LIST_OF_ID' => $arItemIDs['SLIDER_LIST_OF_ID'],
				'SLIDER_LEFT_OF_ID' => $arItemIDs['SLIDER_LEFT_OF_ID'],
				'SLIDER_RIGHT_OF_ID' => $arItemIDs['SLIDER_RIGHT_OF_ID'],
				'BUY_ID' => $arItemIDs['BUY_LINK'],
				'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_LINK'],
				'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK'],
				'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
				'OFFER_GROUP' => $arItemIDs['OFFER_GROUP'],
				'ZOOM_DIV' => $arItemIDs['ZOOM_DIV'],
				'ZOOM_PICT' => $arItemIDs['ZOOM_PICT']
			),
			'DEFAULT_PICTURE' => array(
				'PREVIEW_PICTURE' => $arResult['PREVIEW_PICTURE'],
				'DETAIL_PICTURE' => $arResult['DETAIL_PICTURE']
			),
			'BASKET' => array(
				'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
				'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE']
			),
			'OFFERS' => $arResult['JS_OFFERS'],
			'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
			'TREE_PROPS' => $arSkuProps,
			'AJAX_PATH' => POST_FORM_ACTION_URI,
			'MESS' => array(
				'ECONOMY_INFO' => GetMessage('ECONOMY_INFO')
			)
		);
	}
	else
	{
		$arJSParams = array(
			'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_ADD_BASKET_BTN' => true,
			'SHOW_BUY_BTN' => false,
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
			'VISUAL' => array(
				'BIG_SLIDER_ID' => $arItemIDs['ID'],
				'ID' => $arItemIDs['ID'],
				'PICT_ID' => $arItemIDs['PICT'],
				'QUANTITY_ID' => $arItemIDs['QUANTITY'],
				'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
				'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
				'PRICE_ID' => $arItemIDs['PRICE'],
				'OLD_PRICE_ID' => $arItemIDs['OLD_PRICE'],
				'DISCOUNT_VALUE_ID' => $arItemIDs['DISCOUNT_PRICE'],
				'DISCOUNT_PERC_ID' => $arItemIDs['DISCOUNT_PICT_ID'],
				'NAME_ID' => $arItemIDs['NAME'],
				'TREE_ID' => $arItemIDs['PROP_DIV'],
				'TREE_ITEM_ID' => $arItemIDs['PROP'],
				'SLIDER_CONT' => $arItemIDs['SLIDER_CONT_ID'],
				'SLIDER_LIST' => $arItemIDs['SLIDER_LIST'],
				'SLIDER_LEFT' => $arItemIDs['SLIDER_LEFT'],
				'SLIDER_RIGHT' => $arItemIDs['SLIDER_RIGHT'],
				'BUY_ID' => $arItemIDs['BUY_LINK'],
				'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_LINK'],
				'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK'],
			),
			'PRODUCT' => array(
				'ID' => $arResult['ID'],
				'PICT' => $arResult['DETAIL_PICTURE'],
				'NAME' => $arResult['~NAME'],
				'SUBSCRIPTION' => true,
				'PRICE' => $arResult['MIN_PRICE'],
				'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
				'SLIDER' => $arResult['MORE_PHOTO'],
				'CAN_BUY' => $arResult['CAN_BUY'],
				'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
				'QUANTITY_FLOAT' => is_double($arResult['CATALOG_MEASURE_RATIO']),
				'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
				'STEP_QUANTITY' => $arResult['CATALOG_MEASURE_RATIO'],
				'BUY_URL' => $arResult['~BUY_URL'],
			),
			'BASKET' => array(
				'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
				'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE']
			),
			'AJAX_PATH' => POST_FORM_ACTION_URI,
			'MESS' => array()
		);
	}
?>
<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
</script>