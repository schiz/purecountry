<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
global $APPLICATION;
if (!empty($arResult['ITEMS']))
{
	CJSCore::Init(array("popup"));
	$arSkuTemplate = array();
	if (!empty($arResult['SKU_PROPS']))
	{
		foreach ($arResult['SKU_PROPS'] as &$arProp)
		{
			ob_start();
			if ('L' == $arProp['PROPERTY_TYPE'])
			{
				if (5 < $arProp['VALUES_COUNT'])
				{
					$strClass = 'bx_item_detail_size full';
					$strWidth = ($arProp['VALUES_COUNT']*20).'%';
					$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
					$strSlideStyle = '';
				}
				else
				{
					$strClass = 'bx_item_detail_size';
					$strWidth = '100%';
					$strOneWidth = '20%';
					$strSlideStyle = 'display: none;';
				}
				?><div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
				<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
				<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
							foreach ($arProp['VALUES'] as $arOneValue)
							{
								?><li
								data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID']; ?>"
								data-onevalue="<? echo $arOneValue['ID']; ?>"
								style="width: <? echo $strOneWidth; ?>;"
								><span></span><a href="javascript:void(0)"><? echo htmlspecialcharsex($arOneValue['NAME']); ?></a></li><?
							}
							?></ul></div>
					<div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
					<div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
				</div>
				</div><?
			}
			elseif ('E' == $arProp['PROPERTY_TYPE'])
			{
				if (5 < $arProp['VALUES_COUNT'])
				{
					$strClass = 'bx_item_detail_scu full';
					$strWidth = ($arProp['VALUES_COUNT']*20).'%';
					$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
					$strSlideStyle = '';
				}
				else
				{
					$strClass = 'bx_item_detail_scu';
					$strWidth = '100%';
					$strOneWidth = '20%';
					$strSlideStyle = 'display: none;';
				}
				?><div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
				<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
				<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
							foreach ($arProp['VALUES'] as $arOneValue)
							{
								?><li
								data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>"
								data-onevalue="<? echo $arOneValue['ID']; ?>"
								style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"
								><span title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></span>
								<a href="javascript:void(0)"><span
									style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
									title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"
								></span></a></li><?
							}
							?></ul></div>
					<div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
					<div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
				</div>
				</div><?
			}
			$arSkuTemplate[$arProp['CODE']] = ob_get_contents();
			ob_end_clean();
		}
		unset($arProp);
	}

	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM'));

	$strFullPath = $_SERVER['DOCUMENT_ROOT'].$this->GetFolder();

	$templateData = array(
		'TEMPLATE_THEME' => $this->GetFolder().'/'.ToLower($arParams['VIEW_MODE']).'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
		'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
	);
	switch ($arParams['VIEW_MODE'])
	{
		case 'BANNER':
			include($strFullPath.'/banner/template.php');
			break;
		case 'SLIDER':
			include($strFullPath.'/slider/template.php');
			break;
		case 'SECTION':
			include($strFullPath.'/section/template.php');
			break;
	}
}
?>