<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if ($arResult['ITEMS']):?>
	<?$arMainItem = array_shift($arResult['ITEMS'])?>
	<div class="news-list">
		<div class="row">
			<div class="col-12 col-lg-6">
				<div class="news-list-item news-list-item--main">
					<div class="news-list-item__img">
						<a href="<?=$arMainItem['DETAIL_PAGE_URL']?>">
							<img src="<?=($arMainItem['PREVIEW_PICTURE']['SRC']) ?: '/images/noimage.jpg'?>" alt="<?=$arMainItem['NAME']?>" />
						</a>
					</div>
					<div class="news-list-item__body">
						<a class="news-list-item__title" href="<?=$arMainItem['DETAIL_PAGE_URL']?>"><?=$arMainItem['NAME']?></a>
						<div class="news-list-item__date"><?=FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($arMainItem["DATE_CREATE"]))?></div>
						<div class="news-list-item__description"><?=$arMainItem['PREVIEW_TEXT']?></div>
						<a class="news-list-item__link" href="<?=$arMainItem['DETAIL_PAGE_URL']?>">Подробнее</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="news-list-items">
					<?foreach($arResult['ITEMS'] as $arItem):?>
						<div class="news-list-item">
							<div class="row">
								<div class="col-12 col-lg-4">
									<div class="news-list-item__img">
										<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
											<img src="<?=($arItem['PREVIEW_PICTURE']['SRC']) ?: '/images/noimage.jpg'?>" alt="<?=$arItem['NAME']?>" />
										</a>
									</div>
								</div>
								<div class="col-12 col-lg-8">
									<div class="news-list-item__body">
										<a class="news-list-item__title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
										<div class="news-list-item__date"><?=FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($arItem["DATE_CREATE"]))?></div>
										<div class="news-list-item__description"><?=$arItem['PREVIEW_TEXT']?></div>
										<a class="news-list-item__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">Подробнее</a>
									</div>
								</div>
							</div>
						</div>
					<?endforeach?>
				</div>
			</div>
		</div>

		<div class="news-list__panel">
			<a class="news-list__all-link button button_simple" href="<?=str_replace(array('#SITE_DIR#', '//'), array(SITE_DIR, '/'), $arResult['LIST_PAGE_URL'])?>">Все новости</a>
		</div>
	</div>
<?endif?>