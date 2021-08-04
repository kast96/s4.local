<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::includeModule('kast.s4');
$arResult = CKastS4::GetChilds($arResult);

//select section
foreach ($arResult as $arItem) {
    if ($arItem['PARAMS']['UF_FIELDS']['UF_VIEW_IN_MENU'] == 1) {
        $arResult = $arItem['CHILD'];
        break;
    }
}