<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$total = 0;
foreach ($arResult["ITEMS"] as $v)
{
    if ($v["DELAY"]=="N" && $v["CAN_BUY"]=="Y")
    {
        $total += $v["QUANTITY"];
    }
}
?>

<!--start--><div class="small_cart">
<?if($_GET['basket-ajax']=='Y')
    $APPLICATION->RestartBuffer();
?>
<a href="<?=$arParams["PATH_TO_BASKET"]?>" class="quantity"><?=$total?></a>
    <div class="cart_items">
        <div class="items">
            <?CModule::IncludeModule("iblock");
            if($arResult["READY"]=="Y" || $arResult["DELAY"]=="Y" || $arResult["NOTAVAIL"]=="Y" || $arResult["SUBSCRIBE"]=="Y"){
                if ($arResult["READY"]=="Y"){
                    foreach ($arResult["ITEMS"] as &$v){
                        if ($v["DELAY"]=="N" && $v["CAN_BUY"]=="Y")
                        {
                            $res = CIBlockElement::GetByID($v['PRODUCT_XML_ID']);
                            if($ar_res = $res->GetNext())
                                 $file = CFile::ResizeImageGet($ar_res['DETAIL_PICTURE'], array('width'=>50, 'height'=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true);   
                            ?>
                            <div class="basket-item">
                                <div class="item-cart-img"><img  src="<?=$file['src']?>" /></div>
                                <div class="item-cart-text">
                                    <div class="category">Телятина<!--a href="javascript:void(0)" id="ajaxaction=delete&amp;ajaxdeleteid=4393" class="close-cart del-item"><span></span>X</a--></div>
                                    <div class="name"><?echo $v["NAME"]?></div>
                                    <div class="options"><span class="cart-quantity"><?echo $v["QUANTITY"]?> шт.</span><span class="price"><?echo $v["PRICE_FORMATED"]?></span></div>
                                </div>
                            </div><br>
                            <?
                        }
                    }
                    if (isset($v))
                        unset($v);
                    ?><?
                }
            }
            ?>
        </div>
        <?if ('' != $arParams["PATH_TO_BASKET"]){?>
            <a href="<?=$arParams["PATH_TO_BASKET"]?>"><div class="cart-total">
            <span>Оформить заказ</span><span class="total_price"><?=$arResult['TOTAL']?> Р</span></div></a><?
        }?>
    </div>
<?if($_GET['basket-ajax']=='Y')
die();
?>    
</div>
<!--end-->