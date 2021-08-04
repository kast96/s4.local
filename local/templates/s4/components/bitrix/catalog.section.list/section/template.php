<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if($arResult['SECTIONS']):?>
	<div class="catalog-category js-slider-category JS-ShowMoreCategory" data-showmore="{
		'classActive': 'show_active',
		'classSwitcherActive': 'show-switcher_active',
		'amount': 8,
		'classHide': 'catalog-category-item_hide',
		'elementItem': '.catalog-category-item'
	}" data-showmore-extra="{
		'amount': 3
	}">
		<div class="catalog-category-list js-slider-list">
			<?foreach($arResult['SECTIONS'] as $arSection):?>
				<div class="catalog-category-item js-slider-item JS-ShowMore-Item">
					<div class="catalog-category-block block">
						<a class="catalog-category-link" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
					</div>
				</div>
			<?endforeach?>
		</div>
		<div class="catalog-category-panel">
			<a class="catalog-category-switcher show-switcher JS-ShowMore-Switcher" href="javascript:;">
				<span class="show-more show-more_show">
					<span class="catalog-category-label show-more-label switcher"><?=Loc::getMessage('SHOW_ALL')?></span><svg
						class="catalog-category-more-icon show-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px" height="7px"
						viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;" xml:space="preserve">
						<path
							d="M0.2,2l0.3-0.3c0,0,0.1-0.1,0.2-0.1c0.1,0,0.1,0,0.2,0.1l2.6,2.6l2.6-2.6c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1
								L6.8,2c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L3.7,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1L0.2,2.3c0,0-0.1-0.1-0.1-0.2S0.2,2,0.2,2z" />
					</svg>
				</span>
				<span class="show-more show-more_hide">
					<span class="catalog-category-label show-more-label switcher"><?=Loc::getMessage('HIDE')?></span><svg
						class="catalog-category-more-icon show-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px" height="7px"
						viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;" xml:space="preserve">
						<path
							d="M6.8,5L6.4,5.4c0,0-0.1,0.1-0.2,0.1c-0.1,0-0.1,0-0.2-0.1L3.5,2.8L0.9,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1
								L0.2,5c0,0-0.1-0.1-0.1-0.2s0-0.1,0.1-0.2l3.1-3.1c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1l3.1,3.1c0,0,0.1,0.1,0.1,0.2S6.8,5,6.8,5z" />
					</svg>
				</span>
			</a>
		</div>
	</div>
<?endif?>