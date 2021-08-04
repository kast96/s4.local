<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult['SITES'] as &$arSite) {
    if ($arParams['REPLACE_NAMES'][$arSite['LID']]) {
        $arSite['NAME'] = $arParams['REPLACE_NAMES'][$arSite['LID']];
    }
}
unset($arSite);

foreach ($arResult['SITES'] as $key => $arSite) {
    if ($arSite['CURRENT'] == 'Y') {
        $arResult['CURRENT_SITE'] = $arSite;
        unset($arResult['SITES'][$key]);
    }
}

