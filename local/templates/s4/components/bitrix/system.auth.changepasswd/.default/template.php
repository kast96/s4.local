<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$APPLICATION->SetTitle('Смена пароля');

if($arResult["PHONE_REGISTRATION"])
{
	CJSCore::Init('phone_auth');
}
?>

<div class="bx-auth">
	<?
	if ($arParams["~AUTH_RESULT"]):?>
		<div class="alert alert-success"><?=$arParams["~AUTH_RESULT"]?></div>
	<?endif?>

	<?if($arResult["SHOW_FORM"]):?>
		<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">
			<?if ($arResult["BACKURL"] <> ''): ?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<? endif ?>
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="CHANGE_PWD">

			<div class="mob-form-body mob-form-container">
				<?if($arResult["PHONE_REGISTRATION"]):?>
					<div class="field js-form-validate-field">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="phone"><?=Loc::getMessage('sys_auth_chpass_phone_number')?></label>
							<input class="input JS-FieldText-Input bx-auth-input" type="text" placeholder="" id="phone" value="<?=\htmlspecialcharsbx($arResult['USER_PHONE_NUMBER'])?>" disabled="disabled" />
							<input type="hidden" name="USER_PHONE_NUMBER" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" />
						</span>
					</div>

					<div class="field js-form-validate-field">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="USER_CHECKWORD"><?=Loc::getMessage('sys_auth_chpass_code')?> <span class="field-label-required">*</span></label>
							<input class="input JS-FieldText-Input bx-auth-input" type="text" placeholder="" id="USER_CHECKWORD" name="USER_CHECKWORD" value="<?=$arResult["USER_CHECKWORD"]?>" autocomplete="off" />
							<input type="hidden" name="USER_PHONE_NUMBER" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" />
						</span>
					</div>
				<?else:?>
					<div class="field js-form-validate-field">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="USER_LOGIN"><?=Loc::getMessage('AUTH_LOGIN')?></label>
							<input class="input JS-FieldText-Input bx-auth-input" type="text" placeholder="" id="USER_LOGIN" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" />
						</span>
					</div>

					<?if($arResult["USE_PASSWORD"]):?>
						<div class="field js-form-validate-field">
							<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
								<label class="field-label JS-FieldText-Label" for="USER_CURRENT_PASSWORD"><?=Loc::getMessage('sys_auth_changr_pass_current_pass')?> <span class="field-label-required">*</span></label>
								<input class="input JS-FieldText-Input bx-auth-input" type="password" placeholder="" id="USER_CURRENT_PASSWORD" name="USER_CURRENT_PASSWORD" value="<?=$arResult["USER_CURRENT_PASSWORD"]?>" maxlength="255" autocomplete="new-password" />
							</span>
						</div>
					<?else:?>
						<div class="field js-form-validate-field">
							<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
								<label class="field-label JS-FieldText-Label" for="USER_CHECKWORD"><?=Loc::getMessage('AUTH_CHECKWORD')?> <span class="field-label-required">*</span></label>
								<input class="input JS-FieldText-Input bx-auth-input" type="text" placeholder="" id="USER_CHECKWORD" name="USER_CHECKWORD" value="<?=$arResult["USER_CHECKWORD"]?>" autocomplete="off" />
							</span>
						</div>
					<?endif?>
				<?endif?>

				<div class="field js-form-validate-field">
					<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
						<label class="field-label JS-FieldText-Label" for="USER_PASSWORD"><?=Loc::getMessage('AUTH_NEW_PASSWORD_REQ')?> <span class="field-label-required">*</span></label>
						<input class="input JS-FieldText-Input bx-auth-input" type="password" placeholder="" id="USER_PASSWORD" name="USER_PASSWORD" value="<?=$arResult["USER_PASSWORD"]?>" maxlength="255" autocomplete="new-password" />
					</span>
				</div>

				<div class="field js-form-validate-field">
					<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
						<label class="field-label JS-FieldText-Label" for="USER_CONFIRM_PASSWORD"><?=Loc::getMessage('AUTH_NEW_PASSWORD_CONFIRM')?> <span class="field-label-required">*</span></label>
						<input class="input JS-FieldText-Input bx-auth-input" type="password" placeholder="" id="USER_CONFIRM_PASSWORD" name="USER_CONFIRM_PASSWORD" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" maxlength="255" autocomplete="new-password" />
					</span>
				</div>

				<?if($arResult['USE_CAPTCHA']):?>
					<div class="mf-captcha field">
						<input type="hidden" name="captcha_sid" value="<?=\htmlspecialcharsbx($arResult['CAPTCHA_CODE'])?>">
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=\htmlspecialcharsbx($arResult['CAPTCHA_CODE'])?>" width="180" height="40" alt="CAPTCHA">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="captcha_word"><?=Loc::getMessage("system_auth_captcha")?> <span class="field-label-required">*</span></label>
							<input class="input JS-FieldText-Input" type="text" id="captcha_word" name="captcha_word" size="30" maxlength="50" value="" autocomplete="off">
						</span>
					</div>
				<?endif?>

				<div class="field-button">
					<input type="hidden" name="change_pwd" value="1">
					<button class="popup-button button button_dark submit js-form-button"><?=Loc::getMessage("AUTH_CHANGE")?></button>
				</div>
			</div>
		</form>

		<p><?=$arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]?></p>
		<p><span class="starrequired">*</span><?=Loc::getMessage("AUTH_REQ")?></p>

		<?if($arResult["PHONE_REGISTRATION"]):?>
			<script type="text/javascript">
				new BX.PhoneAuth({
					containerId: 'bx_chpass_resend',
					errorContainerId: 'bx_chpass_error',
					interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
					data:
						<?=CUtil::PhpToJSObject([
							'signedData' => $arResult["SIGNED_DATA"]
						])?>,
					onError:
						function(response)
						{
							var errorDiv = BX('bx_chpass_error');
							var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
							errorNode.innerHTML = '';
							for(var i = 0; i < response.errors.length; i++)
							{
								errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
							}
							errorDiv.style.display = '';
						}
				});
			</script>

			<div id="bx_chpass_error" style="display:none"><?ShowError("error")?></div>
			<div id="bx_chpass_resend"></div>
		<?endif?>

	<?endif?>

	<a class="user-link js-popup-profile" href="javascript:;" data-src="/ajax/login.php">
		<b><?=Loc::getMessage("AUTH_AUTH")?></b>
	</a>
</div>