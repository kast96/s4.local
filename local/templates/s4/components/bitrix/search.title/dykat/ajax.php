<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loader::includeSharewareModule('ewp.dykat');

Loc::loadMessages(__FILE__);
?>

<?if($arResult['TOTAL']['ITEMS']):?>
	<div class="title-search-result">
		<div class="search-result-container js-custom-scroll">
			<div class="search-result-main">
				<div class="search-result-side">
					<?if ($arResult['TOTAL']['WORDS']):?>
						<div class="search-result-menu JS-ShowMore" data-showmore="{
							'classActive': 'show_active',
							'classSwitcherActive': 'show-switcher_active',
							'amount': 6,
							'classHide': 'search-result-item_hide',
							'elementItem': '.search-result-item'
						}">
							<ul class="search-result-list">
								<?foreach ($arResult['TOTAL']['WORDS'] as $arWord):?>
									<li class="search-result-item JS-ShowMore-Item">
										<a class="search-result-link" href="<?=$arResult['FORM_ACTION'].'?q='.urldecode($arWord['WORD'])?>"><?=$arWord['TEXT']?></a>
									</li>
								<?endforeach?>
							</ul>
							<a class="search-result-switcher show-switcher JS-ShowMore-Switcher" href="javascript:;">
								<span class="show-more show-more_show">
									<span class="search-result-more show-more-label"><?=Loc::getMessage('MORE')?></span>
									<svg class="search-result-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px" height="7px" viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;" xml:space="preserve">
										<path d="M2.1,0.2c0.1,0,0.1,0,0.2,0.1l3.1,3.1c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L2.3,6.8c0,0-0.1,0.1-0.2,0.1
											S2,6.8,2,6.8L1.6,6.4c0,0-0.1-0.1-0.1-0.2s0-0.1,0.1-0.2l2.6-2.6L1.6,0.9c0,0-0.1-0.1-0.1-0.2c0-0.1,0-0.1,0.1-0.2L2,0.2
											C2,0.2,2,0.2,2.1,0.2z"/>
									</svg>
							</span>
							<span class="show-more show-more_hide">
									<span class="search-result-more show-more-label"><?=Loc::getMessage('HIDE')?></span>
									<svg class="search-result-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										width="7px" height="7px" viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;" xml:space="preserve">
										<path d="M2.1,0.2c0.1,0,0.1,0,0.2,0.1l3.1,3.1c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L2.3,6.8c0,0-0.1,0.1-0.2,0.1
											S2,6.8,2,6.8L1.6,6.4c0,0-0.1-0.1-0.1-0.2s0-0.1,0.1-0.2l2.6-2.6L1.6,0.9c0,0-0.1-0.1-0.1-0.2c0-0.1,0-0.1,0.1-0.2L2,0.2
											C2,0.2,2,0.2,2.1,0.2z"/>
									</svg>
								</span>
							</a>
						</div>
					<?endif?>

					<?if ($arResult['TOTAL']['SECTIONS']):?>
						<div class="search-result-menu JS-ShowMore" data-showmore="{
							'classActive': 'show_active',
							'classSwitcherActive': 'show-switcher_active',
							'amount': 6,
							'classHide': 'search-result-item_hide',
							'elementItem': '.search-result-item'
						}">
							<span class="search-result-title"><?=Loc::getMessage('CATEGORIES')?></span>
							<ul class="search-result-list">
								<?foreach ($arResult['TOTAL']['SECTIONS'] as $arSection):?>
									<li class="search-result-item JS-ShowMore-Item">
										<a class="search-result-link" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
									</li>
								<?endforeach?>
							</ul>
							<a class="search-result-switcher show-switcher JS-ShowMore-Switcher" href="javascript:;">
								<span class="show-more show-more_show">
									<span class="search-result-more show-more-label"><?=Loc::getMessage('MORE')?></span>
									<svg class="search-result-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px" height="7px" viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;" xml:space="preserve">
										<path d="M2.1,0.2c0.1,0,0.1,0,0.2,0.1l3.1,3.1c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L2.3,6.8c0,0-0.1,0.1-0.2,0.1
											S2,6.8,2,6.8L1.6,6.4c0,0-0.1-0.1-0.1-0.2s0-0.1,0.1-0.2l2.6-2.6L1.6,0.9c0,0-0.1-0.1-0.1-0.2c0-0.1,0-0.1,0.1-0.2L2,0.2
											C2,0.2,2,0.2,2.1,0.2z"/>
									</svg>
								</span>
								<span class="show-more show-more_hide">
									<span class="search-result-more show-more-label"><?=Loc::getMessage('HIDE')?></span>
									<svg class="search-result-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										width="7px" height="7px" viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;" xml:space="preserve">
										<path d="M2.1,0.2c0.1,0,0.1,0,0.2,0.1l3.1,3.1c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L2.3,6.8c0,0-0.1,0.1-0.2,0.1
											S2,6.8,2,6.8L1.6,6.4c0,0-0.1-0.1-0.1-0.2s0-0.1,0.1-0.2l2.6-2.6L1.6,0.9c0,0-0.1-0.1-0.1-0.2c0-0.1,0-0.1,0.1-0.2L2,0.2
											C2,0.2,2,0.2,2.1,0.2z"/>
									</svg>
								</span>
							</a>
						</div>
					<?endif?>
				</div>

				<div class="search-result-content">
					<span class="search-result-title search-result-title_popular"><?=Loc::getMessage('POPULAR')?></span>
					<ul class="search-product-list row">
						<?foreach($arResult['TOTAL']['ITEMS'] as $arItem):?>
							<li class="search-product-item col-md-6 col-lg-3">
								<div class="search-product">
									<div class="search-product-box">
										<a class="search-product-img-link" href="<?=$arItem['FIELDS']['DETAIL_PAGE_URL']?>">
											<img class="search-product-img" src="<?=CFile::GetPath($arItem['FIELDS']['PREVIEW_PICTURE'])?>" alt="<?=$arItem['FIELDS']['NAME']?>" />
										</a>
									</div>
									<div class="search-product-info">
										<span class="search-product-name">
											<a class="search-product-name-link" href="<?=$arItem['FIELDS']['DETAIL_PAGE_URL']?>"><?=$arItem['FIELDS']['NAME']?></a>
										</span>
										<div class="search-product-price">
											<?=CEwpDykatContent::GetItemPrice($arItem['ITEM_ID'])?>
										</div>
									</div>
								</div>
							</li>
						<?endforeach?>
					</ul>
					
					<?if($arResult['TOTAL']['BRANDS']):?>
						<div class="search-brands row">
							<?foreach($arResult['TOTAL']['BRANDS'] as $arBrand):?>
								<a class="search-brands-item col-md-6 col-lg-3" href="<?=$arBrand['DETAL_PAGE_URL']?>">
									<img class="search-brands-img" src="<?=CFile::GetPath($arBrand['PREVIEW_PICTURE'])?>" alt="<?=$arBrand['NAME']?>" />
								</a>
							<?endforeach?>
						</div>
					<?endif?>
				</div>

			</div>
		</div>
	</div>
<?else:?>
	<div class="search-empty"><?=Loc::getMessage('NOT_FOUND')?></div>
<?endif?>