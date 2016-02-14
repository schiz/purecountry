<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult["FORM_TYPE"] == "login"):?>
<div class="popup-form text-center clearfix">
<h2>Вход</h2>
<form method="post"  name="system_auth_form<?=$arResult["RND"]?>" class="auth_form" target="_top" action="<?=$arResult["AUTH_URL"]?>">
    <input type="hidden" name="backurl" value="/success_auth.php?type=auth" />
<?foreach ($arResult["POST"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
    <input type="hidden" name="auth_submit_button" value="Y">
	<div class="form-group">
		<input type="email" name="USER_LOGIN" class="<?if($arResult['ERROR']):?>errorInput<?endif?> form-control" placeholder="email">
	</div>
	<div class="form-group">
		<input type="password" class="<?if($arResult['ERROR']):?>errorInput<?endif?> form-control" name="USER_PASSWORD" placeholder="пароль">
		

<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?=GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
</script>
<?endif?>
		
	</div>
	<input type="submit" class="btn btn-default" value="войти">
</form>

	<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" class="forgot_pass" rel="nofollow">Забыли пароль?</a>
	
	<div class="socwork">
	
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"Y",
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"Y")
);
?>

	</div>
	
	<div class="reg_now">
		<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow">Зарегистрироваться</a>
	</div>
</div>
<?else:?>
    <div class="popup-fon">
        <div class="wrap-register-form popup-form text-center clearfix">
            <div class="success_form">
            </div>
            <div class="success_form_message">Вы успешно вошли на сайт!</div>
        </div>
    </div>
    <script>
        setTimeout(function(){location.reload()},1000);
    </script>
<!--div class="popup-form col-md-4 col-md-offset-4 text-center clearfix">
	<h2><?=$arResult["USER_NAME"]?></h2>
	<form method="post" name="system_auth_form<?=$arResult["RND"]?>" class="auth_form" target="_top" action="<?=$arResult["AUTH_URL"]?>">
		[<?=$arResult["USER_LOGIN"]?>]<br>
		<a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=GetMessage("AUTH_PROFILE")?></a><br>
<?foreach ($arResult["GET"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>">
<?endforeach?>
		<input type="hidden" name="logout" value="yes">
		<input type="submit" name="logout_butt" class="btn btn-default" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>">
	</form>
</div-->
<?endif?>

