<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult['SITES'] as &$arSite) {
    if ($arParams['REPLACE_NAMES'][$arSite['LID']]) {
        $arSite['NAME'] = $arParams['REPLACE_NAMES'][$arSite['LID']];
    }
}
unset($arSite);
