<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::includeModule('ewp.dykat');

$arResult['SECTIONS'] = CEwpDykat::GetChilds($arResult['SECTIONS']);

foreach ($arResult['SECTIONS'] as &$arSection) {
    $arSectionData = current(CEwpDykatCache::CIBlockSection_GetList(array('TAG' => 'catalog'), array(), array('ID' => $arSection['ID'], 'IBLOCK_ID' => $arSection['IBLOCK_ID']), array('nTopCount' => 1), array('ID', 'NAME', 'UF_SORT_BY_CATEGORY_NAME')));
    $arSection['UF_SORT_BY_CATEGORY_NAME'] = $arSectionData['UF_SORT_BY_CATEGORY_NAME'];
}
unset($arSection);