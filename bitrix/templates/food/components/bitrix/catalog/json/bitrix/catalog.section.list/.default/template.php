<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><div class="catalog" ng-controller="catalogController">
<script type="json/data" id="catalogData">(<?=$arResult["DATA_JSON"]?>)</script>   
<nav class="catalog-sections">
    <div class="links">
	    <a href="{{section.LINK}}" ng-repeat="section in sections|filter:{SECTION_ID:0}" ng-class="{true:'active'}[section.ID==topSection]">{{section.NAME}}</a>
    </div>
</nav>
<nav class="submenu" >
	<a href="{{section.LINK}}" ng-repeat="section in sections | filter:topSection?{SECTION_ID:topSection}:true" ng-class="{true:'active'}[section.ID==filterBySection.ID]">{{section.NAME}}</a>
</nav>
    {{topSection}}<br>
    {{filterBySection}}
<div ng-view class="page-view"></div>
<script type="text/ng-template" id="list.html">
</script>
<script type="text/ng-template" id="detail.html">
</script>
</div>