<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!$arResult['CURRENT_SITE']) return;
?>

<a class="header-menu-link<?if ($arResult["SITES"]):?> JS-Dropdown-Switcher<?endif?>" href="javascript:;">
	<?if (file_exists($_SERVER['DOCUMENT_ROOT'].'/images/common/icons/lang/'.$arResult['CURRENT_SITE']["LANG"].'-icon.png')):?>
    	<img class="lang-icon" src="/images/common/icons/lang/<?=$arResult['CURRENT_SITE']["LANG"]?>-icon.png" alt="" />
	<?endif?>
    <?=$arResult['CURRENT_SITE']["NAME"]?>
	<?if ($arResult["SITES"]):?>
		<i class="header-menu-icon fa fa-angle-down"></i>
	<?endif?>
</a>

<?if ($arResult["SITES"]):?>
	<div class="header-dropdown-menu JS-Dropdown-Menu">
		<ul class="header-dropdown-list">
			<?foreach ($arResult["SITES"] as $arSite):?>
				<li class="header-dropdown-item">
					<a class="header-dropdown-link" href="<?if(is_array($arSite['DOMAINS']) && $arSite['DOMAINS'][0] <> '' || $arSite['DOMAINS'] <> ''):?>http://<?endif?><?=(is_array($arSite["DOMAINS"]) ? $arSite["DOMAINS"][0] : $arSite["DOMAINS"])?><?=$arSite["DIR"]?>">
						<?if (file_exists($_SERVER['DOCUMENT_ROOT'].'/images/common/icons/lang/'.$arSite["LANG"].'-icon.png')):?>
							<img class="lang-icon" src="/images/common/icons/lang/<?=$arSite["LANG"]?>-icon.png" alt="" />
						<?endif?>
						<?=$arSite["NAME"]?>
					</a>
				</li>
			<?endforeach?>
		</ul>
	</div>
<?endif?>