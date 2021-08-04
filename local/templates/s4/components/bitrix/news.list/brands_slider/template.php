<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if ($arResult['ITEMS']):?>
    <div class="js-slider-brands">
        <div class="brands-list js-slider-list">
            <?foreach($arResult['ITEMS'] as $arItem):?>
                <a class="brands-item js-slider-item" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <img class="brands-img" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
                </a>
            <?endforeach?>
        </div>
		<div class="brands-buttons">
			<a class="brands-button button button_simple" href="<?=str_replace(array('#SITE_DIR#', '//'), array(SITE_DIR, '/'), $arResult['LIST_PAGE_URL'])?>"><?=Loc::getMessage('SHOW_ALL')?></a>
		</div>
	</div>
<?endif?>