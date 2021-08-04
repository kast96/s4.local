<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult['ITEMS']):?>
	<div class="js-slider-announce">
		<div class="announce-list js-slider-list">
			<?foreach($arResult['ITEMS'] as $key => $arItem):?>
				<div class="announce-block block js-slider-item" data-dot="<button role='button' class='owl-dot-button'><?=str_pad($key + 1, 2, '0', STR_PAD_LEFT)?></button>">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="announce-link">
						<img class="announce-img-val" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
					</a>
					<div class="announce-description">
						<?if($arItem['PROPERTIES']['TAGS']['VALUE']):?>
							<ul class="tags">
								<?foreach($arItem['PROPERTIES']['TAGS']['VALUE'] as $arTag):?>
									<li class="tags-item">
										<a class="tags-link" href="<?=str_replace(array('#SITE_DIR#', '//'), array(SITE_DIR, '/'), $arResult['LIST_PAGE_URL']) . 'filter/' . urldecode(strtolower($arItem['PROPERTIES']['TAGS']['CODE']) . '-is-' . $arItem['PROPERTIES']['TAGS']['VALUE_XML_ID'][$key]) . '/'?>"><?=$arTag?></a>
									</li>
								<?endforeach?>
							</ul>
						<?endif?>
						<a class="announce-name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
						<div class="announce-author">
							<img class="announce-logo" src="<?=CFile::GetPath($arResult['USER']['PERSONAL_PHOTO'])?>" alt="" />
							<ul class="announce-add-info">
								<li class="announce-add-info-item">
									<span class="announce-firm-name"><?=$arResult['USER']['NAME']?></span>
								</li>
								<li class="item">
									<span class="announce-data"><i class="announce-data-icon las la-calendar"></i><?=FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($arItem["DATE_CREATE"]))?></span>
								</li>
							</ul>
						</div>
						<div class="announce-info"><?=(strlen($arItem['PREVIEW_TEXT']) > 148) ? mb_substr($arItem['PREVIEW_TEXT'], 0, 148) . '...' : $arItem['PREVIEW_TEXT']?></div>
						<div class="announce-panel">
							<?
								$likeId = bin2hex(random_bytes(10));
							?>
							<ul class="likes">
								<li class="likes-item">
									<a class="likes-link js-like<?=($arItem['LIKES']['USER_LIKE'] === true) ? ' is-active' : ''?>" data-action="like" data-id="<?=$likeId?>" data-like="{'classActive': 'is-active', 'object': 'IBLOCK_<?=$arResult['ID']?>', 'entity': '<?=$arItem['ID']?>'}" href="javascript:;"><i class="likes-icon las la-thumbs-up"></i><span class="js-like-value"><?=$arItem['LIKES']['LIKE']['COUNT']?></span></a>
								</li>
								<li class="likes-item">
									<a class="likes-link js-like<?=($arItem['LIKES']['USER_LIKE'] === false) ? ' is-active' : ''?>" data-action="dislike" data-id="<?=$likeId?>" data-like="{'classActive': 'is-active', 'object': 'IBLOCK_<?=$arResult['ID']?>', 'entity': '<?=$arItem['ID']?>'}" href="javascript:;"><i class="likes-icon las la-thumbs-down"></i><span class="js-like-value"><?=$arItem['LIKES']['DISLIKE']['COUNT']?></span></a>
								</li>
								<li class="likes-item">
									<a class="likes-link" href="<?=$arItem['DETAIL_PAGE_URL']?>#comments"><i class="likes-icon las la-comment"></i><?=$arItem['REVIEWS']['COUNT']?></a>
								</li>
							</ul>
							<a class="announce-more" href="<?=$arItem['DETAIL_PAGE_URL']?>">Подробнее</a>
						</div>
					</div>
				</div>
			<?endforeach?>
		</div>

		<div class="announce-nav owl-actions">
			<a class="announce-all-link button button_simple" href="<?=str_replace(array('#SITE_DIR#', '//'), array(SITE_DIR, '/'), $arResult['LIST_PAGE_URL'])?>">Все обзоры</a>
			<div class="announce-pager owl-dots js-slider-pager"></div>
			<div class="announce-buttons owl-nav js-slider-buttons"></div>
		</div>
	</div>
<?endif?>