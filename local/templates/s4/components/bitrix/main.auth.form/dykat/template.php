<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);
Loader::includeSharewareModule('ewp.dykat');

global $USER;
?>

<form class="mob-form-element js-form-validate js-form js-form-ajax" name="<?=$arResult['FORM_ID']?>" method="post" target="_top" action="<?=POST_FORM_ACTION_URI?>">
	<?=bitrix_sessid_post()?>
	<?if ($USER->isAuthorized()):?>
		<div class="alert alert-success"><?=Loc::getMessage('MAIN_AUTH_FORM_FIELD_SUCCESS')?></div>
		<script>
			setTimeout(() => {
				document.location.reload();
			}, 1000);
		</script>
	<?else:?>
		<?if(!empty($arResult["ERRORS"])):?>
			<div class="alert alert-danger"><?=implode('<br>', $arResult['ERRORS'])?></div>
		<?endif?>

		<div class="mob-form-content js-custom-scroll">
			<div class="mob-form-body mob-form-container">
				<div class="field js-form-validate-field">
					<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
						<label class="field-label JS-FieldText-Label" for="login"><?=Loc::getMessage('MAIN_AUTH_FORM_FIELD_LOGIN');?> <span class="field-label-required">*</span></label>
						<input class="input JS-FieldText-Input" type="text" placeholder="" id="login" name="<?=$arResult['FIELDS']['login']?>" value="<?=\htmlspecialcharsbx($arResult['LAST_LOGIN'])?>" required />
					</span>
				</div>
				<div class="field field_simple js-form-validate-field">
					<span class="field-input js-password JS-FieldText"
						data-fieldtext="{'classActive':'field-input_active'}"
						data-password="field-password-active"
					>
						<label class="field-label JS-FieldText-Label" for="password"><?=Loc::getMessage('MAIN_AUTH_FORM_FIELD_PASS')?> <span class="field-label-required">*</span></label>
						<input class="input js-password-input JS-FieldText-Input" type="password" name="<?=$arResult['FIELDS']['password']?>" placeholder="" id="password" autocomplete="off" required />
						<a class="js-password-link" href="javascript:;">
							<i class="eye-icon eye-icon_hide las la-eye-slash"></i>
							<i class="eye-icon eye-icon_show las la-eye"></i>
						</a>
					</span>
				</div>

				<?if($arResult['CAPTCHA_CODE']):?>
					<div class="mf-captcha field">
						<input type="hidden" name="captcha_sid" value="<?=\htmlspecialcharsbx($arResult['CAPTCHA_CODE'])?>">
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=\htmlspecialcharsbx($arResult['CAPTCHA_CODE'])?>" width="180" height="40" alt="CAPTCHA">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="captcha_word"><?=Loc::getMessage("MAIN_AUTH_FORM_FIELD_CAPTCHA")?> <span class="field-label-required">*</span></label>
							<input class="input JS-FieldText-Input" type="text" id="captcha_word" name="captcha_word" size="30" maxlength="50" value="" autocomplete="off">
						</span>
					</div>
				<?endif?>

				<?if ($arResult['STORE_PASSWORD'] == 'Y'):?>
					<div class="field field-remember">
						<label class="field-remember-label checkbox-field">
							<span class="checkbox">
								<input class="checkbox-input" type="checkbox" id="USER_REMEMBER" name="<?=$arResult['FIELDS']['remember']?>" value="Y" checked="checked" />
								<i class="checkbox-check fa fa-check" aria-hidden="true"></i>
							</span>
							<span class="field-remember-text"><?=Loc::getMessage('MAIN_AUTH_FORM_FIELD_REMEMBER')?></span>
						</label>
						<a class="field-remember-link js-open-password" href="javascript:;" data-src="/ajax/forgot.php"><?=Loc::getMessage('MAIN_AUTH_FORM_FIELD_NO_REMEMBER_PASSWORD')?></a>
					</div>
				<?endif?>

				<div class="field field_simple">
					<label class="switch">
						<input class="switch-checkbox js-form-checkbox" type="checkbox" name="agreement" checked="checked" />
						<span class="switch-decor">
							<span class="switch-icon"></span>
						</span>
						<span class="switch-label"><?=Loc::getMessage("MAIN_AUTH_FORM_FIELD_I_AGREE_POLITIC")?> <a class="switch-label-link" target="_blank" href="<?=CEwpDykat::GetOption('policy_link')?>"><?=Loc::getMessage("MAIN_AUTH_FORM_FIELD_AGREE_POLITIC_NAME")?></a></span>
					</label>
				</div>
				
				<div class="field-button">
					<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
					<input type="hidden" name="<?=$arResult['FIELDS']['action']?>" value="1">
					<button class="popup-button button button_dark submit js-form-button"><?=Loc::getMessage("MAIN_AUTH_FORM_FIELD_SUBMIT")?></button>
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

			<div class="socials-login mob-form-container">
				<span class="socials-login-title">Войти как пользователь</span>
				<ul class="socials-login-list">
					<li class="socials-login-item">
						<a class="socials-login-link" href="#">
							<i class="socials-login-icon fab fa-vk"></i>ВКонтакте
						</a>
					</li>
					<li class="socials-login-item">
						<a class="socials-login-link" href="#">
							<i class="socials-login-icon socials-login-icon_fb fab fa-facebook-f"></i>Facebook
						</a>
					</li>
					<li class="socials-login-item">
						<a class="socials-login-link" href="#">
							<i class="socials-login-icon socials-login-icon_ok fab fa-odnoklassniki"></i>Odnoklassniki
						</a>
					</li>
					<li class="socials-login-item">
						<a class="socials-login-link" href="#">
							<i class="socials-login-icon socials-login-icon_google"></i>Google
						</a>
					</li>
				</ul>
			</div>

			<div class="mob-form-footer mob-form-container">
				<a class="mob-form-registration-link js-popup-reg" href="javascript:;" data-src="/ajax/registration.php"><?=Loc::getMessage('REGISTER')?></a>
			</div>
		</div>
	<?endif?>
</form>

<?/*


<div class="bx-authform">

	<?if ($arResult['AUTH_SERVICES']):?>
		<?$APPLICATION->IncludeComponent('bitrix:socserv.auth.form',
			'flat',
			array(
				'AUTH_SERVICES' => $arResult['AUTH_SERVICES'],
				'AUTH_URL' => $arResult['CURR_URI']
	   		),
			$component,
			array('HIDE_ICONS' => 'Y')
		);
		?>
		<hr class="bxe-light">
	<?endif?>

	<form name="<?= $arResult['FORM_ID'];?>" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>">

		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?=Loc::getMessage('MAIN_AUTH_FORM_FIELD_LOGIN');?></div>
			<div class="bx-authform-input-container">
				<input type="text" name="<?= $arResult['FIELDS']['login'];?>" maxlength="255" value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>" />
			</div>
		</div>

		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_PASS');?></div>
			<div class="bx-authform-input-container">
				<?if ($arResult['SECURE_AUTH']):?>
					<div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none">
						<div class="bx-authform-psw-protected-desc"><span></span>
							<?= Loc::getMessage('MAIN_AUTH_FORM_SECURE_NOTE');?>
						</div>
					</div>
					<script type="text/javascript">
						document.getElementById('bx_auth_secure').style.display = '';
					</script>
				<?endif?>
				<input type="password" name="<?= $arResult['FIELDS']['password'];?>" maxlength="255" autocomplete="off" />
			</div>
		</div>

		<?if ($arResult['CAPTCHA_CODE']):?>
			<input type="hidden" name="captcha_sid" value="<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" />
			<div class="bx-authform-formgroup-container dbg_captha">
				<div class="bx-authform-label-container">
					<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_CAPTCHA');?>
				</div>
				<div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" width="180" height="40" alt="CAPTCHA" /></div>
				<div class="bx-authform-input-container">
					<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
				</div>
			</div>
		<?endif;?>

		<?if ($arResult['STORE_PASSWORD'] == 'Y'):?>
			<div class="bx-authform-formgroup-container">
				<div class="checkbox">
					<label class="bx-filter-param-label">
						<input type="checkbox" id="USER_REMEMBER" name="<?= $arResult['FIELDS']['remember'];?>" value="Y" />
						<span class="bx-filter-param-text"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_REMEMBER');?></span>
					</label>
				</div>
			</div>
		<?endif?>

		<div class="bx-authform-formgroup-container">
			<input type="submit" class="btn btn-primary" name="<?= $arResult['FIELDS']['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_SUBMIT');?>" />
		</div>

		<?if ($arResult['AUTH_FORGOT_PASSWORD_URL'] || $arResult['AUTH_REGISTER_URL']):?>
			<hr class="bxe-light">
			<noindex>
			<?if ($arResult['AUTH_FORGOT_PASSWORD_URL']):?>
				<div class="bx-authform-link-container">
					<a href="<?= $arResult['AUTH_FORGOT_PASSWORD_URL'];?>" rel="nofollow">
						<?= Loc::getMessage('MAIN_AUTH_FORM_URL_FORGOT_PASSWORD');?>
					</a>
				</div>
			<?endif;?>
			<?if ($arResult['AUTH_REGISTER_URL']):?>
				<div class="bx-authform-link-container">
					<a href="<?= $arResult['AUTH_REGISTER_URL'];?>" rel="nofollow">
						<?= Loc::getMessage('MAIN_AUTH_FORM_URL_REGISTER_URL');?>
					</a>
				</div>
			<?endif;?>
			</noindex>
		<?endif;?>

	</form>
</div>

<script type="text/javascript">
	<?if ($arResult['LAST_LOGIN'] != ''):?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>

*/?>