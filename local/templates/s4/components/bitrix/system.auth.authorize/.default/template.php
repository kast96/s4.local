<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>
<div class="bx-auth js-form auth-form">
	<?if($arParams["AUTH_RESULT"]["TYPE"] == 'SUCCESS'):?>
		<div class="alert alert-success"><?=$arParams["~AUTH_RESULT"]["MESSAGE"]?></div>
	<?else:?>
		<?if ($arParams["AUTH_RESULT"]["TYPE"] == 'ERROR'):?>
			<div class="alert alert-danger"><?=$arParams["~AUTH_RESULT"]["MESSAGE"]?></div>
		<?endif?>

		<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="AUTH" />
			<?if ($arResult["BACKURL"] <> ''):?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif?>
			<?foreach ($arResult["POST"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>

			<div class="mob-form-body mob-form-container">
				<div class="field js-form-validate-field">
					<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
						<label class="field-label JS-FieldText-Label" for="USER_LOGIN"><?=Loc::getMessage('AUTH_LOGIN')?></label>
						<input class="input JS-FieldText-Input bx-auth-input" type="text" placeholder="" id="USER_LOGIN" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>"  maxlength="255" />
					</span>
				</div>

				<div class="field js-form-validate-field">
					<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
						<label class="field-label JS-FieldText-Label" for="USER_PASSWORD"><?=Loc::getMessage('AUTH_PASSWORD')?></label>
						<input class="input JS-FieldText-Input bx-auth-input" type="password" placeholder="" id="USER_PASSWORD" name="USER_PASSWORD"  maxlength="255" autocomplete="off" />
					</span>
				</div>

				<?if($arResult['CAPTCHA_CODE']):?>
					<div class="mf-captcha field">
						<input type="hidden" name="captcha_sid" value="<?=\htmlspecialcharsbx($arResult['CAPTCHA_CODE'])?>">
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=\htmlspecialcharsbx($arResult['CAPTCHA_CODE'])?>" width="180" height="40" alt="CAPTCHA">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="captcha_word"><?=Loc::getMessage("AUTH_CAPTCHA_PROMT")?> <span class="field-label-required">*</span></label>
							<input class="input JS-FieldText-Input" type="text" id="captcha_word" name="captcha_word" size="30" maxlength="50" value="" autocomplete="off">
						</span>
					</div>
				<?endif?>
				
				<?if ($arResult['STORE_PASSWORD'] == 'Y'):?>
					<?/*
					<div class="field field-remember">
						<label class="field-remember-label checkbox-field">
							<span class="checkbox">
								<input class="checkbox-input" type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" checked="checked" />
								<i class="checkbox-check fa fa-check" aria-hidden="true"></i>
							</span>
							<span class="field-remember-text"><?=Loc::getMessage('AUTH_REMEMBER_ME')?></span>
						</label>
					</div>
					*/?>
					<div class="field field-remember field_simple">
						<label class="switch">
							<input class="switch-checkbox" type="checkbox" name="USER_REMEMBER" value="Y" checked="checked" />
							<span class="switch-decor">
								<span class="switch-icon"></span>
							</span>
							<span class="field-remember-label switch-label"><?=Loc::getMessage("AUTH_REMEMBER_ME")?></span>
						</label>
					</div>
				<?endif?>

				<div class="field field_simple">
					<label class="switch">
						<input class="switch-checkbox js-form-checkbox" type="checkbox" name="agreement" checked="checked" />
						<span class="switch-decor">
							<span class="switch-icon"></span>
						</span>
						<span class="switch-label"><?=Loc::getMessage("AUTH_I_AGREE_POLITIC")?> <a class="switch-label-link" target="_blank" href="<?=CKastS4::GetOption('policy_link')?>"><?=Loc::getMessage("AUTH_AGREE_POLITIC_NAME")?></a></span>
					</label>
				</div>

				<div class="field-button">
					<input type="hidden" name="Login" value="1">
					<button class="popup-button button button_dark submit js-form-button"><?=Loc::getMessage("AUTH_AUTHORIZE")?></button>
				</div>
			</div>

			<?if ($arResult['AUTH_SERVICES']):?>
				<?$APPLICATION->IncludeComponent(
					'bitrix:socserv.auth.form',
					'',
					array(
						'AUTH_SERVICES' => $arResult['AUTH_SERVICES'],
						'AUTH_URL' => $arResult['CURR_URI']
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);?>
			<?endif?>
		</form>
	<?endif?>
</div>


