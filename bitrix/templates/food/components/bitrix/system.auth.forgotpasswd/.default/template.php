<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($_POST['AUTH_FORM']=='Y'):?>
        <div class="wrap-register-form popup-form text-center clearfix">
            <div class="success_form">
            </div>
            <div class="success_form_message">На указанный вами адрес высланы инструкции по восстановлению пароля.</div>
            <div class="back" style="padding-bottom:20px;"><a href="/auth/?ajax=Y">←  <span style="color: black;text-transform: uppercase;font-size: 14px;">Назад</span></a><br></div>
        </div>
<?else:?>
    <div class="popup-form text-center clearfix">

        <h2>Восстановление пароля</h2>
        <form name="bform" method="post" class="auth_form" target="_top" action="<?=$arResult["AUTH_URL"]?>">
        <?
        if (strlen($arResult["BACKURL"]) > 0)
        {
        ?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?
        }
        ?>
            <input type="hidden" name="AUTH_FORM" value="Y">
            <input type="hidden" name="TYPE" value="SEND_PWD">
            <p style="text-align: left;font-size: 14px;line-height: 22px;padding-top: 0px;">
            Если вы забыли пароль, ничего страшного. Просто введите email, который вы указали при регистрации, и мы поможем
            </p>
            <div class="form-group">
                <input onkeypress="if($('input[name=send_account_info]').val()!='') $('input[name=send_account_info]').prop( 'disabled', false );" type="email" class="<?if($arResult['ERROR']):?>errorInput<?endif?> form-control" name="USER_EMAIL" maxlength="255" />
            </div>
            <input type="submit" disabled="disabled" name="send_account_info" class="btn btn-default" value="Отправить" />
        <p>
        <!--a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a-->
        </p> 
        </form>
    </div>
<?endif;?>