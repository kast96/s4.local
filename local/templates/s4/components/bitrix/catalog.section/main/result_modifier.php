<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

CModule::IncludeModule('iblock');
CModule::IncludeModule('highloadblock');

//stickers
foreach ($arResult['ITEMS'] as &$arItem) {
    $hlblock = HL\HighloadBlockTable::getList(array(
        'filter' => array('TABLE_NAME' => $arItem['PROPERTIES']['STICKERS']['USER_TYPE_SETTINGS']['TABLE_NAME'])
    ))->fetch();
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entityClass = $entity->getDataClass();

    $rsStickers = $entityClass::getList(array(
        'select' => array('*'),
        'filter' => array('UF_XML_ID' => $arItem['PROPERTIES']['STICKERS']['VALUE']),
    ));

    while($arSticker = $rsStickers->fetch()) {
        $arItem['STICKERS'][$arSticker['ID']] = $arSticker;
    }
}
unset($arItem);

//advertising
if ($arResult['NAV_RESULT']->NavPageNomer == 1) {
    $obAdvertising = CIBlockElement::GetList(array(), array('IBLOCK_CODE' => 'advertising_catalog', 'PROPERTY_SECTION' => $arResult['ID'], 'ACTIVE' => 'Y'), false, array('nTopCount' => 1), array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_*'))->GetNextElement();
    if($obAdvertising) {
        $arAdvertising = $obAdvertising->GetFields();
        $arAdvertising['PROPERTIES'] = $obAdvertising->GetProperties();

        if ($arAdvertising['PROPERTIES']['TYPE']['VALUE_XML_ID'] == 'PRODUCT' && $arAdvertising['PROPERTIES']['PRODUCT']['VALUE']) {
            $arAdvertising['PRODUCT'] = current(CEwpDykatCache::CIBlockElement_GetList(array('TAG' => 'advertising_catalog'), array(), array('ID' => $arAdvertising['PROPERTIES']['PRODUCT']['VALUE'], 'IBLOCK_ID' => $arAdvertising['PROPERTIES']['PRODUCT']['LINK_IBLOCK_ID']), false, false, array('ID', 'DETAIL_PAGE_URL')));
            if ($arAdvertising['PRODUCT']) {
                $arAdvertising['PRODUCT']['PRICE'] = CCatalogProduct::GetOptimalPrice($arAdvertising['PRODUCT']['ID']);
                $arAdvertising['PRODUCT']['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED'] = CCurrencyLang::CurrencyFormat($arAdvertising['PRODUCT']['PRICE']['RESULT_PRICE']['BASE_PRICE'], $arAdvertising['PRODUCT']['PRICE']['RESULT_PRICE']['CURRENCY']);
                $arAdvertising['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE_FORMATTED'] = CCurrencyLang::CurrencyFormat($arAdvertising['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE'], $arAdvertising['PRODUCT']['PRICE']['RESULT_PRICE']['CURRENCY']);
            }
        }
    }
    $arResult['ADVERTISING'] = $arAdvertising;
}

$this->SetViewTarget('items-count');
    echo $arResult['NAV_RESULT']->NavRecordCount;
$this->EndViewTarget();