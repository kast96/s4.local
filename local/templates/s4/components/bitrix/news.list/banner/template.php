<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult['ITEMS']):?>
	<div class="main-banner">
		<div class="main-banner-slider js-slider-banner">
			<div class="main-banner-slider-list js-slider-list">
				<?foreach($arResult['ITEMS'] as $key => $arItem):?>
					<div class="main-banner-item js-slider-item"
						data-dot="<button role='button' class='owl-dot-button'><?=str_pad($key + 1, 2, '0', STR_PAD_LEFT)?></button>"
						<?=($arItem['DETAIL_PICTURE']) ? 'style="background: url('.$arItem['DETAIL_PICTURE']['SRC'].')"' : ''?>
					>
						<div class="main-banner-block container">
							<div class="main-banner-description">
								<div class="main-banner-title"><?=$arItem['NAME']?></div>
								<?if($arItem['PREVIEW_TEXT']):?>
									<div class="main-banner-info"><?=$arItem['PREVIEW_TEXT']?></div>
								<?endif?>
								<?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
									<a class="main-banner-button button" href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>"><?=($arItem['PROPERTIES']['BTN_TEXT']['VALUE']) ?: 'Перейти'?></a>
								<?endif?>
							</div>
							<div class="main-banner-img">
								<?if($arItem['PREVIEW_PICTURE']):?>
									<img class="main-banner-picture" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="" />
								<?endif?>
							</div>
						</div>
					</div>
				<?endforeach?>
			</div>
			<div class="main-banner-nav owl-actions container">
				<div class="main-banner-nav-container">
					<div class="main-banner-pager owl-dots js-slider-pager"></div>
					<div class="main-banner-buttons owl-nav js-slider-buttons"></div>
				</div>
			</div>
		</div>
	</div>
<?endif?>