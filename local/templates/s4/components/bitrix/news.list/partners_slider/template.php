<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if ($arResult['ITEMS']):?>
    <div class="js-slider-partners">
        <div class="partners-list js-slider-list">
            <?foreach($arResult['ITEMS'] as $key => $arItem):?>
                <div class="partners-item js-slider-item" data-dot="<button role='button' class='owl-dot-button'><?=str_pad($key + 1, 2, '0', STR_PAD_LEFT)?></button>">
                    <div class="partners-img">
                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
                    </div>
                    <div class="partners-body">
                        <div class="partners-name"><?=$arItem['NAME']?></div>
                        <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="button">
                            <span>Перейти на сайт</span>
                            <i class="fa fa-external-link-alt partners-icon"></i>
                        </a>
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
<?endif?>