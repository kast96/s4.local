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

//banner
foreach ($arResult as &$arItem) {
    if($arItem['PARAMS']['UF_FIELDS']['UF_MENU_BANNER'] && $arItem['PARAMS']['IBLOCK_ID']){
        $arUFMenuBanner = current(CEwpDykatCache::CUserTypeEntity_GetList(
            array('TAG' => 'catalog_menu_banner'),
            array(),
            array('ENTITY_ID' => 'IBLOCK_'.$arItem['PARAMS']['IBLOCK_ID'].'_SECTION', 'XML_ID' => 'UF_MENU_BANNER')
        ));

        if (!$arUFMenuBanner)
            continue;

        $arItem['BANNER'] = current(CEwpDykatCache::CIBlockElement_GetList(
            array('TAG' => 'catalog_menu_banner'),
            array(),
            array('IBLOCK_ID' => $arUFMenuBanner['SETTINGS']['IBLOCK_ID'], 'ID' => $arItem['PARAMS']['UF_FIELDS']['UF_MENU_BANNER'], 'ACTIVE' => 'Y'),
            false,
            array('nTopCount' => 1),
            array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'PROPERTY_LINK')
        ));
    }
}
unset($arItem);