<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if (!empty($arResult)):?>
	<ul class="sub-menu-list scrollbar JS-Menu" data-menu="{
		'classActive': 'sub-menu-item_active'
	}">
		<?foreach($arResult as $arItem):?>
			<li class="sub-menu-item JS-Menu-Item">
				<a class="sub-menu-link" href="<?=$arItem["LINK"]?>">
					<span class="sub-menu-picture">
						<?if($arItem['PARAMS']['UF_FIELDS']['UF_SVG_ID']):?>
							<svg><use xlink:href="#cream-fillings-catalog-icon"></use></svg>
						<?endif?>
					</span>
					<?=$arItem["TEXT"]?>
					<i class="sub-menu-icon menu-icon fas fa-angle-right"></i>
				</a>
				<?if($arItem["CHILD"]):?>
					<div class="menu scrollbar<?=($arItem['BANNER'])?'':' menu_wide'?>">
						<div class="menu-block">
							<div class="menu-col-list">
								<span class="menu-title"><?=$arItem["TEXT"]?></span>
								<div class="menu-list js-mozaic">
									<?foreach ($arItem["CHILD"] as $arSubItem):?>
										<div class="menu-item js-mozaic-item">
											<a class="menu-link" href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
											<ul class="menu-category">
												<?foreach ($arSubItem["CHILD"] as $arSubItem2):?>
													<li class="menu-category-item">
														<a class="menu-category-link" href="<?=$arSubItem2["LINK"]?>"><?=$arSubItem2["TEXT"]?></a>
													</li>
												<?endforeach?>
											</ul>
										</div>
									<?endforeach?>
								</div>
							</div>
							<?if($arItem['BANNER']):?>
								<div class="menu-col-banner">
									<a href="<?=$arItem['BANNER']['PROPERTY_LINK_VALUE']?>" class="banner block more-item">
										<span class="banner-content">
											<span class="banner-text">
												<span class="banner-title"><?=$arItem['BANNER']['NAME']?></span>
												<span class="banner-description"><?=$arItem['BANNER']['PREVIEW_TEXT']?></span>
											</span>
											<img class="banner-img" src="<?=CFile::GetPath($arItem['BANNER']['PREVIEW_PICTURE'])?>" alt="<?=$arItem['BANNER']['NAME']?>" />
											<span class="banner-more more"><i class="more-icon las la-arrow-right"></i></span>
											<span class="banner-more more-link more-link_narrow button">
												<span class="more-label"><?=Loc::getMessage('DETAILS')?></span>
												<span class="more"><i class="more-icon las la-arrow-right"></i></span>
											</span>
										</span>
									</a>
								</div>
							<?endif?>
						</div>
					</div>
				<?endif?>
			</li>
		<?endforeach?>
	</ul>
<?endif?>