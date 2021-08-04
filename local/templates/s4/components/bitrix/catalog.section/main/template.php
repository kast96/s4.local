<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loader::includeSharewareModule('ewp.dykat');
?>

<?if ($arResult['ITEMS']):?>
	<div class="catalog-container js-pagen">
		<div class="catalog-list row js-pagen-content">
			<?foreach ($arResult['ITEMS'] as $key => $arItem):?>
				<?if($arResult['ADVERTISING'] && $key == 8):?>
					<div class="catalog-list-item catalog-list-item_banner col-12">
						<a href="<?=($arResult['ADVERTISING']['PRODUCT']['DETAIL_PAGE_URL']) ?: $arResult['ADVERTISING']['PROPERTIES']['LINK']['VALUE']?>" class="catalog-banner block-simple more-item">
							<span class="catalog-banner-content">
								<span class="catalog-banner-info">
									<span class="catalog-banner-name"><?=$arResult['ADVERTISING']['NAME']?></span>
									<?if($arResult['ADVERTISING']['PRODUCT']['PRICE']):?>
										<span class="catalog-banner-price">
											<?if($arResult['ADVERTISING']['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']):?>
												<del class="catalog-banner-price-old"><?=$arResult['ADVERTISING']['PRODUCT']['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED']?></del>
											<?endif?>
											<span class="catalog-banner-price-val"><?=($arResult['ADVERTISING']['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']) ? $arResult['ADVERTISING']['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE_FORMATTED'] : $arResult['ADVERTISING']['PRODUCT']['PRICE']['RESULT_PRICE']['BASE_PRICE_FORMATTED']?></span>
											<?if($arResult['ADVERTISING']['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']):?>
												<span class="discount">
													<span class="discount-val">- <?=$arResult['ADVERTISING']['PRODUCT']['PRICE']['RESULT_PRICE']['DISCOUNT']?></span>
												</span>
											<?endif?>
										</span>
									<?else:?>
										<span class="banner-description"><?=$arResult['ADVERTISING']['PREVIEW_TEXT']?></span>
									<?endif?>
									<span class="catalog-banner-more more-link more-link_narrow button">
										<span class="more-label"><?=Loc::getMessage('DETAILS')?></span>
										<span class="more"><i class="more-icon las la-arrow-right"></i></span>
									</span>
								</span>
								<span class="catalog-banner-img">
									<picture class="catalog-banner-picture">
									<source media="(max-width: 720px)" srcset="<?=CFile::GetPath($arResult['ADVERTISING']['PROPERTIES']['VERTICAL_IMG']['VALUE'])?>">
									<img class="catalog-banner-picture-value" src="<?=CFile::GetPath($arResult['ADVERTISING']['PROPERTIES']['GORIZONTAL_IMG']['VALUE'])?>" alt="<?=$arResult['ADVERTISING']['NAME']?>">
									</picture>
								</span>
							</span>
						</a>
					</div>
				<?endif?>
				<div class="catalog-list-item col-6 col-md-4 col-lg-3">
					<div class="product block">
						<div class="product-box">
							<a class="product-img-link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
								<?if($arItem['PREVIEW_PICTURE']['SRC']):?>
									<img class="product-img" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
								<?else:?>
									<img class="product-img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/no-photo.jpg" alt="" />
								<?endif?>
							</a>
							<?if($arItem['STICKERS']):?>
								<ul class="catalog-list-product-marks product-marks marks JS-Dropdown-Marks" data-dropdown="{'classActive': 'marks_active'}">
									<?foreach ($arItem['STICKERS'] as $arSticker):?>
										<li class="marks-item marks-item_element">
											<a href="javascript:;" class="marks-label"<?=($arSticker['UF_COLOR']) ? ' style="background-color: '.$arSticker['UF_COLOR'].';"' : ''?>><?=$arSticker['UF_NAME']?></a>
										</li>
									<?endforeach?>
									<li class="marks-item marks-item_switcher">
										<a href="javascript:;" class="marks-switcher JS-Dropdown-Switcher"></a>
									</li>
								</ul>
							<?endif?>
							<ul class="product-links links">
								<li class="links-item js-tooltip-links js-link-item" data-tooltip-class="tooltip-popup tooltip-popup_links">
									<a class="links-label js-add2favorite" href="javascript:;" data-id="<?=$arItem['ID']?>">
										<span class="links-icon links-icon_default links-icon_heart"></span>
										<span class="links-icon links-icon_hover links-icon_heart-hover"></span>
										<span class="links-icon links-icon_active links-icon_heart-active"></span>
									</a>
									<span class="links-tooltip js-tooltip-content"><?=Loc::getMessage('ADD2FAVORITE')?></span>
								</li>
								<li class="links-item js-tooltip-links js-link-item" data-tooltip-class="tooltip-popup tooltip-popup_links">
									<a class="links-label js-add2compare" href="javascript:;" data-id="<?=$arItem['ID']?>">
										<span class="links-icon links-icon_default links-icon_compare"></span>
										<span class="links-icon links-icon_hover links-icon_compare-hover"></span>
										<span class="links-icon links-icon_active links-icon_compare-active"></span>
									</a>
									<span class="links-tooltip js-tooltip-content"><?=Loc::getMessage('ADD2COMPARE')?></span>
								</li>
								<li class="links-item js-tooltip-links js-link-item" data-tooltip-class="tooltip-popup tooltip-popup_links">
									<a class="links-label js-add2config" href="javascript:;" data-id="<?=$arItem['ID']?>">
										<span class="links-icon links-icon_default links-icon_config"></span>
										<span class="links-icon links-icon_hover links-icon_config-hover"></span>
										<span class="links-icon links-icon_active links-icon_config-active"></span>
									</a>
									<span class="links-tooltip js-tooltip-content"><?=Loc::getMessage('ADD2CONFIG')?></span>
								</li>
							</ul>
							<div class="mob-links">
								<a class="mob-links-switcher" href="javascript:;">
									<i class="mob-links-switcher-icon"></i>
								</a>
								<ul class="mob-links-list">
									<li class="mob-links-item js-link-item">
										<a class="mob-links-label js-add2favorite" href="javascript:;" data-id="<?=$arItem['ID']?>">
											<span class="mob-links-icon mob-links-icon_default links-icon links-icon_heart"></span>
											<span class="mob-links-icon mob-links-icon_hover links-icon links-icon_heart-hover"></span>
											<span class="mob-links-icon mob-links-icon_active links-icon links-icon_heart-active"></span>
											<span class="mob-links-name"><?=Loc::getMessage('ADD2FAVORITE')?></span>
										</a>
									</li>
									<li class="mob-links-item js-link-item">
										<a class="mob-links-label" href="javascript:;">
											<span class="mob-links-icon mob-links-icon_default links-icon links-icon_compare"></span>
											<span class="mob-links-icon mob-links-icon_hover links-icon links-icon_compare-hover"></span>
											<span class="mob-links-icon mob-links-icon_active links-icon links-icon_compare-active"></span>
											<span class="mob-links-name"><?=Loc::getMessage('ADD2COMPARE')?></span>
										</a>
									</li>
									<li class="mob-links-item js-link-item">
										<a class="mob-links-label" href="javascript:;">
											<span class="mob-links-icon mob-links-icon_default links-icon links-icon_config"></span>
											<span class="mob-links-icon mob-links-icon_hover links-icon links-icon_config-hover"></span>
											<span class="mob-links-icon mob-links-icon_active links-icon links-icon_config-active"></span>
											<span class="mob-links-name"><?=Loc::getMessage('ADD2CONFIG')?></span>
										</a>
									</li>
								</ul>
							</div>
							<a class="product-link js-popup-product" href="javascript:;" data-src="/ajax/preview.php?ID=<?=$arItem['ID']?>"><?=Loc::getMessage('FAST_PREVIEW')?></a>
						</div>
						<div class="product-info">
							<span class="product-name">
								<a class="catalog-list-product-link product-name-link" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
							</span>
							<div class="catalog-list-product-data product-data">
								<span class="product-art"><?if($arItem['PROPERTIES']['ARTICLE']['VALUE']):?>АРТ. <?=$arItem['PROPERTIES']['ARTICLE']['VALUE']?><?endif?></span>
								<span class="catalog-list-product-rating">
									<?=CEwpDykatContent::GetItemRating($arItem['ID'], $arItem['IBLOCK_ID'])?>
								</span>
							</div>
							<div class="catalog-list-product-price product-price">
								<?=CEwpDykatContent::GetItemPrice($arItem['ID'])?>
							</div>
							<div class="product-buttons">
								<a class="product-button button button_simple" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=Loc::getMessage('DETAILS')?></a>
							</div>
						</div>
					</div>
				</div>
			<?endforeach?>
		</div>
		<?if ($arParams['DISPLAY_BOTTOM_PAGER']):?>
			<?=$arResult['NAV_STRING']?>
		<?endif?>
	</div>
<?endif?>