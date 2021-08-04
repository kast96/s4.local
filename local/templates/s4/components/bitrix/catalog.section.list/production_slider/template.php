<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if($arResult['SECTIONS']):?>
	<ul class="category-list row">
		<?foreach($arResult['SECTIONS'] as $arSection):?>
			<li class="category-list-item col-6 col-md-3">
				<a class="category-list-link block" href="<?=$arSection['SECTION_PAGE_URL']?>">
					<span class="category-list-box">
						<?if ($arSection['UF_SVG_ICON']):?>
							<span class="category-icon">
								<svg class="category-svg"><use xlink:href="#<?=$arSection['UF_SVG_ICON']?>"></use></svg>
							</span>
						<?endif?>
						<span class="category-name"><?=$arSection['NAME']?></span>
					</span>
				</a>
			</li>
		<?endforeach?>
		<li class="category-list-item col-6 col-md-3">
			<a class="category-list-link block" href="<?=$arResult['SECTION']['SECTION_PAGE_URL']?>">
				<span class="category-list-box">
					<span class="category-icon">
						<svg class="category-svg"><use xlink:href="#see-all-category-icon"></use></svg>
					</span>
					<span class="category-name"><?=Loc::getMessage('SHOW_ALL')?></span>
				</span>
			</a>
		</li>
	</ul>
<?endif?>