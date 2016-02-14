<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog" ng-controller="catalogController">
<?$this->SetViewTarget('catalogMenu');?>
    <div ng-controller="catalogController">
    <script type="json/data" id="catalogData">(<?=$arResult["DATA_JSON"]?>)</script>
    <nav class="catalog-sections {{ActiveClass}}">
        <div class="links">
	        <a href="{{section.LINK}}" ng-repeat="section in sections|filter:{SECTION_ID:0}" ng-class="[{true:'active'}[section.ID==topSection],section.CODE]">{{section.NAME}}</a>
        </div>
    </nav>
    <nav class="submenu" ng-if="!topSectionDesc">
	    <a href="{{section.LINK}}" ng-repeat="section in sections | filter:topSection?{SECTION_ID:topSection}:true" ng-class="{true:'active'}[section.ID==filterBySection.ID]">{{section.NAME}}</a>
    </nav>
    </div>
<?$this->EndViewTarget();?> 
<div ng-view class="page-view"></div>
<script type="text/ng-template" id="list.html">
	<div class="row catalog_list" >
        <div class="col-md-10 col-md-offset-1" ng-if="items.DESCRIPTION" >
            <p ng-bind-html="htmlDescr"></p>
        </div>
        <div ng-repeat-start="line in items" class="clearfix">
		    <div class="col-xs-6 col-sm-4 col-md-{{bigItemColumn($index,$parent.$index)[0]}} wrap-index" style="{{bigItemColumn($index,$parent.$index)[1]}}" ng-repeat-start="item in line">
			    <div class="item text-center">				
				    <a class="preview-image" href="#/{{item.SECTION_CODE}}/{{item.ID}}/" style="background-image:url({{item.IMAGE.src}})"></a>
				    <hgroup>
					    <div class="section-name">{{item.SECTION_NAME}}</div>						
					    <h4><a href="#/{{item.SECTION_CODE}}/{{item.ID}}/" class="catalog-item-link text-center">{{item.NAME}}</a></h4>
				    </hgroup>
                    <form class="buy-block text-center" action="/api/buy/" method="post" ng-if="item.PRICE">
                        <input type="hidden" name="id" value="{{item.ID}}">
                        <div class="price">{{item.PRICE|prettynumber}} <span class="currency">руб.</span></div>
                        <div class="form-list-hide">
                            <quantity value="1"></quantity>
                            <button name="action" value="BUY" type="submit" class="btn to_cart btn-default">В корзину</button>
                        </div>
                    </form>
			    </div>
		    </div>
            <div class="hide" ng-repeat-end ng-class="separatorClasses($index)"></div>
        </div>
		<div class="hide" ng-repeat-end></div>
	</div>
</script>
<script type="text/ng-template" id="detail.html">
	<h1>{{item.NAME}}</h1>
	<div class="row">
		<div class="col-sm-6 col-sm-push-3">
			<img ng-src="{{item.IMAGE.src}}" class="img-responsive detail-image center-block">
		</div>
		<div class="col-sm-3 col-sm-pull-6">
			<figure class="item-info-part clearfix" ng-if="item.PACK">
				<img ng-src="{{item.PACK.src}}" class="img-responsive pack-image center-block">
				<figcaption class="pack-info">Упаковка сделана из перерабатываемых материалов</figcaption>
			</figure>
			<div class="carcass" ng-if="item.CARCASE">
				<img ng-src="{{item.CARCASE.src}}" class="img-responsive pack-image center-block">
			</div>
			<div class="item-info-part" ng-if="item.METHOD">
				<div class="method">{{item.METHOD}}</div>
			</div>
			<div class="item-info-part" ng-if="item.PLACE">
				<div class="place">{{item.PLACE}}</div>
			</div>
			<div class="item-info-part" ng-if="item.CERT">
				<div class="cert"><a href="{{item.CERT.SRC}}" target="_blank">Сертификаты и вет. свидетельства</a></div>
			</div>
		</div>
		<div class="col-sm-3">
			<form class="buy-block text-center" action="/catalog/" method="post" ng-if="item.PRICE">
				<input type="hidden" name="id" value="{{item.ID}}">
				<div class="price">{{item.PRICE|prettynumber}} Р</div>
				<quantity value="1"></quantity>
				<button name="action" value="BUY" type="submit" class="btn to_cart btn-default">В корзину</button>
			</form>
            <div class="descr">
            <span style="">{{item.SUB_ADD_BASKET}}</span> {{item.SUB_ADD_BASKET_VALUE}}
            </div>
			<article ng-bind-html="item.DESCRIPTION" class="descr"></article>
			<div class="descr" ng-if="item.CONSIST"><span>Состав:</span> {{item.CONSIST}}</div>
			<div class="descr" ng-if="item.BEST_BEFORE"><span>Срок хранения:</span> {{item.BEST_BEFORE}}</div>
			<div class="descr" ng-if="item.ENERGY_VALUE"><span>Энергетическая ценность:</span> {{item.ENERGY_VALUE}}</div>
			<div class="descr">
			<span ng-if="item.PROTEINS||item.FAT||item.CARB">Содержание в 100 г</span>
			<table>
				<tr ng-if="item.PROTEINS"><td>белков</td><td>{{item.PROTEINS}}</td></tr>
				<tr ng-if="item.FAT"><td>жиров</td><td>{{item.FAT}}</td></tr>
				<tr ng-if="item.CARB"><td>углеводов</td><td>{{item.CARB}}</td></tr>
			</table>
			</div>
			<div class="descr" ng-if="item.GLYCEMIC_INDEX"><span>Гликемический индекс:</span> {{item.GLYCEMIC_INDEX}}</div>
		</div>
	</div>
	<!--div class="row recipes" ng-if="item.RECIPES">
		<div class="col-sm-6 col-sm-push-3">
			<h3 class="text-center">Рецептология</h3>
			<div class="recipe-list">
				<div class="recipe-slide" ng-repeat="recipe in item.RECIPES">
					<h4 class="text-center" ng-bind-html="recipe.NAME"></h4>
					<div class="row">
						<div class="col-xs-6">
							<div class="item-info-part recipe-section {{recipe.SECTION.CODE}}">
								{{recipe.SECTION.NAME}}
							</div>
							<div class="item-info-part cooking-method">
								{{recipe.METHOD}}
							</div>
							<div class="item-info-part cooking-time">
								готовить
								<time>{{recipe.CTIME.VALUE}}</time>
								{{recipe.CTIME.LABEL}}
							</div>
						</div>
						<div class="col-xs-6">
							<img ng-src="{{recipe.IMAGE}}">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div-->
    <div ng-if="item.LINKED_ELEMENTS.length" style="height: 400px;">
        <h2 style="margin-bottom:30px;padding-top:20px;text-align: center;">Сопутствующие товары</h2>
        <div class="row catalog_list">
            <div class="col-xs-6 col-sm-4 col-md-3 wrap-index" ng-repeat-start="linkedElement in item.LINKED_ELEMENTS">
                <div class="item text-center" style="margin-bottom: 0;">                
                    <a class="preview-image" href="#/{{linkedElement.SECTION_CODE}}/{{linkedElement.ID}}/" style="background-image:url({{linkedElement.IMAGE.src}})"></a>
                    <hgroup>
                        <div class="section-name">{{linkedElement.SECTION_NAME}}</div>                        
                        <h4><a href="#/{{linkedElement.SECTION_CODE}}/{{linkedElement.ID}}/" class="catalog-item-link text-center">{{linkedElement.NAME}}</a></h4>
                    </hgroup>
                    <div class="price">{{linkedElement.PRICE|prettynumber}} <span class="currency">руб.</span></div>
                </div>
            </div>
            <div class="clearfix hide" ng-repeat-end ng-class="separatorClasses($index)"></div>
        </div>
    </div>
</script>
</div>
