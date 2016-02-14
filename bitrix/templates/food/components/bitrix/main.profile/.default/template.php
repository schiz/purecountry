<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die()?>
<div class="row">
<div class="prolile col-md-6 col-md-offset-3 text-center">
	<h2>Ваши данные</h2>
<?ShowError($arResult["strProfileError"]);?>
<?if ($arResult['DATA_SAVED'] == 'Y') ShowNote(GetMessage('PROFILE_DATA_SAVED'));?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
	<div class="form-group">
		<div class="row">
			<div class="col-md-6"><input type="text" name="NAME" maxlength="50" class="form-control" value="<?=$arResult["arUser"]["NAME"]?>" placeholder="<?=GetMessage('NAME')?>" /></div>
			<div class="col-md-6"><input type="text" name="LAST_NAME" maxlength="50" class="form-control" value="<?=$arResult["arUser"]["LAST_NAME"]?>" placeholder="<?=GetMessage('LAST_NAME')?>" /></div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-md-6"><input type="text" name="EMAIL" maxlength="50" class="form-control" value="<? echo $arResult["arUser"]["EMAIL"]?>" placeholder="<?=GetMessage('EMAIL')?>"></div>
			<div class="col-md-6"><input type="text" name="PERSONAL_PHONE" maxlength="255" class="form-control" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" placeholder="<?=GetMessage('USER_PHONE')?>"></div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-md-12">
				<textarea class="form-control" rows="2" name="PERSONAL_STREET" placeholder="Адрес"><?=$arResult["arUser"]["PERSONAL_STREET"]?></textarea>
			</div>
		</div>
	</div>
	<div class="form-group">
	<h4>Заполните, если хотите сменить пароль:</h4>
		<div class="row text-left change_pass">
			<div class="col-md-6">
				<label ><?=GetMessage('NEW_PASSWORD_REQ')?></label>
				<input type="password" class="form-control" name="NEW_PASSWORD" class="form-control" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
	
					<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
						<div class="bx-auth-secure-icon"></div>
					</span>	
			</div>
			<div class="col-md-6">
				<label><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
				<input type="password" class="form-control" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<input type="submit" name="save" class="btn btn-default" value="<?=(($arResult["ID"]>0) ? GetMessage("SAVE") : GetMessage("SAVE"))?>">
		</div>
	</div>
</div>	
</form>
</div>
</div>