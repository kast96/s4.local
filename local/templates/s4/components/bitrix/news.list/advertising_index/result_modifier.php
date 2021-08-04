<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;

Loader::includeSharewareModule('ewp.dykat');

foreach ($arResult['ITEMS'] as &$arItem) {
    if ($arItem['PROPERTIES']['TYPE']['VALUE_XML_ID'] == 'PRODUCT' && $arItem['PROPERTIES']['PRODUCT']['VALUE']) {
        $arItem['PRODUCT'] = current(CEwpDykatCache::CIBlockElement_GetList(array('TAG' => 'advertising_index'), array(), array('ID' => $arItem['PROPERTIES']['PRODUCT']['VALUE'], 'IBLOCK_ID' => $arItem['PROPERTIES']['PRODUCT']['LINK_IBLOCK_ID']), false, false, array('ID', 'DETAIL_PAGE_URL')));
        if (!$arItem['PRODUCT']) continue;
        $arItem['PRODUCT']['PRICE'] = CCatalogProduct::GetOptimalPrice($arItem['PRODUCT']['ID']);
        $arItem['PRODUCT']['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED'] = CCurrencyLang::CurrencyFormat($arItem['PRODUCT']['PRICE']['RESULT_PRICE']['BASE_PRICE'], $arItem['PRODUCT']['PRICE']['RESULT_PRICE']['CURRENCY']);
		$arItem['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE_FORMATTED'] = CCurrencyLang::CurrencyFormat($arItem['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE'], $arItem['PRODUCT']['PRICE']['RESULT_PRICE']['CURRENCY']);
    }
}

$arResult['VERTICAL_ITEM'] = array_shift($arResult['ITEMS']);