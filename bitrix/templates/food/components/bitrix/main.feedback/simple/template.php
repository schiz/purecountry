<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
	<form method="post">
		<h2><?=GetMessage("MFT_TITLE")?></h2>
<?if(!empty($arResult["ERROR_MESSAGE"])) {
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0):?>
		<p class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></p>
<?endif?>
<?=bitrix_sessid_post()?>
		<fieldset>
			<label><?=GetMessage("MFT_NAME")?>:</label>
				<input name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
			<label><?=GetMessage("MFT_EMAIL")?>:</label>
				<input name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
			<label class="main"><?=GetMessage("MFT_MESSAGE")?>:</label>
				<textarea name="MESSAGE" rows="5" cols="40"><?=$arResult["MESSAGE"]?></textarea>
<?if($arParams["USE_CAPTCHA"] == "Y"):?>
		<div class="mf-captcha">
			<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
			<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
			<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
			<input type="text" name="captcha_word" size="30" maxlength="50" value="">
		</div>
<?endif?>
		</fieldset>
		<button type="submit" name="submit" value="true"><?=GetMessage("MFT_SUBMIT")?></button>
	</form>
