<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult["ORDERS"] as $o => $arOrder):
     
          $arResult["ORDERS"][$o]["ORDER"]["DATE_ORDER"] = strtolower(FormatDate("j F Y", MakeTimeStamp($arOrder["ORDER"]["DATE_INSERT"])));
    
endforeach;
?>