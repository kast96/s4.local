<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if($arResult['SECTIONS']):?>
	<div class="branches-slider js-slider-branches">
        <div class="branches-list js-slider-list">
			<?foreach($arResult['SECTIONS'] as $key => $arSection):?>
				<div class="branches-item block-simple more-item branches-color-<?=$arSection['COLOR']?> js-slider-item"
					data-dot="<button role='button' class='owl-dot-button'><?=str_pad($key + 1, 2, '0', STR_PAD_LEFT)?></button>"
				>
					<a class="branches-link" href="<?=$arSection['SECTION_PAGE_URL']?>">
						<span class="branches-img-block">
							<img class="branches-img" src="<?=$arSection['PICTURE']['SRC']?>" alt="" />
						</span>
						<span class="branches-name"><?=$arSection['NAME']?></span>
					</a>
					<?if ($arSection['SUBSECTIONS']):?>
						<ul class="branches-menu">
							<?foreach($arSection['SUBSECTIONS'] as $arSubSection):?>
								<li class="branches-menu-item">
									<a class="branches-menu-link" href="<?=$arSubSection['SECTION_PAGE_URL']?>"><?=$arSubSection['NAME']?></a>
								</li>
							<?endforeach?>
						</ul>
					<?endif?>
					<a class="branches-more more-link button" href="<?=$arSection['SECTION_PAGE_URL']?>">
						<span class="more-label"><?=Loc::getMessage('SHOW_ALL')?></span>
						<span class="more"><i class="more-icon las la-arrow-right"></i></span>
					</a>
				</div>
            <?endforeach?>
        </div>

        <div class="branches-nav owl-actions">
            <a class="branches-button button button_simple" href="<?=$arResult['SECTION']['SECTION_PAGE_URL']?>"><?=Loc::getMessage('SHOW_ALL')?></a>
            <div class="branches-pager owl-dots js-slider-pager"></div>
            <div class="branches-buttons owl-nav js-slider-buttons"></div>
        </div>
    </div>
<?endif?>