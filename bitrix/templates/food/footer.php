<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);?></section>
</div>

<footer class="pagefoot ">
<div class="container">
<div class="row footer_bg_holder">
<img src="<?=SITE_TEMPLATE_PATH?>/images/footer_bg_970.png" class="footer_bg">
</div>
<div class="row">
	<div class="col-xs-6 col-md-3 copyright">
		© 2013 «Чистый Край»<br>
		<span>Родина натуральных продуктов</span>
	</div>
	<div class="col-xs-6 col-md-4 contact">
		<span class="phone">+7 495 988-26-87</span> <span class="clock">с 9:00 до 18:00</span><br>
		Интернет-магазин работает без выходных<br>
	</div>
	<div class="clearfix visible-xs visible-sm"></div>
	<div class="col-xs-6 col-md-3 delivery">
		<a href="/delivery-and-payment/">Доставка и оплата</a>
	</div>
	<div class="col-xs-6 col-md-2">
<?$APPLICATION->IncludeComponent("food:soclinks", ".default", array(
	"VK" => "http://vk.com",
	"TWITTER" => "http://twitter.com",
	"FACEBOOK" => "http://facebook.com",
	"YOUTUBE" => ""
	),
	false
);?>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-md-offset-3 col-xs-6 contact">
		<a href="/oferta.pdf">Публичная оферта</a>
		<a href="http://www.consultant.ru/popular/consumerism/" target="_blank">Закон о защите прав потребителей</a>
	</div>
	<div class="col-xs-6 col-md-5 text-right developer"></div>
</div>
</div>
</footer>
<div id="open-auth-form"></div>
</body>
</html>