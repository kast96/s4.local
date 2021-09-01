<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if ($arResult['ITEMS']):?>
	<?$arFirstItem = array_shift($arResult['ITEMS'])?>
	<div class="news-section-list js-pagen">
		<div class="row js-pagen-content">
			<div class="col-12 col-lg-8 news-section-item__col">
				<div class="news-section-item news-section-item--wide">
					<div class="news-section-item__img">
						<a href="<?=$arFirstItem['DETAIL_PAGE_URL']?>">
							<img src="<?=$arFirstItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arFirstItem['NAME']?>" />
						</a>
					</div>
					<div class="news-section-item__body">
						<a class="news-section-item__title" href="<?=$arFirstItem['DETAIL_PAGE_URL']?>"><?=$arFirstItem['NAME']?></a>
						<div class="news-section-item__date"><?=FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($arFirstItem["DATE_CREATE"]))?></div>
						<a class="news-section-item__link" href="<?=$arFirstItem['DETAIL_PAGE_URL']?>">Подробнее</a>
					</div>
				</div>
			</div>
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<div class="col-12 col-lg-4 news-section-item__col">
					<div class="news-section-item">
						<div class="news-section-item__img">
							<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
								<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
							</a>
						</div>
						<div class="news-section-item__body">
							<a class="news-section-item__title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
							<div class="news-section-item__date"><?=FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($arItem["DATE_CREATE"]))?></div>
							<div class="news-section-item__description"><?=$arItem['PREVIEW_TEXT']?></div>
							<a class="news-section-item__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">Подробнее</a>
						</div>
					</div>
				</div>
			<?endforeach?>
		</div>

		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif?>
	</div>
<?endif?>