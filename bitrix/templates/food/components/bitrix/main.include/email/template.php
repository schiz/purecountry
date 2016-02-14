<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["FILE"] <> '') {
	$email = strip_tags(file_get_contents($arResult["FILE"]));
?><a href="mailto:<?=$email?>"><?=$email?></a><?
}
?>
