<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.js")?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/popup.js")?>
<?if ($arResult["FORM_TYPE"] == "login"):?>
<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
{
	ShowMessage($arResult['ERROR_MESSAGE']);
}
?>
<? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && ($arResult['USE_OPENID'] == 'Y' || $arResult['USE_LIVEID'] == 'Y')){?>
<script type="text/javascript">

function SAFChangeAuthForm(v)
{
	document.getElementById('at_frm_bitrix').style.display = (v == 'bitrix') ? 'block' : 'none';
	<? if ($arResult['USE_OPENID'] == 'Y') { ?>document.getElementById('at_frm_openid').style.display = (v == 'openid') ? 'block' : 'none';<?}?>
	<? if ($arResult['USE_LIVEID'] == 'Y') { ?>document.getElementById('at_frm_liveid').style.display = (v == 'liveid') ? 'block' : 'none';<?}?>
}

</script>
<table border="0" cellpadding="0" cellspacing="0">
<form id="choosemethod">
<tr>
	<td><input type="radio" id="auth_type_frm_bitrix" name="BX_AUTH_TYPE" value="bitrix" onclick="SAFChangeAuthForm(this.value)" checked></td>
	<td><label for="auth_type_frm_bitrix"><?=GetMessage('AUTH_A_INTERNAL')?></label></td>
</tr>
<? if ($arResult['USE_OPENID'] == 'Y') { ?>
<tr>
	<td><input type="radio" id="auth_type_frm_openid" name="BX_AUTH_TYPE" value="openid" onclick="SAFChangeAuthForm(this.value)"></td>
	<td><label for="auth_type_frm_openid"><?=GetMessage('AUTH_A_OPENID')?></label></td>
</tr>
<? } ?>
<? if ($arResult['USE_LIVEID'] == 'Y') { ?>
<tr>
	<td><input type="radio" id="auth_type_frm_liveid" name="BX_AUTH_TYPE" value="liveid" onclick="SAFChangeAuthForm(this.value)"></td>
	<td><label for="auth_type_frm_liveid"><?=GetMessage('AUTH_A_LIVEID')?></label></td>
</tr>
<? } ?>
</form>
</table>
<?}?>
<?$APPLICATION->AddHeadScript("/bitrix/templates/".SITE_TEMPLATE_ID."/js/jquery.js")?>
	<div class="auth"><a rel="nofollow" href="/personal/profile/?login=yes" onclick="return showPopup('auth');">Вход</a> [ <a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>]</div>
	<div id="popup_auth" class="hidden">
		<form id="auth_form" method="post" action="<?=$arResult["AUTH_URL"]?>">
			<a class="close" href="?logout=yes" onclick="closePopup();return false;">[x]</a>
			<h2><?=GetMessage("AUTH_AUTH")?></h2>
			<fieldset>
<?if (strlen($arResult["BACKURL"]) > 0) {?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?}?>
<?foreach ($arResult["POST"] as $key => $value) {?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?}?>
				<input type="hidden" name="AUTH_FORM" value="Y" />
				<input type="hidden" name="TYPE" value="AUTH" />
				<input type="text" name="USER_LOGIN" id="user_login" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>" />
				<input type="password" name="USER_PASSWORD" id="user_password" maxlength="50" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" />
<?if ($arResult["STORE_PASSWORD"] == "Y"){?>
				<p class="rememberme">
					<input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
					<label for="USER_REMEMBER_frm"><?=GetMessage("AUTH_REMEMBER_ME")?></label>
				</p>
<?}?>
				<button type="submit" name="Login"><?=GetMessage("AUTH_LOGIN_BUTTON")?></button>
				<p>
<?if($arResult["NEW_USER_REGISTRATION"] == "Y"){?>
					<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>
<?}?>
					<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
				</p>
<?if ($arResult["CAPTCHA_CODE"]){?>
<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
				<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
				<input type="text" name="captcha_word" maxlength="50" value="" />
<?}?>
			</fieldset>
		</form>
	</div>
<? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && $arResult['USE_OPENID'] == 'Y'){?>
<div id="at_frm_openid" style="display: none">
<form method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
	<table width="95%">
			<tr>
				<td colspan="2">
				<?=GetMessage("AUTH_OPENID")?>:<br />
				<input type="text" name="OPENID_IDENTITY" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
			</tr>
	</table>
</form>
</div>
<?}?>
<? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && $arResult['USE_LIVEID'] == 'Y'){?>
<div id="at_frm_liveid" style="display: none"><noindex>
<a href="<?=$arResult['LIVEID_LOGIN_LINK']?>" rel="nofollow"><?=GetMessage('AUTH_LIVEID_LOGIN')?></a>
</noindex></div>
<?}?>
<?else:?>
<form class="auth" action="<?=$arResult["AUTH_URL"]?>" class="logout">
	<a rel="nofollow" href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=$arResult["USER_NAME"]?></a>
	[<button type="submit" name="logout_butt"><?=GetMessage("AUTH_LOGOUT_BUTTON")?></button>]
<?foreach ($arResult["GET"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="logout" value="yes" />
	
</form>
<?endif?>