<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="search-page js-pagen">
<form class="search-form search-page-form" action="" method="get">
	<div class="search-container">
		<input class="search-input input" type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" placeholder="" maxlength="100" autocomplete="off">
		<button class="search-button" name="s" type="submit">
			<i class="search-icon fa fa-search"></i>
		</button>
		<input type="hidden" name="how" value="<?=($arResult["REQUEST"]["HOW"]=="d") ? "d": "r"?>" />
	</div>
</form>

<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):?>
	<div class="search-language-guess search-page-form-language-guess">
		<div class="alert alert-warning"><?=GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?></div>
	</div>
<?endif?>

<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
<?elseif($arResult["ERROR_CODE"]!=0):?>
	<div class="alert alert-danger">
		<?=GetMessage("SEARCH_ERROR")?>
		<br>
		<?=$arResult["ERROR_TEXT"]?>
		<br>
		<br>
		<?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?>
	</div>
	<?/*
	<p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
	<table border="0" cellpadding="5">
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
			<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
			<td><?=GetMessage("SEARCH_AND_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
			<td><?=GetMessage("SEARCH_OR_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
			<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top">( )</td>
			<td valign="top">&nbsp;</td>
			<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
		</tr>
	</table>
	*/?>
<?elseif(count($arResult["SEARCH"])>0):?>
	<?if($arParams["DISPLAY_TOP_PAGER"] != "N"):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif?>

	<div class="search-page-items js-pagen-content">
		<?foreach($arResult["SEARCH"] as $arItem):?>
			<div class="search-page-item">
				<a class="search-page-title" href="<?=$arItem["URL"]?>"><?=$arItem["TITLE_FORMATED"]?></a>
				<div class="search-page-body"><?echo $arItem["BODY_FORMATED"]?></div>
			</div>
		<?endforeach?>
	</div>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N"):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif?>
<?else:?>
	<div class="alert alert-warning">
		<?=GetMessage("SEARCH_NOTHING_TO_FOUND")?>
	</div>
<?endif?>
</div>