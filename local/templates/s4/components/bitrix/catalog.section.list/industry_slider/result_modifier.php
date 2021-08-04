<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::includeModule('ewp.dykat');

//select section
foreach ($arResult['SECTIONS'] as &$arSection) {
    $arSection['SUBSECTIONS'] = CEwpDykatCache::CIBlockSection_GetList(array('TAG' => 'industry_slider'), array(), array('SECTION_ID' => $arSection['ID'], 'ACTIVE' => 'Y', 'IBLOCK_ID' => $arSection['IBLOCK_ID']), false, array('ID', 'NAME', 'SECTION_PAGE_URL'));
}
unset($arSection);

//color
$arColors = array('peach', 'green', 'blue', 'orange', 'lightgreen', 'lightblue');
$arColorsCount = count($arColors);
foreach($arResult['SECTIONS'] as $key => &$arSection) {
    $arSection['COLOR'] = $arColors[$key % $arColorsCount];
}
unset($arSection);