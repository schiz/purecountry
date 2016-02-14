<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//echo "<pre>"; print_r($arParams); print_r($arResult); echo "</pre>";

if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));
elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
	<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data" class="registration">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
		<label><?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="starrequired">*</span><?endif?></label>
<? switch ($FIELD) {
		case "PASSWORD":
		case "CONFIRM_PASSWORD":?>
		<input type="password" name="REGISTER[<?=$FIELD?>]">
<?
		break;

		case "PERSONAL_GENDER":?>
		<select name="REGISTER[<?=$FIELD?>]">
			<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
			<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected" : ""?>><?=GetMessage("USER_MALE")?></option>
			<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected" : ""?>><?=GetMessage("USER_FEMALE")?></option>
		</select>
<?
		break;

		case "PERSONAL_COUNTRY":
		case "WORK_COUNTRY":?>
		<select name="REGISTER[<?=$FIELD?>]">
<?foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value):?>
			<option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
<?endforeach?>
		</select>
<?
		break;

		case "PERSONAL_PHOTO":
		case "WORK_LOGO":?>
		<input type="file" name="REGISTER_FILES_<?=$FIELD?>">
<?
		break;

		case "PERSONAL_NOTES":
		case "WORK_NOTES":?>
		<textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea>
<?
		break;
		default:
			if ($FIELD == "PERSONAL_BIRTHDAY"):?><?=$arResult["DATE_FORMAT"]?><?endif;?>
		<input name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" />
<?if($FIELD == "PERSONAL_BIRTHDAY"):?>
<?$APPLICATION->IncludeComponent(
						'bitrix:main.calendar',
						'',
						array(
							'SHOW_INPUT' => 'N',
							'FORM_NAME' => 'regform',
							'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
							'SHOW_TIME' => 'N'
						),
						null,
						array("HIDE_ICONS"=>"Y")
					);
?>
<?endif?>
<?}?>
<?endforeach?>
<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
		<?=strLen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?>
<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
		<label><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="required">*</span><?endif?></label>
<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?>
<?endforeach?>
<?endif?>
<?// ******************** /User properties ***************************************************?>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
		<tr>
			<td colspan="2"><b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage("REGISTER_CAPTCHA_PROMT")?> <span class="starrequired">*</span>:</td>
			<td><input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
	<?
}
/* CAPTCHA */
?>
		<button type="submit" name="register_submit_button" value="true"><?=GetMessage("AUTH_REGISTER")?></button>
		<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>
		<?
if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}
?>
	</form>
