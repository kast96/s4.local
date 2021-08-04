<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use \Bitrix\Main\Localization\Loc;

Loader::includeSharewareModule('ewp.dykat');

$this->setFrameMode(true);

$arFilter['IBLOCK_ID'] = $arParams["IBLOCK_ID"];
if ($arResult["VARIABLES"]["SECTION_ID"]) {
	$arFilter['ID'] = $arResult["VARIABLES"]["SECTION_ID"];
} else if ($arResult["VARIABLES"]["SECTION_CODE"]) {
	$arFilter['CODE'] = $arResult["VARIABLES"]["SECTION_CODE"];
} else {
	return;
}

$arCurSection = current(CEwpDykatCache::CIblockSection_GetList(array('TAG' => 'catalog_section'), array(), $arFilter, array('nTopCount' => 1), array('ID', 'IBLOCK_ID', 'NAME', 'UF_DESCRIPTION')));
?>

<div class="catalog-panel">
	<h1 class="catalog-title"><?$APPLICATION->ShowTitle(false)?></h1>
	<span class="catalog-amount"><?$APPLICATION->ShowViewContent('items-count')?> <?=Loc::getMessage('PRODUCTS')?></span>
	<div class="catalog-panel-actions">
		<ul class="catalog-actions">
			<li class="catalog-actions-item">
				<a class="catalog-actions-button button button_simple js-popup-comment" href="javascript:;" data-src="/ajax/question.php">
					<i class="catalog-actions-button-icon catalog-actions-icon las la-question-circle"></i>
					<span class="catalog-actions-button-name"><?=Loc::getMessage('ASK_QUESTION')?></span>
				</a>
			</li>
			<li class="catalog-actions-item catalog-actions-item_print js-tooltip-simple-links"
				data-tooltip-class="tooltip-popup tooltip-popup_links">
				<a class="catalog-actions-link" href="#">
					<i class="catalog-actions-icon las la-print"></i>
				</a>
				<span class="links-simple-tooltip js-tooltip-content"><?=Loc::getMessage('PRINT')?></span>
			</li>
			<li class="catalog-actions-item js-tooltip-simple-links"
				data-tooltip-class="tooltip-popup tooltip-popup_links">
				<a class="catalog-actions-link" href="#">
					<i class="catalog-actions-icon las la-download"></i>
				</a>
				<span class="links-simple-tooltip js-tooltip-content"><?=Loc::getMessage('DOWNLOAD')?></span>
			</li>
		</ul>
	</div>
</div>

<?
$sectionListParams = array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
	"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
	"TOP_DEPTH" => 1,
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
	"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
	"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
	"ADD_SECTIONS_CHAIN" => "N",
);

if ($sectionListParams["COUNT_ELEMENTS"] === "Y")
{
	$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
	if ($arParams["HIDE_NOT_AVAILABLE"] == "Y")
	{
		$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
	}
}

$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"section",
	$sectionListParams,
	$component,
	($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "Y") : array())
);

unset($sectionListParams);
?>

<div class="catalog-info"><?=$arCurSection['UF_DESCRIPTION']?></div>

<div class="catalog-selection">
    <div class="catalog-selection-item catalog-selection-item_sort">
        <div class="catalog-select-sort">
            <form>
                <select name="products-sort" class="js-select-sort">
                    <option class="catalog-selection-option catalog-selection-option_top" value="param-1">Цена по возрастанию</option>
                    <option class="catalog-selection-option catalog-selection-option_bottom" value="param-2">Цена по убыванию</option>
                    <option class="catalog-selection-option catalog-selection-option_bottom" value="param-3">Популярность по убыванию</option>
                    <option class="catalog-selection-option catalog-selection-option_top" value="param-4">Популярность по возрастанию</option>
                    <option class="catalog-selection-option catalog-selection-option_bottom" value="param-5" selected="selected">Рейтинг по убыванию</option>
                    <option class="catalog-selection-option catalog-selection-option_top" value="param-6">Рейтинг по возрастанию</option>
                    <option value="param-7">По дате добавления</option>
                </select>
            </form>
        </div>
    </div>
    <div class="catalog-selection-item catalog-selection-item_mas">
        <div class="catalog-select-sort">
            <form>
                <select name="mas" class="select js-select">
                    <option selected="selected">Масса</option>
                    <option value="param-1">Значение 1</option>
                    <option value="param-2">Значение 2</option>
                    <option value="param-3">Значение 3</option>
                    <option value="param-4">Значение 4</option>
                </select>
            </form>
        </div>
    </div>
    <div class="catalog-selection-item catalog-selection-item_filter">
        <div class="catalog-select-sort">
            <form>
                <select name="filter" class="select js-select">
                    <option selected="selected">Название фильтра</option>
                    <option value="param-1">Значение 1</option>
                    <option value="param-2">Значение 2</option>
                    <option value="param-3">Значение 3</option>
                    <option value="param-4">Значение 4</option>
                </select>
            </form>
        </div>
    </div>
    <div class="catalog-selection-item">
        <div class="catalog-selection-view">
            <ul class="view">
                <li class="view-item view-item_active">
                    <a href="#" rel="nofollow">
                        <i class="view-icon">
                            <svg>
                                <use xlink:href="#tile-catalog-icon"></use>
                            </svg>
                        </i>
                    </a>
                </li>
                <li class="view-item">
                    <a href="#" rel="nofollow">
                        <i class="view-icon view-icon_list">
                            <svg>
                                <use xlink:href="#list-catalog-icon"></use>
                            </svg>
                        </i>
                    </a>
                </li>
                <li class="view-item">
                    <a href="#" rel="nofollow">
                        <i class="view-icon view-icon_list">
                            <svg>
                                <use xlink:href="#list-simple-catalog-icon"></use>
                            </svg>
                        </i>
                    </a>
                </li>
            </ul>

            <div class="filter-form mob-form JS-PopupFilter" data-mobilemenu="{
                'classActive': 'open',
                'classShow': 'mob-form-show',
                'classElementActive': 'mob-form_active'
            }">
                <a class="catalog-filters-link button button_dark JS-MobileMenu-Burger" href="javascript:;">
                    <i class="catalog-filters-link-icon las la-sliders-h"></i>
                    <span class="catalog-filters-link-all">Все</span> фильтры
                </a>
                <div class="filter-form-block mob-form-block js-find JS-MobileMenu-Dropdown"
                    data-find-hide="filter-list-item_hide">
                    <div class="mob-form-close-panel mob-form-container">
                        <span class="mob-form-close-title">Фильтр</span>
                        <div class="filter-search">
                            <div class="js-search" data-search-dynamic="search_dynamic">
                                <form class="search-form">
                                    <div class="search-container">
                                        <input class="search-input input js-search-input js-find-input" type="text" placeholder="" />
                                        <a class="search-reset search-item js-search-reset" href="javascript:;">
                                            <i class="search-reset-icon las la-times"></i>
                                        </a>
                                        <a class="search-microphone" href="javascript:;">
											<i class="las la-microphone"></i>
										</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a href="javascript:;" class="mob-form-close JS-MobileMenu-Close">
							<i class="mob-form-close-icon las la-times"></i>
						</a>
                    </div>
                    
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:catalog.smart.filter",
						"main",
						array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"SECTION_ID" => $arCurSection['ID'],
							"FILTER_NAME" => $arParams["FILTER_NAME"],
							"PRICE_CODE" => $arParams["~PRICE_CODE"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							"SAVE_IN_SESSION" => "N",
							"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
							"XML_EXPORT" => "N",
							"SECTION_TITLE" => "NAME",
							"SECTION_DESCRIPTION" => "DESCRIPTION",
							'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
							"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
							'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
							'CURRENCY_ID' => $arParams['CURRENCY_ID'],
							"SEF_MODE" => $arParams["SEF_MODE"],
							"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
							"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
							"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
							"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
							"DISPLAY_ELEMENT_COUNT" => "Y",
						),
						$component,
						array('HIDE_ICONS' => 'Y')
					);
					?>
                </div>
                <div class="mob-form-decor JS-MobileMenu-Close"></div>
            </div>

            <!-- Если фильтры не выбраны, добавить класс filter-result-reset_disabled -->
            <a class="filter-result-reset filter-result-reset-mob switcher" href="javascript:;" rel="nofollow">Сброс</a>

        </div>
    </div>
</div>

<div class="filter-result">
	<ul class="filter-result-list">
		<li class="filter-result-item"><a class="filter-result-link" href="#" rel="nofollow">Кондитерская<i class="filter-result-icon las la-times"></i></a></li>
		<li class="filter-result-item"><a class="filter-result-link" href="#" rel="nofollow">Кремы для взбивания<i class="filter-result-icon las la-times"></i></a></li>
	</ul>
	<!-- Если фильтры не выбраны, добавить класс filter-result-reset_disabled -->
	<a class="filter-result-reset switcher" href="#" rel="nofollow">Сбросить</a>
</div>

<?
$intSectionID = $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"main",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
		"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
		"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["~MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => $arParams["~PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
		"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
		"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"LAZY_LOAD" => $arParams["LAZY_LOAD"],
		"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
		"LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

		"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
		"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
		'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

		'LABEL_PROP' => $arParams['LABEL_PROP'],
		'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
		'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
		'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
		'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
		'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
		'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
		'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
		'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
		'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
		'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

		'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
		'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
		'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
		'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
		'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
		'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
		'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
		'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
		'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
		'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
		'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
		'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
		'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
		'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
		'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
		'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

		'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
		'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
		'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

		'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
		"ADD_SECTIONS_CHAIN" => $arParams['ADD_SECTIONS_CHAIN'],
		'ADD_TO_BASKET_ACTION' => $basketAction,
		'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
		'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
		'COMPARE_NAME' => $arParams['COMPARE_NAME'],
		'USE_COMPARE_LIST' => 'Y',
		'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
		'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
		'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
	),
	$component
);
?>