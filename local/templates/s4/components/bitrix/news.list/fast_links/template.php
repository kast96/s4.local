<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult['ITEMS']):?>
	<div class="fast-links">
		<div class="row">
			<div class="col-12 col-xl-5">
				<div class="fast-links-header">
					<h2 class="fast-links-title title">Полезная информация</h2>
					<div class="fast-links-description">Тут какое-то описание для данного раздела</div>
					<div class="fast-links-img d-none d-xl-block">
						<img src="/images/fast-links-img.png" alt="">
					</div>
				</div>
			</div>
			<div class="col-12 col-xl-7">
				<div class="fast-links-body">
					<div class="fast-links-items">
						<div class="row">
							<?foreach($arResult['ITEMS'] as $arItem):?>
								<div class="col-12 col-sm-6 col-md-4 fast-links-item-col">
									<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="fast-links-item">
										<div class="fast-links-item-svg">
											<svg class="icon">
												<use xlink:href="#<?=$arItem['PROPERTIES']['SVG']['VALUE']?>"></use>
											</svg>
										</div>
										<span class="fast-links-item-title"><?=$arItem['NAME']?></span>
									</a>
								</div>
							<?endforeach?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?endif?>