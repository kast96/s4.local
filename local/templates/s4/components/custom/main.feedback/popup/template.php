<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Loader;
Loader::includeSharewareModule('kast.s4');
?>

<form class="feedback-form js-form-validate js-form js-form-ajax" action="<?=POST_FORM_ACTION_URI?>" method="POST">
	<?=bitrix_sessid_post()?>

	<?if(!empty($arResult["ERROR_MESSAGE"])):?>
		<div class="alert alert-danger"><?=implode('<br>', $arResult['ERROR_MESSAGE'])?></div>
	<?endif?>
	<?if($arResult["OK_MESSAGE"]):?>
		<div class="alert alert-success"><?=$arResult["OK_MESSAGE"]?></div>
	<?endif?>

	<div class="feedback-form-content">
		<?if($arParams['DESCRIPTION']):?>
			<div class="feedback-form-info"><?=$arParams['DESCRIPTION']?></div>
		<?endif?>
			<?if(empty($arParams["SHOW_FIELDS"]) || in_array("NAME", $arParams["SHOW_FIELDS"])):?>
				<div class="field js-form-validate-field">
					<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
						<label class="field-label JS-FieldText-Label" for="user_name"><?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?> <span class="field-label-required">*</span><?endif?></label>
						<input class="input JS-FieldText-Input" type="text" placeholder="" id="user_name" name="user_name"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?> required<?endif?> value="<?=$arResult["AUTHOR_NAME"]?>" />
					</span>
				</div>
			<?endif?>
			<?if(empty($arParams["SHOW_FIELDS"]) || in_array("PHONE", $arParams["SHOW_FIELDS"])):?>
				<div class="field js-form-validate-field">
					<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
						<label class="field-label JS-FieldText-Label" for="user_phone"><?=GetMessage("MFT_PHONE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?> <span class="field-label-required">*</span><?endif?></label>
						<input class="input JS-FieldText-Input js-phone" type="text" placeholder="" id="user_phone" name="user_phone"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?> required<?endif?> value="<?=$arResult["AUTHOR_PHONE"]?>" />
					</span>
				</div>
			<?endif?>
			<?if(empty($arParams["SHOW_FIELDS"]) || in_array("EMAIL", $arParams["SHOW_FIELDS"])):?>
				<div class="field js-form-validate-field">
					<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
						<label class="field-label JS-FieldText-Label" for="user_email"><?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?> <span class="field-label-required">*</span><?endif?></label>
						<input class="input JS-FieldText-Input" type="text" placeholder="" id="user_email" name="user_email"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?> required<?endif?> value="<?=$arResult["AUTHOR_EMAIL"]?>" />
					</span>
				</div>
			<?endif?>
			<?if(empty($arParams["SHOW_FIELDS"]) || in_array("MESSAGE", $arParams["SHOW_FIELDS"])):?>
				<div class="field js-form-validate-field">
					<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
						<label class="field-label JS-FieldText-Label" for="MESSAGE"><?=GetMessage("MFT_MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?> <span class="field-label-required">*</span><?endif?></label>
						<input class="input JS-FieldText-Input" type="text" placeholder="" id="MESSAGE" name="MESSAGE"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?> required<?endif?> value="<?=$arResult["MESSAGE"]?>" />
					</span>
				</div>
			<?endif?>

			<?if($arParams["USE_CAPTCHA"] == "Y"):?>
				<div class="mf-captcha field">
					<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
					<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
						<label class="field-label JS-FieldText-Label" for="captcha_word"><?=GetMessage("MFT_CAPTCHA_CODE")?> <span class="field-label-required">*</span></label>
						<input class="input JS-FieldText-Input" type="text" id="captcha_word" name="captcha_word" size="30" maxlength="50" value="">
					</span>
				</div>
			<?endif;?>

			<div class="field field_simple">
				<label class="switch">
					<input class="switch-checkbox js-form-checkbox" type="checkbox" name="agreement" checked="checked" />
					<span class="switch-decor">
						<span class="switch-icon"></span>
					</span>
					<span class="switch-label"><?=GetMessage("MFT_I_AGREE_POLITIC")?> <a class="switch-label-link" target="_blank" href="<?=CKastS4::GetOption('policy_link')?>"><?=GetMessage("MFT_AGREE_POLITIC_NAME")?></a></span>
				</label>
			</div>
			<div class="field-button">
				<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
				<input type="hidden" name="submit" value="1">
				<button class="callback-form-button button button_dark submit js-form-button"><?=GetMessage("MFT_SUBMIT")?></button>
			</div>
		</div>
	</div>
</form>