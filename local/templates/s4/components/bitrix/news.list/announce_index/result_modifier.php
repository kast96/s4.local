<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;

Loader::includeSharewareModule('ewp.dykat');

$commentsIblock = CEwpDykat::GetOption('comments_iblock');

foreach ($arResult['ITEMS'] as &$arItem) {
    if (!$arItem['CREATED_BY']) continue;

    $arResult['USER'] = current(CEwpDykatCache::CUser_GetList(array('TAG' => 'announce_index'), ($by = "NAME"), ($order = "desc"), array('ID' => $arItem['CREATED_BY'])));
}
unset($arItem);

foreach ($arResult['ITEMS'] as &$arItem) {
    //likes
    $arItem['LIKES'] = CEwpDykat::GetLikesGroup(array('UF_OBJECT' => 'IBLOCK_'.$arResult['ID'], 'UF_ENTITY' => $arItem['ID']));

    //reviews
    if ($commentsIblock) {
        $rsReviews = CIblockElement::GetList(array(), array('IBLOCK_ID' => $commentsIblock, 'PROPERTY_OBJECT' => 'IBLOCK_'.$arResult['ID'], 'PROPERTY_ENTITY' => $arItem['ID'], 'ACTIVE' => 'Y'), false, false, array('ID'));
        $arItem['REVIEWS']['COUNT'] = $rsReviews->SelectedRowsCount();
    }
}
unset($arItem);