<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<div class="news-detail">
	<div class="news-detail__date"><?=FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($arResult["DATE_CREATE"]))?></div>
	<?if($arResult['DETAIL_PICTURE']['SRC']):?>
		<div class="news-detail__img">
			<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>" />
		</div>
	<?endif?>
	<div class="news-detail__text"><?=$arResult['DETAIL_TEXT']?></div>
	<?if($arResult['PROPERTIES']['GALLERY']['VALUE']):?>
		<div class="news-detail__gallery gallery js-slider-gallery">
			<div class="gallery__items js-slider-list">
				<?foreach($arResult['PROPERTIES']['GALLERY']['VALUE'] as $key => $imgId):?>
					<?$path = CFile::GetPath($imgId)?>
					<div class="gallery-item js-slider-item" data-dot="<button role='button' class='owl-dot-button'><?=str_pad($key + 1, 2, '0', STR_PAD_LEFT)?></button>">
						<a href="<?=$path?>" data-fancybox="gallery">
							<img src="<?=$path?>" alt="">
						</a>
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
	<?endif?>
</div>