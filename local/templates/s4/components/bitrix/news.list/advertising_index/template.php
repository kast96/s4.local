<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;
?>

<?if ($arResult['VERTICAL_ITEM']):?>
	<div class="advertising-side col-md-4">
		<a href="<?=($arResult['VERTICAL_ITEM']['PRODUCT']['DETAIL_PAGE_URL']) ?: $arResult['VERTICAL_ITEM']['PROPERTIES']['LINK']['VALUE']?>" class="banner banner_wide block-simple more-item">
		<span class="banner-content">
			<span class="banner-text">
				<span class="banner-title"><?=$arResult['VERTICAL_ITEM']['NAME']?></span>
					<?if($arResult['VERTICAL_ITEM']['PRODUCT']['PRICE']):?>
						<span class="banner-product-price">
							<?if($arResult['VERTICAL_ITEM']['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']):?>
								<del class="banner-product-price-old"><?=$arResult['VERTICAL_ITEM']['PRODUCT']['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED']?></del>
							<?endif?>
							<span class="banner-product-price-val"><?=($arResult['VERTICAL_ITEM']['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']) ? $arResult['VERTICAL_ITEM']['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE_FORMATTED'] : $arResult['VERTICAL_ITEM']['PRODUCT']['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED']?></span>
							<?if($arResult['VERTICAL_ITEM']['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']):?>
								<span class="discount">
									<span class="discount-val">- <?=$arResult['VERTICAL_ITEM']['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']?></span>
								</span>
							<?endif?>
						</span>
					<?else:?>
						<span class="banner-description"><?=$arResult['VERTICAL_ITEM']['PREVIEW_TEXT']?></span>
					<?endif?>
				</span>
				<img class="banner-img" src="<?=CFile::GetPath($arResult['VERTICAL_ITEM']['PROPERTIES']['VERTICAL_IMG']['VALUE'])?>" alt="<?=$arResult['VERTICAL_ITEM']['NAME']?>" />
				<span class="banner-more more-link more-link_narrow button">
					<span class="more-label">Подробнее</span>
					<span class="more"><i class="more-icon las la-arrow-right"></i></span>
				</span>
			</span>
		</a>
	</div>
<?endif?>
<div class="col-md-8">
	<?foreach ($arResult['ITEMS'] as $key => $arItem):?>
		<a href="<?=($arItem['PRODUCT']['DETAIL_PAGE_URL']) ?: $arItem['PROPERTIES']['LINK']['VALUE']?>" class="banner-product block-simple more-item<?=($key % 2 == 0)?' banner-product_simple':''?>">
			<span class="banner-product-content">
				<span class="banner-product-info">
					<span class="banner-product-name"><?=$arItem['NAME']?></span>
					<?if($arItem['PRODUCT']['PRICE']):?>
						<span class="banner-product-price">
							<?if($arItem['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']):?>
								<del class="banner-product-price-old"><?=$arItem['PRODUCT']['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED']?></del>
							<?endif?>
							<span class="banner-product-price-val"><?=($arItem['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']) ? $arItem['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE_FORMATTED'] : $arItem['PRODUCT']['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED']?></span>
							<?if($arItem['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']):?>
								<span class="discount">
									<span class="discount-val">- <?=$arItem['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']?></span>
								</span>
							<?endif?>
						</span>
					<?else:?>
						<span class="banner-description"><?=$arItem['PREVIEW_TEXT']?></span>
					<?endif?>
					<span class="banner-product-more more-link more-link_narrow button">
						<span class="more-label"><?=Loc::getMessage('DETAILS')?></span>
						<span class="more"><i class="more-icon las la-arrow-right"></i></span>
					</span>
				</span>
				<span class="banner-product-img">
					<picture class="banner-product-picture">
						<source media="(max-width: 720px)" srcset="<?=CFile::GetPath($arItem['PROPERTIES']['VERTICAL_IMG']['VALUE'])?>" />
						<img class="banner-product-picture-value" src="<?=CFile::GetPath($arItem['PROPERTIES']['GORIZONTAL_IMG']['VALUE'])?>" alt="<?=$arItem['NAME']?>" />
					</picture>
				</span>
			</span>
		</a>
	<?endforeach?>
</div>