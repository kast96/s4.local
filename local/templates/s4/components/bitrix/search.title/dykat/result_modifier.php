<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

Loader::includeSharewareModule('ewp.dykat');
Loader::includeModule('iblock');
Loader::includeModule('catalog');
Loader::includeModule('sale');
Loader::includeModule('highloadblock');

$arAjaxParams = $_REQUEST['PARAMS'];

if ($$arAjaxParams['MAX_VIEW_WORDS'] < 0)
	$$arAjaxParams['MAX_VIEW_WORDS'] = 10;

if ($$arAjaxParams['MAX_VIEW_CATEGORIES'] < 0)
	$$arAjaxParams['MAX_VIEW_CATEGORIES'] = 10;

if ($$arAjaxParams['MAX_VIEW_RESULTS'] < 0)
	$$arAjaxParams['MAX_VIEW_RESULTS'] = 4;

if ($$arAjaxParams['MAX_VIEW_BRANDS'] < 0)
	$$arAjaxParams['MAX_VIEW_BRANDS'] = 4;

//group by selected category
$arResult['INPUT_CATEGORY_ID'] = $_REQUEST['INPUT_CATEGORY_ID'];
if(!$arResult['INPUT_CATEGORY_ID'])
	$arResult['INPUT_CATEGORY_ID'] == 'all';

if($arResult['INPUT_CATEGORY_ID'] == 'all') {
	$arResult['CURRENT_CATEGORY']['ITEMS'] = array();
	foreach($arResult['CATEGORIES'] as $key => $arCategory) {
		if ((string)$key == 'all') continue;
		if (is_array($arCategory['ITEMS'])) {
			$arResult['CURRENT_CATEGORY']['ITEMS'] = $arResult['CURRENT_CATEGORY']['ITEMS'] + $arCategory['ITEMS'];
		}
	}
} else {
	$arResult['CURRENT_CATEGORY'] = $arResult['CATEGORIES'][$_REQUEST['INPUT_CATEGORY_ID']];
}

//remove result sections
foreach ($arResult['CURRENT_CATEGORY']['ITEMS'] as $key => $arItem) {
	if (!is_numeric($arItem['ITEM_ID'])) {
		unset($arResult['CURRENT_CATEGORY']['ITEMS'][$key]);
		continue;
	}
}

//total items
$arResult['TOTAL']['ITEMS'] = array_slice($arResult['CURRENT_CATEGORY']['ITEMS'], 0, $arParams['MAX_VIEW_RESULTS']);
foreach ($arResult['TOTAL']['ITEMS'] as &$arItem) {
	if ($arItem['PARAM2'] == $arParams['CATALOG_IBLOCK_ID']) {
		//catalog iblock item
		$arItem['FIELDS'] = CIBlockElement::GetList(array(), array('ID' => $arItem['ITEM_ID']), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL'))->GetNext();
	} else {
		//other iblocks item
		$arItem['FIELDS'] = CIBlockElement::GetList(array(), array('ID' => $arItem['ITEM_ID']), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL'))->GetNext();
	}
}
unset($arItem);

//total sections
foreach ($arResult['CURRENT_CATEGORY']['ITEMS'] as $arItem) {
	if ($arItem['PARAM2'] == $arParams['CATALOG_IBLOCK_ID']) {
		$arCatalogItemsIds[] = $arItem['ITEM_ID'];
	}
}
if ($arCatalogItemsIds) {
	$rsElements = CIBlockElement::GetList(array(), array('ID' => $arCatalogItemsIds, 'IBLOCK_ID' => $arItem['PARAM2'], 'ACTIVE' => 'Y'), false, array('nTopCount' => $arParams['MAX_VIEW_CATEGORIES']), array('ID', 'IBLOCK_SECTION_ID'));

	while ($arElement = $rsElements->Fetch()) {
		if (!$arSectionsIds['IBLOCK_SECTION_ID']) {
			$arSectionsIds[$arElement['IBLOCK_SECTION_ID']] = $arElement['IBLOCK_SECTION_ID'];
		}
	}

	if ($arSectionsIds) {
		$rsSections = CIBlockSection::GetList(array(), array('ID' => $arSectionsIds, 'ACTIVE' => 'Y'), false, array('ID', 'NAME', 'SECTION_PAGE_URL'));
		while ($arSection = $rsSections->GetNext()) {
			$arResult['TOTAL']['SECTIONS'][$arSection['ID']] = $arSection;
		}
	}
}

//total brands
foreach ($arResult['CURRENT_CATEGORY']['ITEMS'] as $arItem) {
	if ($arItem['PARAM2'] == $arParams['CATALOG_IBLOCK_ID']) {
		$arElement = CIBlockElement::GetList(array(), array('ID' => $arItem['ITEM_ID'], 'IBLOCK_ID' => $arItem['PARAM2']), false, false, array('ID', 'IBLOCK_ID', 'PROPERTY_BRAND'))->Fetch();
		if ($arElement['PROPERTY_BRAND_VALUE']) {
			if (!$arBrands[$arElement['PROPERTY_BRAND_VALUE']]) {
				$arBrands[$arElement['PROPERTY_BRAND_VALUE']] = 0;
			}
			$arBrands[$arElement['PROPERTY_BRAND_VALUE']]++;
		}
	}
}
if ($arBrands) {
	$rsBrands = CIBlockElement::GetList(array(), array('ID' => array_keys($arBrands), 'IBLOCK_ID' => $arParams['BRANDS_IBLOCK_ID']), false, false, array('ID', 'IBLOCK_ID', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL'));
	while ($arBrand = $rsBrands->GetNext()) {
		$arResult['TOTAL']['BRANDS'][$arBrand['ID']] = $arBrand;
	}
	$arResult['TOTAL']['BRANDS'] = array_slice($arResult['TOTAL']['BRANDS'], 0, $arParams['MAX_VIEW_BRANDS']);
}

//total words
$hlblock = HL\HighloadBlockTable::getById(2)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entityClass = $entity->getDataClass();

$rsWords = $entityClass::getList(array(
	'select' => array('*'),
	'filter' => array('%UF_WORD' => $arResult['query'])
));

$queryLen = mb_strlen($arResult['query']);
while($arWord = $rsWords->fetch()) {
	$arResult['TOTAL']['WORDS'][] = array(
		'WORD' => $arWord['UF_WORD'],
		'TEXT' => '<b>' . mb_substr($arWord['UF_WORD'], 0, $queryLen) . '</b>' . mb_substr($arWord['UF_WORD'], $queryLen),
	);
}
$arResult['TOTAL']['WORDS'] = array_slice($arResult['TOTAL']['WORDS'], 0, $arParams['MAX_VIEW_WORDS']);