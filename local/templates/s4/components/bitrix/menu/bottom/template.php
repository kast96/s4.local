<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul class="footer-menu">
		<?foreach($arResult as $arItem):?>
			<?if($arItem['DEPTH_LEVEL'] > 1) continue;?>
			<li class="footer-menu-item">
				<a class="footer-menu-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
			</li>
		<?endforeach?>
	</ul>
<?endif?>