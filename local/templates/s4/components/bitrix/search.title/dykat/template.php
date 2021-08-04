<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if($INPUT_ID == '')
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if($CONTAINER_ID == '')
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

$INPUT_CATEGORY_ID = trim($arParams["~INPUT_CATEGORY_ID"]);
if($INPUT_CATEGORY_ID == '')
	$INPUT_CATEGORY_ID = "title-search-category";
$INPUT_CATEGORY_ID = CUtil::JSEscape($INPUT_CATEGORY_ID);

$SEARCH_RESULT_ID = trim($arParams["~SEARCH_RESULT_ID"]);
if($SEARCH_RESULT_ID == '')
	$SEARCH_RESULT_ID = "search-result";
$SEARCH_RESULT_ID = CUtil::JSEscape($SEARCH_RESULT_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
	<?if($arParams['IS_MOBILE'] == 'Y'):?>
		<div id="<?=$CONTAINER_ID?>" class="js-search" data-search-dynamic="search_dynamic">
	<?else:?>
		<div id="<?=$CONTAINER_ID?>" class="header-search search js-search JS-DropSearch-Search" data-search-dynamic="search_dynamic" data-dropsearch="{
			'classActive': 'header-search_active',
			'classShow': 'header-search-show'
		}">
	<?endif?>
		<form class="search-form JS-Voice" action="<?=$arResult["FORM_ACTION"]?>">
			<div class="search-container">
				<input id="<?=$INPUT_ID?>" class="search-input input js-search-input JS-DropSearch-Switcher JS-Voice-Input" type="text" name="q" value="" placeholder="" maxlength="50" autocomplete="off" />
				<a class="search-reset search-item js-search-reset" href="javascript:;">
					<i class="search-reset-icon las la-times"></i>
				</a>
				<?if($arParams['NUM_CATEGORIES']):?>
					<div class="search-select">
						<select id="<?=$INPUT_CATEGORY_ID?>" name="category" class="select js-select">
							<option value="all" selected="selected"><?=Loc::getMessage('ALL_CATEGORIES')?></option>
							<?for ($i=0; $i < $arParams['NUM_CATEGORIES']; $i++):?>
								<option value="<?=$i?>"><?=($arParams['CATEGORY_'.$i.'_TITLE'])?:$arParams['CATEGORY_'.$i]?></option>
							<?endfor?>
						</select>
					</div>
				<?endif?>
				<a class="search-microphone JS-Voice-Trigger voice-icon" href="javascript:;"><i class="las la-microphone"></i></a>
				<button class="search-button" name="s" type="submit">
					<i class="search-icon las la-search"></i>
				</button>
			</div>
		</form>
		<div id="<?=$SEARCH_RESULT_ID?>" class="search-result"></div>
	</div>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearchCustom({
			'AJAX_PAGE' : '<?=CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?=$CONTAINER_ID?>',
			'SEARCH_RESULT_ID': '<?=$SEARCH_RESULT_ID?>',
			'INPUT_ID': '<?=$INPUT_ID?>',
			'INPUT_CATEGORY_ID': '<?=$INPUT_CATEGORY_ID?>',
			'MIN_QUERY_LEN': 2,
			'PARAMS': <?=CUtil::PhpToJSObject(array(
				'CATALOG_IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'],
				'MAX_VIEW_RESULTS' => $arParams['MAX_VIEW_RESULTS'],
				'MAX_VIEW_CATEGORIES' => $arParams['MAX_VIEW_CATEGORIES'],
				'MAX_VIEW_POPULAR' => $arParams['MAX_VIEW_POPULAR'],
				'MAX_VIEW_BRANDS' => $arParams['MAX_VIEW_BRANDS'],
			))?>
		});
	});
</script>
