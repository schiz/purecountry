<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><div class="products" ng-controller="productsController">
	<script type="json/data" id="articlesData">(<?=$arResult["DATA_JSON"]?>)</script>
	<div class="page-box clearfix">
		<div ng-view class="page-view"></div>
	</div>
</div>
<script type="text/ng-template" id="list.html">
	<h1>
		<a href="#!/articles" ng-if="filterBySection"><?=$APPLICATION->ShowTitle(false)?></a>
		<span ng-if="!filterBySection"><?=$APPLICATION->ShowTitle(false)?></span>
	</h1>
	<nav class="submenu">
		<a ng-repeat="section in productsData.SECTIONS" href="{{section.LINK}}" ng-class="{true:'active'}[section.ID==filterBySection]">{{section.NAME}}</a>
	</nav>
	<div class="row">
		<div class="wrap-index col-md-4 col-sm-6" ng-repeat-start="article in productsData.ARTICLES | filter: filterBySection?{SECTION_ID:filterBySection}:false">
			<div class="item text-center">
				<a href="{{article.DETAIL_PAGE_URL}}" class="preview-image" style="background-image:url({{article.PREVIEW_PICTURE.src}})"></a>
				<hgroup>
					<div class="section-name ng-binding">{{productsData.SECTIONS[article.SECTION_ID].NAME}}</div>
					<h4><a href="{{article.DETAIL_PAGE_URL}}" ng-bind-html="article.NAME" class="ng-binding">{{article.NAME}}</a></h4>
				</hgroup>
				<div class="anons-text ng-binding"  ng-bind-html="article.PREVIEW_TEXT">{{article.PREVIEW_TEXT}}</div>
			</div>
		</div>		
		<div class="clearfix hide" ng-repeat-end ng-class="separatorClasses($index)"></div>
	</div>
</script>
<script type="text/ng-template" id="detail.html">
<div class="row article-detail" ng-if="article">
	<article class="col-md-10 col-md-offset-1">
		<h1>{{article.NAME}}</h1>
		<nav class="submenu">
			<a ng-repeat="section in productsData.SECTIONS" href="{{section.LINK}}" ng-class="{true:'active'}[section.ID==filterBySection]">{{section.NAME}}</a>
		</nav>
		<figure class="media-object pull-left detail-picture" ng-if="article.DETAIL_PICTURE">
			<!--img ng-src="{{article.PREVIEW_PICTURE.src}}"-->
		</figure>
        <div class="anons" style="margin: 55px 0 0 0;" ng-bind-html="article.PREVIEW_TEXT_FULL"></div>
		<div class="main" style="clear: both;" ng-bind-html="article.DETAIL_TEXT"></div>
	</article>
</div>
<div class="row" ng-if="!article">
	<div class="alert alert-danger">Простите, такой статьи не нашлось</div>
</div>
</script>