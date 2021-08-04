<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="catalog section-list-catalog JS-Tab js-catalog-tabs" data-tab="{
        'classSwitcherActive': 'sort-item_active',
        'classItemActive': 'section-list-catalog-item_active'
    }">
	<ul class="sort">
		<?foreach($arResult['SECTIONS'] as $key => $arSection):?>
			<li class="sort-item JS-Tab-Switcher<?=($key === 0) ? ' sort-item_active' : ''?>">
				<a class="sort-link switcher" href="javascript:;"><?=($arSection['UF_SORT_BY_CATEGORY_NAME']) ?: $arSection['NAME']?></a>
			</li>
		<?endforeach?>
	</ul>

	<?foreach($arResult['SECTIONS'] as $key => $arSection):?>
		<div class="section-list-catalog-item JS-Tab-Item section-list-catalog-item_active<?//=($key === 0) ? ' section-list-catalog-item_active' : ''?>">
			<div class="JS-Columns" data-columns="{'number': 4}" data-id="<?=$arSection['ID']?>">
				<div class="catalog-section-list row">
					<div class="col-md-6 col-lg-3 JS-Columns-End"></div>
					<div class="col-md-6 col-lg-3 JS-Columns-End"></div>
					<div class="col-md-6 col-lg-3 JS-Columns-End"></div>
					<div class="col-md-6 col-lg-3 JS-Columns-End"></div>
				</div>

				<div class="catalog-section JS-Columns-Start-List">
					<?foreach($arSection['CHILD'] as $arSection2):?>
						<div class="catalog-section-item JS-Columns-Start">
							<div class="catalog-section-box JS-ShowMore" data-showmore="{
								'classActive': 'show_active',
								'classSwitcherActive': 'show-switcher_active',
								'amount': 9,
								'classHide': 'catalog-section-sub-item_hide'
								}">
								<a class="catalog-section-link" href="<?=$arSection2['SECTION_PAGE_URL']?>"><?=$arSection2['NAME']?></a>
								<?if($arSection2['CHILD']):?>
									<ul class="catalog-section-sub-list">
										<?foreach($arSection2['CHILD'] as $arSection3):?>
											<li class="catalog-section-sub-item JS-ShowMore-Item">
												<a class="catalog-section-sub-link" href="<?=$arSection3['SECTION_PAGE_URL']?>"><?=$arSection3['NAME']?></a>
												<?if($arSection3['CHILD']):?>
													<ul class="catalog-section-sub-list">
														<?foreach($arSection3['CHILD'] as $arSection4):?>
															<li class="catalog-section-sub-item JS-ShowMore-Item">
																<a class="catalog-section-sub-link" href="<?=$arSection4['SECTION_PAGE_URL']?>"><?=$arSection4['NAME']?></a>
															</li>
														<?endforeach?>
													</ul>
												<?endif?>
											</li>
										<?endforeach?>
									</ul>
									<a class="catalog-section-switcher show-switcher JS-ShowMore-Switcher" href="javascript:;">
										<span class="show-more show-more_show">
											<span class="catalog-section-label show-more-label switcher">Полный список</span>
											<svg class="catalog-section-label-icon show-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="7px" height="7px" viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;" xml:space="preserve">
												<path d="M0.2,2l0.3-0.3c0,0,0.1-0.1,0.2-0.1c0.1,0,0.1,0,0.2,0.1l2.6,2.6l2.6-2.6c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1
													L6.8,2c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L3.7,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1L0.2,2.3c0,0-0.1-0.1-0.1-0.2S0.2,2,0.2,2z"
												/>
											</svg>
										</span>
										<span class="show-more show-more_hide">
											<span class="catalog-section-label show-more-label switcher">Свернуть</span>
											<svg class="catalog-section-label-icon show-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="7px" height="7px" viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;" xml:space="preserve">
												<path d="M6.8,5L6.4,5.4c0,0-0.1,0.1-0.2,0.1c-0.1,0-0.1,0-0.2-0.1L3.5,2.8L0.9,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1
												L0.2,5c0,0-0.1-0.1-0.1-0.2s0-0.1,0.1-0.2l3.1-3.1c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1l3.1,3.1c0,0,0.1,0.1,0.1,0.2S6.8,5,6.8,5z"/>
											</svg>
										</span>
									</a>
								<?endif?>
							</div>
						</div>
					<?endforeach?>
				</div>
			</div>
		</div>
	<?endforeach?>
</div>