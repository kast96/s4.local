<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul class="header-nav header-menu header-nav-sites">
		<?foreach($arResult as $arItem):?>
			<li class="header-menu-item">
				<a class="header-menu-link" href="<?=$arItem['LINK']?>">
					<?=$arItem["TEXT"]?>
					<?if($arItem["CHILD"]):?>
						<i class="header-menu-icon fa fa-angle-down"></i>
					<?endif?>
				</a>
				<?if($arItem["CHILD"]):?>
					<div class="header-dropdown-menu">
						<ul class="header-dropdown-list">
							<?foreach($arItem['CHILD'] as $arSubItem):?>
								<li class="header-dropdown-item">
									<a class="header-dropdown-link" href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
								</li>
							<?endforeach?>
						</ul>
					</div>
				<?endif?>
			</li>
		<?endforeach?>
	</ul>
<?endif?>