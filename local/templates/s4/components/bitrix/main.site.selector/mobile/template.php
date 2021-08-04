<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult["SITES"]):?>
	<ul class="mob-lang">
		<?foreach ($arResult["SITES"] as $arSite):?>
			<li class="mob-lang-item">
				<a class="mob-lang-link<?if($arSite['CURRENT'] == 'Y'):?> mob-lang-link_active<?endif?>" href="<?if(is_array($arSite['DOMAINS']) && $arSite['DOMAINS'][0] <> '' || $arSite['DOMAINS'] <> ''):?>http://<?endif?><?=(is_array($arSite["DOMAINS"]) ? $arSite["DOMAINS"][0] : $arSite["DOMAINS"])?><?=$arSite["DIR"]?>">
					<?if (file_exists($_SERVER['DOCUMENT_ROOT'].'/images/common/icons/lang/'.$arSite["LANG"].'-icon.png')):?>
						<img class="mob-lang-icon lang-icon" src="/images/common/icons/lang/<?=$arSite["LANG"]?>-icon.png" alt="" />
					<?endif?>
					<?=$arSite["NAME"]?>
				</a>
			</li>
		<?endforeach?>
	</ul>
<?endif?>