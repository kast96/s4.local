<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"]) {
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$nearCount = 2;

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
//$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

$start = $arResult['NavPageNomer'] - $nearCount/2;
if ($start < 2) $start = 2;

$end = $arResult['NavPageNomer'] + $nearCount/2;
if ($end >= $arResult['NavPageCount']) $end = $arResult['NavPageCount'] - 1;

$showedItemsCount = $arResult['NavPageSize'] * $arResult['NavPageNomer'];
if ($showedItemsCount > $arResult['NavRecordCount']) {
	$showedItemsCount = $arResult['NavRecordCount'];
}
?>

<div class="pagen-pager js-pagen-pager">
	<?if($arResult['NavPageNomer'] < $arResult["NavPageCount"]):?>
		<a class="load-more load-more-link js-pagen-ajax" href="javascript:;">
			<span class="load-more-switcher switcher">Показать еще</span>
			<i class="load-more-icon fa fa-redo-alt"></i>
		</a>
	<?endif?>
	<div class="pager-container">
		<ul class="pager JS-AjaxMore-Pager">
			<?//arrow left?>
			<li class="pager-item<?=($arResult['NavPageNomer'] == 1) ? ' pager-item_default' : ''?>">
				<?if($arResult['NavPageNomer'] == 1):?>
					<span class="pager-link pager-link_side">
				<?else:?>
					<a class="pager-link pager-link_side" href="<?=$arResult["sUrlPath"]?>?<?=($arResult["NavPageNomer"] > 2) ? $strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1) : $arResult["NavQueryString"]?>">
				<?endif?>
					<i class="pager-icon fa fa-arrow-left"></i>
				<?if($arResult['NavPageNomer'] == 1):?>
					</span>
				<?else:?>
					</a>
				<?endif?>
			</li>

			<?//1?>
			<li class="pager-item<?=($arResult['NavPageNomer'] == 1) ? ' pager-item_active' : ''?>">
				<?if($arResult['NavPageNomer'] != 1):?>
					<a class="pager-link" href="<?=$arResult["sUrlPath"]?>?<?=$arResult["NavQueryString"]?>">
				<?else:?>
					<span class="pager-link">
				<?endif?>
					1
				<?if($arResult['NavPageNomer'] != 1):?>
					</a>
				<?else:?>
					</span>
				<?endif?>
			</li>

			<?//left dots?>
			<?if ($start > 2):?>
				<li class="pager-item">
					<a class="pager-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($start/2)?>">...</a>
				</li>
			<?endif?>

			<?//items?>
			<?for ($i = $start; $i <= $end; $i++):?>
				<li class="pager-item<?=($arResult['NavPageNomer'] == $i) ? ' pager-item_active' : ''?>">
					<?if($arResult['NavPageNomer'] != $i):?>
						<a class="pager-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$i?>">
					<?else:?>
						<span class="pager-link">
					<?endif?>
						<?=$i?>
					<?if($arResult['NavPageNomer'] != $i):?>
						</a>
					<?else:?>
						</span>
					<?endif?>
				</li>
			<?endfor?>

			<?//right dots?>
			<?if ($end < $arResult['NavPageCount'] - 1):?>
				<li class="pager-item">
					<a class="pager-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round(($arResult['NavPageCount'] - $end)/2) + $end?>">...</a>
				</li>
			<?endif?>

			<?//last item?>
			<li class="pager-item<?=($arResult['NavPageNomer'] == $arResult["NavPageCount"]) ? ' pager-item_active' : ''?>">
				<?if($arResult['NavPageNomer'] < $arResult["NavPageCount"]):?>
					<a class="pager-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">
				<?else:?>
					<span class="pager-link">
				<?endif?>
					<?=$arResult['NavPageCount']?>
				<?if($arResult['NavPageNomer'] < $arResult["NavPageCount"]):?>
					</a>
				<?else:?>
					</span>
				<?endif?>
			</li>

			<?//arrow right?>
			<li class="pager-item<?=($arResult['NavPageNomer'] == $arResult["NavPageCount"]) ? ' pager-item_default' : ''?>">
				<?if($arResult['NavPageNomer'] == $arResult["NavPageCount"]):?>
					<span class="pager-link pager-link_side">
				<?else:?>
					<a class="pager-link pager-link_side js-pagen-next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageNomer"]+1?>">
				<?endif?>
					<i class="pager-icon fa fa-arrow-right"></i>
				<?if($arResult['NavPageNomer'] == $arResult["NavPageCount"]):?>
					</span>
				<?else:?>
					</a>
				<?endif?>
			</li>
		</ul>
	</div>
</div>