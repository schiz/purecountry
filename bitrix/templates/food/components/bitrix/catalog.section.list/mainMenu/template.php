<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<nav class="catalog-sections bg" ng-app="catalogMenu">
    <div class="links">
        <?foreach($arResult['SECTIONS'] as $arSection):?>
            <?if($arSection['DEPTH_LEVEL']==1):?>
                <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="<?=$arSection['CODE']?>"><?=$arSection['NAME']?></a>
            <?endif;?>
        <?endforeach?>
    </div>
</nav>
<?if($arParams['TYPE']=='main'):?>
    <script>
        var noScroll = true;
    </script>
<?else:?>
    <script>
        var noScroll = false;
    </script>    
<?endif?>