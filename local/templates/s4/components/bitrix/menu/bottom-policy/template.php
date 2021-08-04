<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul class="footer-policy footer-list <?=$arParams['CLASSES']?>">
		<?foreach($arResult as $arItem):?>
			<?if($arItem['DEPTH_LEVEL'] > 1) continue;?>
			<li class="footer-list-item">
				<a class="footer-list-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
			</li>
		<?endforeach?>
	</ul>
<?endif?>