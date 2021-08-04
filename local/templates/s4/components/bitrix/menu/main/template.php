<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if (!empty($arResult)):?>
	<ul class="main-menu-list js-adaptivemenu">
		<?foreach($arResult as $arItem):?>
			<li class="main-menu-item js-adaptivemenu-item<?=($arItem["LINK"] == '/') ? ' main-menu-item-homepage' : ''?>">
				<a class="main-menu-link" href="<?=$arItem["LINK"]?>">
					<?=$arItem["TEXT"]?>
					<?if($arItem["CHILD"]):?>
						<i class="main-menu-icon">
							<i class="fa fa-chevron-down"></i>
						</i>
					<?endif?>
				</a>
				<?if($arItem["CHILD"]):?>
					<div class="menu-simple">
						<div class="menu-simple-container">
							<ul class="menu-simple-list">
								<?foreach($arItem['CHILD'] as $arSubItem):?>
									<li class="menu-simple-item">
										<a class="menu-simple-link" href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
									</li>
								<?endforeach?>
							</ul>
							<?if($arItem['PARAMS']['SHOW_SOCIALS']):?>
								<div class="menu-simple-socials">
									<span class="menu-simple-socials-title"><?=Loc::getMessage('WE_ARE_IN_SOCIAL')?></span>
									<?$APPLICATION->IncludeFile(
										"/include/socials.php",
										array(),
										array("MODE"=>"html")
									);?>
								</div>
							<?endif?>
						</div>
					</div>
				<?endif?>
			</li>
		<?endforeach?>
		
		<li class="main-menu-item main-menu-item_more js-adaptivemenu-more">
			<a class="main-menu-link main-menu-link_more" href="javascript:;">...</a>
			<div class="menu-simple">
				<div class="menu-simple-container">
					<ul class="menu-simple-list menu-simple-list_add js-adaptivemenu-target"></ul>
				</div>
			</div>
		</li>
	</ul>
<?endif?>