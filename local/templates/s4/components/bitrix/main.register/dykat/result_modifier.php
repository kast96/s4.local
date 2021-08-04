<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$keys = array_flip($arParams['SORT_FIELDS']);

usort($arResult["SHOW_FIELDS"], function ($a, $b) use ($keys) {
    return $keys[$a] > $keys[$b] ? 1 : -1;
});