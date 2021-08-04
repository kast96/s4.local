<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if ($arResult['ITEMS']):?>
	<ul class="news-list">
		<?foreach($arResult['ITEMS'] as $arItem):?>
			<li class="news-item">
				<div class="news-side">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news-link">
						<img class="news-img block" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
					</a>
				</div>
				<div class="news-description">
					<a class="news-name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
					<span class="news-data"><i class="news-data-icon las la-calendar"></i><?=FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($arItem["DATE_CREATE"]))?></span>
						<?if($arItem['PROPERTIES']['TAGS']['VALUE']):?>
							<ul class="news-tags tags">
								<?foreach($arItem['PROPERTIES']['TAGS']['VALUE'] as $key => $arTag):?>
									<li class="tags-item">
										<a class="tags-link" href="<?=str_replace(array('#SITE_DIR#', '//'), array(SITE_DIR, '/'), $arResult['LIST_PAGE_URL']) . 'filter/' . urldecode(strtolower($arItem['PROPERTIES']['TAGS']['CODE']) . '-is-' . $arItem['PROPERTIES']['TAGS']['VALUE_XML_ID'][$key]) . '/'?>"><?=$arTag?></a>
									</li>
								<?endforeach?>
							</ul>
						<?endif?>
					<div class="news-info"><?=(strlen($arItem['PREVIEW_TEXT']) > 70) ? mb_substr($arItem['PREVIEW_TEXT'], 0, 70) . '...' : $arItem['PREVIEW_TEXT']?></div>
					<a class="news-more" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=Loc::getMessage('DETAILS')?></a>
				</div>
			</li>
		<?endforeach?>
	</ul>

	<div class="news-panel">
		<a class="news-all-link button button_simple" href="<?=str_replace(array('#SITE_DIR#', '//'), array(SITE_DIR, '/'), $arResult['LIST_PAGE_URL'])?>"><?=Loc::getMessage('ALL_NEWS')?></a>
	</div>
<?endif?>