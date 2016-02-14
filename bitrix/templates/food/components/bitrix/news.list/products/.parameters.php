<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"PREVIEW_PICTURE_MAX_WIDTH" => Array(
		"NAME" => GetMessage("PREVIEW_PICTURE_MAX_WIDTH"),
		"TYPE" => "STRING",
		"DEFAULT" => 400,
	),
	"PREVIEW_PICTURE_MAX_HEIGHT" => Array(
		"NAME" => GetMessage("PREVIEW_PICTURE_MAX_HEIGHT"),
		"TYPE" => "STRING",
		"DEFAULT" => 300,
	),
	"DETAIL_PICTURE_MAX_WIDTH" => Array(
		"NAME" => GetMessage("DETAIL_PICTURE_MAX_WIDTH"),
		"TYPE" => "STRING",
		"DEFAULT" => 400,
	),
	"DETAIL_PICTURE_MAX_HEIGHT" => Array(
		"NAME" => GetMessage("DETAIL_PICTURE_MAX_HEIGHT"),
		"TYPE" => "STRING",
		"DEFAULT" => 300,
	),
);
?>
