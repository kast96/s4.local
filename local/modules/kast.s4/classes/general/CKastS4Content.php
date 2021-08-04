<?
use Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loader::includeModule('iblock');

Loc::loadMessages(__FILE__);

class CKastS4Content {
	public static function GetItemPrice($itemId) {
		//measures
		$rsMeasure = CCatalogMeasure::getList();
		while($arMeasure = $rsMeasure->GetNext()){
			$arMeasures[$arMeasure['ID']] = $arMeasure;
		}

		//price
		$arItem['PRICE'] = CCatalogProduct::GetOptimalPrice($itemId);
		$arItem['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED'] = CCurrencyLang::CurrencyFormat($arItem['PRICE']['RESULT_PRICE']['BASE_PRICE'], $arItem['PRICE']['RESULT_PRICE']['CURRENCY']);
		$arItem['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE_FORMATTED'] = CCurrencyLang::CurrencyFormat($arItem['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE'], $arItem['PRICE']['RESULT_PRICE']['CURRENCY']);

		//product
		$arItem['PRODUCT'] = CCatalogProduct::GetById($itemId);
		$arItem['PRODUCT']['MEASURE'] = $arMeasures[$arItem['PRODUCT']['MEASURE']];

		//current price
		$price = ($arItem['PRICE']['RESULT_PRICE']['DISCOUNT']) ? $arItem['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE_FORMATTED'] : $arItem['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED'];

		//return
		$str = '<div class="price">';
			if($arItem['PRICE']['RESULT_PRICE']['DISCOUNT']) {
				$str .= '<span class="price-name">';
					$str .= Loc::getMessage('KAST_S4_CONTENT_YOUR_PRICE');
					$str .= '<a href="javascript:;" class="price-tooltip tooltip js-tooltip" rel="nofollow" data-tooltip-class="tooltip-popup">';
						$str .= '<i class="tooltip-icon las la-question-circle"></i>';
						$str .= '<span class="tooltip-info js-tooltip-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.</span>';
						$str .= '</a>';
				$str .= '</span>';
			}

			$str .= '<ul class="price-list">';
				$str .= '<li class="price-item">';
					$str .= '<span class="price-block">';
						$str .= '<span class="price-value">'.$price.'</span> / '.$arItem['PRODUCT']['MEASURE']['SYMBOL'];
					$str .= '</span>';
				$str .= '</li>';
				if($arItem['PRICE']['RESULT_PRICE']['DISCOUNT']) {
					$str .= '<li class="price-item">';
						$str .= '<span class="price-add-value">'.$arItem['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED'].'</span> / '.$arItem['PRODUCT']['MEASURE']['SYMBOL'];
						$str .= '<span class="product-discount discount">';
							$str .= '<span class="discount-val">- '.$arItem['PRICE']['RESULT_PRICE']['DISCOUNT'].'</span>';
						$str .= '</span>';
					$str .= '</li>';
				}
			$str .= '</ul>';

		$str .= '</div>';
		return $str;
	}

	public static function GetItemRating($itemId, $iblockId) {
		$arItem['REVIEWS'] = array(
			'RATING' => 0,
			'COUNT' => 0,
			'PRECENT' => 0,
		);

		$rsReviews = CIBlockElement::GetList(array(), array('IBLOCK_CODE' => 'reviews', 'PROERTY_OBJECT' => $iblockId, 'PROPERTY_ENTITY' => $itemId, 'ACTIVE' => 'Y', '>PROPERTY_RATING' => 0, '<PROPERTY_RATING' => 6), false, false, array('ID', 'IBLOCK_ID', 'PROPERTY_RATING'));
		while($arReview = $rsReviews->Fetch()) {
			$arItem['REVIEWS']['RATING'] += intVal($arReview['PROPERTY_RATING_VALUE']);
			$arItem['REVIEWS']['COUNT']++;
		}
		if($arItem['REVIEWS']['COUNT']) {
			$arItem['REVIEWS']['RATING'] = round($arItem['REVIEWS']['RATING']/$arItem['REVIEWS']['COUNT'], 1);
			$arItem['REVIEWS']['PRECENT'] = $arItem['REVIEWS']['RATING'] / 5 * 100;
		}
		$arItem['REVIEWS']['RATING_FORMATTED'] = str_replace('.', ',', $arItem['REVIEWS']['RATING']);

		$str = '<span class="product-rating">';
			$str .= '<a class="rating'.($arItem['REVIEWS']['RATING'] ? ' rating_active' : '').'" href="'.$arItem['DETAIL_PAGE_URL'].'">';
				$str .= '<span class="product-rating-track rating-track">';
					$str .= '<span class="rating-indicate" style="width: '.$arItem['REVIEWS']['PRECENT'].'%;"></span>';
				$str .= '</span>';
				$str .= '<span class="rating-value">';
					$str .= '<i class="rating-icon lar la-star"></i>'.$arItem['REVIEWS']['RATING_FORMATTED'].' <span class="product-rating-max">'.Loc::getMessage('OF').' 5</span>';
				$str .= '</span>';
			$str .= '</a>';
		$str .= '</span>';
		return $str;
	}
}