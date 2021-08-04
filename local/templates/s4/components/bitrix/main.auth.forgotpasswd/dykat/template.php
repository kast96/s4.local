<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<form class="mob-form-element js-form-validate js-form js-form-ajax" name="bform" method="post" target="_top" action="<?=POST_FORM_ACTION_URI?>">
	<?=bitrix_sessid_post()?>
	<?if ($USER->isAuthorized()):?>
		<div class="alert alert-success"><?=Loc::getMessage('MAIN_AUTH_PWD_SUCCESS')?></div>
	<?else:?>
		<?if(!empty($arResult["ERRORS"])):?>
			<div class="alert alert-danger"><?=implode('<br>', $arResult['ERRORS'])?></div>
		<?else:?>
			<?if ($arResult['SUCCESS']):?>
				<div class="alert alert-success"><?=$arResult['SUCCESS']?></div>
			<?else:?>
				<div class="mob-form-content js-custom-scroll">
					<div class="mob-form-body mob-form-container">
						<div class="field js-form-validate-field">
							<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
								<label class="field-label JS-FieldText-Label" for="login"><?=Loc::getMessage('MAIN_AUTH_PWD_FIELD_EMAIL');?></label>
								<input class="input JS-FieldText-Input" type="text" placeholder="" id="login" name="<?=$arResult['FIELDS']['email']?>" value="<?=\htmlspecialcharsbx($arResult['LAST_LOGIN'])?>" />
							</span>
						</div>

						<?if($arResult['CAPTCHA_CODE']):?>
							<div class="mf-captcha field">
								<input type="hidden" name="captcha_sid" value="<?=\htmlspecialcharsbx($arResult['CAPTCHA_CODE'])?>">
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?=\htmlspecialcharsbx($arResult['CAPTCHA_CODE'])?>" width="180" height="40" alt="CAPTCHA">
								<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
									<label class="field-label JS-FieldText-Label" for="captcha_word"><?=Loc::getMessage("MAIN_AUTH_PWD_FIELD_CAPTCHA")?> <span class="field-label-required">*</span></label>
									<input class="input JS-FieldText-Input" type="text" id="captcha_word" name="captcha_word" size="30" maxlength="50" value="" autocomplete="off">
								</span>
							</div>
						<?endif?>

						<div class="field-button">
							<input type="hidden" name="<?=$arResult['FIELDS']['action']?>" value="1">
							<button class="popup-button button button_dark submit js-form-button"><?=Loc::getMessage("MAIN_AUTH_PWD_FIELD_SUBMIT")?></button>
						</div>
					</div>

					<div class="mob-form-footer mob-form-container">
						<a class="mob-form-registration-link js-popup-profile" href="javascript:;" data-src="/ajax/login.php"><?=Loc::getMessage('AUTH')?></a>
					</div>
				</div>
			<?endif?>
		<?endif?>
	<?endif?>
</form>