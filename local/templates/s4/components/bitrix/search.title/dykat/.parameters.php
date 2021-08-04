<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::includeModule('iblock');
$rsIBlocks = CIBlock::GetList(array('NAME' => 'ASC'), array());
while($arIBlock = $rsIBlocks->Fetch()) {
	$arIblocks[$arIBlock['ID']] = '['.$arIBlock['ID'].'] '.$arIBlock['NAME'];
}

$arTemplateParameters = array(
	"SHOW_INPUT" => array(
		"NAME" => GetMessage("TP_BST_SHOW_INPUT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
		"REFRESH" => "Y",
	),
	"INPUT_ID" => array(
		"NAME" => GetMessage("TP_BST_INPUT_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => "title-search-input",
	),
	"CONTAINER_ID" => array(
		"NAME" => GetMessage("TP_BST_CONTAINER_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => "title-search",
	),
	"CATALOG_IBLOCK_ID" => array(
		"NAME" => GetMessage("TP_BST_CATALOG_IBLOCK_ID"),
		"TYPE" => "LIST",
		"VALUES" => $arIblocks,
	),
	"BRANDS_IBLOCK_ID" => array(
		"NAME" => GetMessage("TP_BST_BRANDS_IBLOCK_ID"),
		"TYPE" => "LIST",
		"VALUES" => $arIblocks,
	),
	"MAX_VIEW_WORDS" => array(
		"NAME" => GetMessage("TP_BST_MAX_VIEW_WORDS"),
		"TYPE" => "STRING",
	),
	"MAX_VIEW_CATEGORIES" => array(
		"NAME" => GetMessage("TP_BST_MAX_VIEW_CATEGORIES"),
		"TYPE" => "STRING",
	),
	"MAX_VIEW_RESULTS" => array(
		"NAME" => GetMessage("TP_BST_MAX_VIEW_RESULTS"),
		"TYPE" => "STRING",
	),
	"MAX_VIEW_BRANDS" => array(
		"NAME" => GetMessage("TP_BST_MAX_VIEW_BRANDS"),
		"TYPE" => "STRING",
	),
);
?>
