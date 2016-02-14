<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);?>
<!DOCTYPE html>
<html ng-app="pureCountry">
<title><?$APPLICATION->ShowTitle()?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--[if lte IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/respond.js")?>
<![endif]-->

<?$APPLICATION->SetAdditionalCSS("http://fnt.webink.com/wfs/webink.css/?project=DA826768-D454-4650-AF75-1954262DE22A&fonts=3CE3758E-9A83-BA6E-300A-ACCFD5D3E584:f=ProximaNova-BoldIt,58A3DDEA-1A20-AFB9-54E7-882B2382F4AD:f=ProximaNova-SemiboldIt,FA4379E2-2038-8F3F-1CCD-9D7F6C1BE854:f=ProximaNova-ExtrabldIt,7ADDF267-02FA-4E7A-F098-EF6D9CFEF9AE:f=ProximaNova-Black,DD341213-BCCD-C52B-39B2-FF9E7464B6E5:f=ProximaNova-ThinIt,5A9479E7-B0E0-2DCD-5F27-F7666DF19C0F:f=ProximaNova-LightIt,D658C100-EB60-0878-7701-BA465DF17739:f=ProximaNovaT-Thin,38D80777-BBB8-AAF3-8C21-AAA9AD92B6E6:f=ProximaNova-BlackIt,382B4521-6228-4C38-41BC-3DE66C7C910A:f=ProximaNova-Bold,58DEFEBD-4A55-477B-3C13-525C6AEBDD7A:f=ProximaNova-Regular,C344819E-7F64-52D2-5903-DE54F5382845:f=ProximaNova-Semibold,D8F30418-0E92-EBB4-6408-D220574EF53E:f=ProximaNova-Extrabld,F5870F1F-48F5-36F5-550E-B276AA09225A:f=ProximaNova-RegularIt,C88A28DF-0112-63D9-25D2-A4EA08DAF75B:f=ProximaNova-Light")?>

<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.js")?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox.pack.js")?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/popup_auth.js")?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/bootstrap/js/bootstrap.min.js")?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/bootstrap/css/bootstrap.min.css")?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox.css")?>
<?
$APPLICATION->AddHeadScript("http://code.angularjs.org/1.2.7/angular.min.js");
$APPLICATION->AddHeadScript("http://code.angularjs.org/1.2.7/angular-route.min.js");
$APPLICATION->AddHeadScript("http://code.angularjs.org/1.2.7/angular-sanitize.min.js");
$APPLICATION->AddHeadScript("http://code.angularjs.org/1.2.7/angular-animate.min.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/accounting.min.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/filters.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/directives.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/ui-bootstrap-0.10.0.min.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/ui-bootstrap-tpls-0.10.0.min.js");
?>
<?$APPLICATION->ShowHead()?>


<body>
<div class="container all_content">
<header class="pagehead">
<?if(INDEX_PAGE=="Y"):?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/logo.js")?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/logo.css")?>
<?if ($USER->IsAdmin()):?>
	<aside id="adminpanel">
<?$APPLICATION->ShowPanel()?>
	</aside>
<?endif?>
	<div id="transforming-logo">
		<div class="logo-place index">
			<div class="container logo-holder"><img class="logo" src="<?=SITE_TEMPLATE_PATH?>/images/grand_logo.png" alt="Чистый край"></div>
			<div class="logo-image-container"><div class="container logo-bg"></div></div>
			<div class="slogan text-center">Родина натуральных продуктов</div>
		</div>
	</div>
	<nav class="navbar">
		<div class="container mainmenu-container">
<?$APPLICATION->IncludeComponent("bitrix:menu", "mainmenu", Array(
	"ROOT_MENU_TYPE" => "main",	// Тип меню для первого уровня
	"MENU_CACHE_TYPE" => "N",	// Тип кеширования
	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	"MAX_LEVEL" => "1",	// Уровень вложенности меню
	"CHILD_MENU_TYPE" => "main",	// Тип меню для остальных уровней
	"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	"DELAY" => "N",	// Откладывать выполнение шаблона меню
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	),
	false
);?>
        </div>
    </nav>
    <div class="page_content container">
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "mainMenu",
                array(
                    "TYPE" => "main",
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "6",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "Y",
                    "COUNT_ELEMENTS" => "Y",
                    "TOP_DEPTH" => "2",
                    "SECTION_URL" => "/catalog/#/#SECTION_CODE#/",
                    "VIEW_MODE" => "TEXT",
                    "SHOW_PARENT_NAME" => "Y"
                ),
                false
            );
            ?>
    </div>
<?else:?>
<nav class="navbar navbar-fixed-top">
<?if ($USER->IsAdmin()):?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/admin.css")?>
	<aside id="adminpanel">
<?$APPLICATION->ShowPanel()?>
	</aside>
<?endif?>
	<div class="container mainmenu-container">
		<div class="logo-place">
			<a class="url" href="/"><img class="logo" src="<?=SITE_TEMPLATE_PATH?>/images/logo.png" alt="Чистый край"></a>
		</div>
		
	<div class="top_icon">
            <?if($USER->IsAuthorized()):?>
			    <a href="/personal/" class="auth"></a>
            <?else:?>
			    <a href="/auth/" data-fancybox-type="ajax" class="auth" id="open-auth-form"></a>
            <?endif?>
            <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "a", Array(
	            "PATH_TO_BASKET" => "/personal/cart/",	// Страница корзины
	            "PATH_TO_ORDER" => "/personal/order/make/",	// Страница оформления заказа
	            "SHOW_DELAY" => "N",	// Показывать отложенные товары
	            "SHOW_NOTAVAIL" => "N",	// Показывать товары, недоступные для покупки
	            "SHOW_SUBSCRIBE" => "N",	// Показывать товары, на которые подписан покупатель
	            ),
	            false
            );?>
	</div>


        <?$APPLICATION->IncludeComponent("bitrix:menu", "mainmenu", Array(
	        "ROOT_MENU_TYPE" => "main",	// Тип меню для первого уровня
	        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
	        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
	        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
	        "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	        "MAX_LEVEL" => "1",	// Уровень вложенности меню
	        "CHILD_MENU_TYPE" => "main",	// Тип меню для остальных уровней
	        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	        "DELAY" => "N",	// Откладывать выполнение шаблона меню
	        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	        ),
	        false
        );?>


        <?if(HIDE_CATALOG_LINKS!="Y"):?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "mainMenu",
                array(
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "6",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "Y",
                    "COUNT_ELEMENTS" => "Y",
                    "TOP_DEPTH" => "2",
                    "SECTION_URL" => "/catalog/#/#SECTION_CODE#/",
                    "VIEW_MODE" => "TEXT",
                    "SHOW_PARENT_NAME" => "Y"
                ),
                false
            );
            ?>
        <!--a href="/catalog/"><img src="<?=SITE_TEMPLATE_PATH?>/images/city.png" class="img-responsive center-block city"></a-->
        <?endif?> 
        <?if(CSite::InDir('/catalog/')):?>
            <?$APPLICATION->ShowViewContent('catalogMenu');?>
        <?endif;?>
	</div>
</nav>
<?endif?>
</header>
<section class="page_content container">
<?if(HIDE_TITLE!="Y"):?>
	<h1><?=$APPLICATION->ShowTitle(false)?></h1>
<?endif?>
<?$APPLICATION->IncludeComponent("bitrix:menu", "submenu", Array(
	"ROOT_MENU_TYPE" => "section",	// Тип меню для первого уровня
	"MENU_CACHE_TYPE" => "N",	// Тип кеширования
	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	"MAX_LEVEL" => "1",	// Уровень вложенности меню
	"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
	"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	"DELAY" => "N",	// Откладывать выполнение шаблона меню
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	),
	false
);?>