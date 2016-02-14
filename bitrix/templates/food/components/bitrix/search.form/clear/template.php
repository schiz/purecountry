<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
		<form action="<?=$arResult["FORM_ACTION"]?>" id="search">
<?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
	"bitrix:search.suggest.input",
	"",
	array(
		"NAME" => "q",
		"VALUE" => "",
		"INPUT_SIZE" => 15,
		"DROPDOWN_SIZE" => 10,
	),
	$component, array("HIDE_ICONS" => "Y")
);?>
<?else:?>
			<input type="search" name="q">
<?endif?>
			<button name="s" type="submit" value="true"><?=GetMessage("BSF_T_SEARCH_BUTTON")?></button>
		</form>
