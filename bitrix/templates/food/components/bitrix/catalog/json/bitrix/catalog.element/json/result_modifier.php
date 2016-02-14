<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?
if(CModule::IncludeModule("iblock")){
	$recipes = array();
	$obRecipes = CIBlockElement::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>7, "ACTIVE"=>"Y","PROPERTY_PRODUCTS"=>$arResult["ID"]));
	while($rsRecipe=$obRecipes->GetNextElement()){
		$arRecipe = $rsRecipe->GetFields();
		$arRecipe["PROPERTIES"] = $rsRecipe->GetProperties();
		$arRecipe["SECTION"] = CIBlockSection::GetByID($arRecipe["IBLOCK_SECTION_ID"])->GetNext();
		$photoId = intval($arRecipe["PROPERTIES"]["PHOTO"]["VALUE"][0]);
		if($photoId<=0){
			$photoId = $arRecipe["PREVIEW_PICTURE"];
		}
		if($photoId>0){
			$arRecipe["IMAGE"]= CFile::ResizeImageGet($photoId,array("width"=>230,"height"=>305),BX_RESIZE_IMAGE_EXACT);
		}
		$recipes[] = array(
			"ID" => $arRecipe["ID"],
			"NAME" => $arRecipe["NAME"],
			"LINK" => $arRecipe["DETAIL_PAGE_URL"],
			"SECTION" => array("NAME"=>$arRecipe["SECTION"]["NAME"],"CODE"=>$arRecipe["SECTION"]["CODE"]),
			"METHOD" => $arRecipe["PROPERTIES"]["METHOD"]["VALUE"],
			"TIME" => $arRecipe["PROPERTIES"]["TIME"]["VALUE"],
			"IMAGE" => $arRecipe["IMAGE"]["src"]
		);
	}
}
$arLinked = array();
if($arResult['PROPERTIES']['LINKED_ELEMENTS']['VALUE']){
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","CATALOG_GROUP_1","IBLOCK_SECTION_ID","DETAIL_PAGE_URL","PREVIEW_PICTURE","IBLOCK_SECTION_CODE");
    $arFilter = Array("=ID"=>$arResult['PROPERTIES']['LINKED_ELEMENTS']['VALUE'], "IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    while($arItem = $res->GetNext())
    {   
        $resS = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
        $ar_res = $resS->GetNext();
        $arLinked[] = array(
            "ID" => $arItem["ID"],
            "NAME" => $arItem["NAME"],
            "SECTION_ID" => $arItem["~IBLOCK_SECTION_ID"],
            "LINK" => $arItem["DETAIL_PAGE_URL"],
            "SECTION_CODE" => $ar_res['CODE'],
            "IMAGE" => CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"],array("width"=>380,"height"=>200)),
            "PRICE" => $arItem["CATALOG_PRICE_1"]
        );
      ;
    }     
}

$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=>8, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($arRes = $res->GetNext())
{
 $opis[] = $arRes['PREVIEW_TEXT'];
}
$arResult["DATA"] = array(
	"ID" => $arResult["ID"],
	"NAME" => $arResult["NAME"],
	"PACK" => CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"],array("width"=>380,"height"=>200)),
	"IMAGE" => CFile::ResizeImageGet($arResult["DETAIL_PICTURE"],array("width"=>570,"height"=>1000)),
	"CARCASE" => CFile::ResizeImageGet($arResult["DISPLAY_PROPERTIES"]["CARCASE"]["FILE_VALUE"]["ID"],array("width"=>380,"height"=>200)),
	"PRICE" => $arResult["CATALOG_PRICE_1"],
	"CERT" => $arResult["DISPLAY_PROPERTIES"]["CERTIFICATE"]["FILE_VALUE"],
	"PLACE" => $arResult["DISPLAY_PROPERTIES"]["PLACE"]["DISPLAY_VALUE"],
	"DESCRIPTION" => $arResult["PREVIEW_TEXT"],
	"CONSIST" => $arResult["DISPLAY_PROPERTIES"]["CONSIST"]["DISPLAY_VALUE"],
	"BEST_BEFORE" => $arResult["DISPLAY_PROPERTIES"]["BEST_BEFORE"]["DISPLAY_VALUE"],
	"ENERGY_VALUE" => $arResult["DISPLAY_PROPERTIES"]["ENERGY_VALUE"]["DISPLAY_VALUE"],
	"PROTEINS" => $arResult["DISPLAY_PROPERTIES"]["PROTEINS"]["DISPLAY_VALUE"],
	"FAT" => $arResult["DISPLAY_PROPERTIES"]["FAT"]["DISPLAY_VALUE"],
	"CARB" => $arResult["DISPLAY_PROPERTIES"]["CARB"]["DISPLAY_VALUE"],
    "METHOD" => $arResult["DISPLAY_PROPERTIES"]["METHOD"]["DISPLAY_VALUE"],
    "SUB_ADD_BASKET_VALUE" => $arResult["PROPERTIES"]["SUB_ADD_BASKET"]["VALUE"],
    "SUB_ADD_BASKET" => $arResult["PROPERTIES"]["SUB_ADD_BASKET"]["DESCRIPTION"],
	"PREVIEW_TEXT" => $opis,
	"GLYCEMIC_INDEX" => $arResult["DISPLAY_PROPERTIES"]["GLYCEMIC_INDEX"]["DISPLAY_VALUE"],
	"RECIPES" => $recipes,
    "LINKED_ELEMENTS" => $arLinked
);
$arResult["DATA_JSON"] = json_encode($arResult["DATA"]);