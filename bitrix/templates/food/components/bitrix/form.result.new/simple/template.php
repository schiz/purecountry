<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["isFormErrors"] == "Y"):?>
	<?=$arResult["FORM_ERRORS_TEXT"]?>
<?endif?>
<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y"):?>
<?=$arResult["FORM_HEADER"]?>
<?if($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y"):?>
<?if($arResult["isFormTitle"]):?>
	<h3><?=$arResult["FORM_TITLE"]?></h3>
<?endif?>
<?if($arResult["isFormImage"] == "Y"):?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>">
		<img src="<?=$arResult["FORM_IMAGE"]["URL"]?>">
	</a>
<?endif?>
	<p class="description"><?=$arResult["FORM_DESCRIPTION"]?></p>
<?endif?>

<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
		<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
<?endif?>
		<label><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"]?><?endif?><?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? $arQuestion["IMAGE"]["HTML_CODE"] : ""?></label>
		<?=$arQuestion["HTML_CODE"]?>
<?endforeach?>

<?if($arResult["isUseCaptcha"] == "Y"):?>
		<h3><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></h3>
		<input type="hidden" name="captcha_sid" value="<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" />
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" width="180" height="40" />
		<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"]?>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
<?endif?>

		<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"];?>" />
<?if ($arResult["F_RIGHT"] >= 15):?>
		<input type="hidden" name="web_form_apply" value="Y">
		<button type="submit"><?=GetMessage("FORM_APPLY")?></button>
<?endif?>
		<input type="reset" value="<?=GetMessage("FORM_RESET")?>">
		<p class="note"><?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?></p>
	<?=$arResult["FORM_FOOTER"]?>
<?endif?>