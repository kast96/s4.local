<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult['ITEMS']):?>
	<ul class="serv-sections-list row">
		<?foreach ($arResult['ITEMS'] as $arItem):?>
			<li class="serv-sections-list-item col-md-6 col-lg-3 JS-Dropdown" data-dropdown="{'classActive': 'serv-sections-list-item_active'}">
				<div class="serv-sections-list-block">
					<a class="serv-sections-list-link block-simple JS-Dropdown-Switcher" href="javascript:;">
						<span class="serv-sections-list-box">
							<span class="serv-sections-icon">
								<svg class="serv-sections-svg"><use xlink:href="#<?=$arItem['PROPERTIES']['SVG_ICON']['VALUE']?>"></use></svg>
							</span>
							<span class="serv-sections-name"><?=$arItem['NAME']?></span>
							<i class="serv-sections-arrow las la-arrow-right"></i>
						</span>
					</a>
					<div class="serv-sections-list-detail block-simple JS-Dropdown-Menu">
						<span class="serv-sections-name serv-sections-name_add"><?=$arItem['NAME']?></span>
						<?if($arItem['PREVIEW_TEXT']):?>
							<div class="serv-sections-description"><?=$arItem['PREVIEW_TEXT']?></div>
						<?endif?>
						<?if (($arItem['PROPERTIES']['BTN_NAME']['VALUE'] && $arItem['PROPERTIES']['BTN_LINK']['VALUE']) || ($arItem['PROPERTIES']['BTN_NAME2']['VALUE'] && $arItem['PROPERTIES']['BTN_LINK2']['VALUE']))?>
						<ul class="serv-sections-buttons">
							<?if ($arItem['PROPERTIES']['BTN_NAME']['VALUE'] && $arItem['PROPERTIES']['BTN_LINK']['VALUE']):?>
								<li class="serv-sections-button">
									<a class="serv-sections-link button" href="<?=$arItem['PROPERTIES']['BTN_LINK']['VALUE']?>"><?=$arItem['PROPERTIES']['BTN_NAME']['VALUE']?></a>
								</li>
							<?endif?>
							<?if ($arItem['PROPERTIES']['BTN_NAME2']['VALUE'] && $arItem['PROPERTIES']['BTN_LINK2']['VALUE']):?>
								<li class="serv-sections-button">
									<a class="serv-sections-link button" href="<?=$arItem['PROPERTIES']['BTN_LINK2']['VALUE']?>"><?=$arItem['PROPERTIES']['BTN_NAME2']['VALUE']?></a>
								</li>
							<?endif?>
						</ul>
						<a class="serv-sections-close JS-Dropdown-Close" href="javascript:;">
							<i class="serv-sections-close-icon las la-times"></i>
						</a>
					</div>
				</div>
			</li>
		<?endforeach?>
	</ul>
<?endif?>