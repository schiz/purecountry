<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($_REQUEST["JSON"]=="Y"):?>
<?
$APPLICATION->RestartBuffer();
header("Content-Type: application/json; charset=utf-8");
echo $arResult["DATA_JSON"];
die();
?>
<?else:?>
<form action="<?=$arParams["PATH_TO_ORDER"]?>" method="post" ng-controller="cartController" class="col-xs-12" ng-class="loading?'load':''">
	<div class="row cart-row" ng-repeat="item in items">
		<div class="col-xs-10 col-xs-offset-1 cart-row-content">
			<div class="row">
				<div class="col-xs-2 image_item"><img ng-src="{{item.IMAGE}}"></div>
				<div class="col-xs-2 category_item">{{item.SECTION}}</div>
				<div class="col-xs-4 title_item">
				<a href="{{item.DETAIL_PAGE_URL}}">{{item.NAME}}</a>
				</div>
				<div class="col-xs-2 quantity-widget-wrap">
					<div class="quantity-widget">
						<button type="button" class="btn btn-link minus" ng-click="qd($index,-1)">-</button>
						<input type="text" ng-model="item.DISPLAY_QUANTITY" ng-focus="qFocus($index)" ng-blur="qBlur($index)" ng-change="qChange($index)">
						<button type="button" class="btn btn-link plus" ng-click="qd($index,1)">+</button>
					</div>
				</div>
				<div class="col-xs-2 price_item text-center">{{item.PRICE|prettyprice}}</div>
			</div>
		</div>
		<div class="col-xs-1"><button type="button" class="btn btn-link remove" ng-click="remove($index)">Удалить</button></div>
	</div>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 cart-footer">
			<div class="row all_price">
				<div class="col-xs-4 clear_cart">
					Очистить корзину
				</div>
				<div class="col-xs-3 col-xs-offset-2 text-right total-price-text">
					Итого без стоимости<br>доставки:
				</div>
				<div class="col-xs-2 text-right total-price">{{TOTAL_PRICE|prettyprice}}</div>
			</div>
			<div class="row issue_order">
				<div class="col-xs-8 issue_order_text">
					Нажимая кнопку «Оформить заказ», я соглашаюсь<br>с <a href="/delivery-and-payment/" class="rules-delivery">правилами</a> доставки и оплаты.
				</div>
				<div class="col-xs-4">
					<button type="submit" class="btn btn-lg btn-primary pull-right btn-default bb-order">Оформить заказ</button>
				</div>
			</div>
		</div>
	</div>
</form>

<?endif?>
