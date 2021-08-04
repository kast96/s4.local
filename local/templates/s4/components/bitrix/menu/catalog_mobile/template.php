<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if (!empty($arResult)):?>
	<ul class="mob-list mob-list-child">
		<?foreach($arResult as $arItem):?>
			<li class="mob-list-item mob-list-item_category">
				<a class="mob-list-link <?if($arItem["CHILD"]):?>JS-MobileMenu-Parent<?endif?>" href="<?=$arItem["LINK"]?>">
					<span class="mob-list-picture">
						<?if($arItem['PARAMS']['UF_FIELDS']['UF_SVG_ID']):?>
							<svg><use xlink:href="#<?=$arItem['PARAMS']['UF_FIELDS']['UF_SVG_ID']?>"></use></svg>
						<?endif?>
					</span>
					<?=$arItem["TEXT"]?><?if($arItem["CHILD"]):?><i class="mob-list-icon fa fa-angle-right" aria-hidden="true"></i><?endif?>
				</a>
				<?if($arItem["CHILD"]):?>
					<div class="mob-child JS-MobileMenu-Child">
						<a class="mob-list-link mob-list-link_back JS-MobileMenu-Back" href="javascript:;">
							<span><i class="mob-back-icon las la-arrow-left"></i><?=Loc::getMessage('BACK')?></span>
						</a>
						<span class="mob-list-current"><?=$arItem["TEXT"]?></span>
						<ul class="mob-list mob-list-child">
							<?foreach($arItem['CHILD'] as $arSubItem):?>
								<li class="mob-list-item">
									<a class="mob-list-child-link" href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
								</li>
							<?endforeach?>
						</ul>
					</div>
				<?endif?>
			</li>
		<?endforeach?>
	</ul>
<?endif?>