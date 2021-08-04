<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::includeModule('kast.s4');
$arResult = CKastS4::GetChilds($arResult);