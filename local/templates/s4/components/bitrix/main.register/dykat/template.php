<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);
Loader::includeSharewareModule('ewp.dykat');
?>

<form class="mob-form-element js-form-validate js-form js-form-ajax" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
	<?if ($USER->isAuthorized()):?>
		<div class="alert alert-success"><?=Loc::getMessage('MAIN_REGISTER_AUTH')?></div>
		<script>
			setTimeout(() => {
				document.location.reload();
			}, 1000);
		</script>
	<?else:?>
		<?if (count($arResult["ERRORS"]) > 0):?>
			<?foreach ($arResult["ERRORS"] as $key => $error) {
				if (intval($key) == 0 && $key !== 0) {
					$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".Loc::getMessage("REGISTER_FIELD_".$key)."&quot;", $error);
				}
			}?>
			<div class="alert alert-danger"><?=implode('<br>', $arResult['ERRORS'])?></div>
		<?elseif($arResult['VALUES']['USER_ID']):?>
			<div class="alert alert-success">
				<?=Loc::getMessage('MAIN_REGISTER_SUCCESS')?>
				<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?><br><?=Loc::getMessage('REGISTER_EMAIL_WILL_BE_SENT')?><?endif?>
				</div>
		<?endif?>

		<?if($arResult["BACKURL"] <> ''):?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>

		<div class="mob-form-content js-custom-scroll">
			<div class="reg-form-body mob-form-body mob-form-container">
				<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
					<?if ($FIELD == 'LOGIN'):?>
						<input class="input JS-FieldText-Input" size="30" type="hidden" placeholder="" id="REGISTER[<?=$FIELD?>]" name="REGISTER[<?=$FIELD?>]" value="NULL" />
						<?continue?>
					<?endif?>
					<div class="field js-form-validate-field">
						<span class="field-input JS-FieldText<?if ($FIELD == 'PASSWORD' || $FIELD == 'CONFIRM_PASSWORD'):?> js-password<?endif?>" data-fieldtext="{'classActive':'field-input_active'}"<?if ($FIELD == 'PASSWORD' || $FIELD == 'CONFIRM_PASSWORD'):?> data-password="field-password-active"<?endif?>>
							<label class="field-label JS-FieldText-Label" for="REGISTER[<?=$FIELD?>]"><?=Loc::getMessage("REGISTER_FIELD_".$FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>&nbsp;<span class="field-label-required">*</span><?endif?></label>
							<?switch ($FIELD) {
								case "PASSWORD":
									?>
									<input class="input JS-FieldText-Input js-password-input" size="30" type="password" placeholder="" id="REGISTER[<?=$FIELD?>]" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" />
									<a class="js-password-link" href="javascript:;">
										<i class="eye-icon eye-icon_hide las la-eye-slash"></i>
										<i class="eye-icon eye-icon_show las la-eye"></i>
									</a>
									<?
									break;

								case "CONFIRM_PASSWORD":
									?>
									<input class="input JS-FieldText-Input js-password-input" size="30" type="password" placeholder="" id="REGISTER[<?=$FIELD?>]" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" />
									<a class="js-password-link" href="javascript:;">
										<i class="eye-icon eye-icon_hide las la-eye-slash"></i>
										<i class="eye-icon eye-icon_show las la-eye"></i>
									</a>
									<?
									break;

								default:
									?>
									<input class="input JS-FieldText-Input" size="30" type="text" placeholder="" id="REGISTER[<?=$FIELD?>]" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" />
									<?
							}?>
						</span>
					</div>
				<?endforeach?>

				<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
					<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
						<div class="field js-form-validate-field">
							<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
								<label class="field-label JS-FieldText-Label" for="REGISTER[<?=$FIELD?>]"><?=$arUserField["EDIT_FORM_LABEL"]?><?if ($arUserField["MANDATORY"] == "Y"):?>&nbsp;<span class="field-label-required">*</span><?endif?></label>
								<?$APPLICATION->IncludeComponent(
									"bitrix:system.field.edit",
									$arUserField["USER_TYPE"]["USER_TYPE_ID"],
									array(
										"bVarsFromForm" => $arResult["bVarsFromForm"],
										"arUserField" => $arUserField,
										"form_name" => "regform"
									),
									null,
									array("HIDE_ICONS"=>"Y")
								);?>
							</span>
						</div>
					<?endforeach?>
				<?endif?>

				<?if($arResult['USE_CAPTCHA'] == 'Y'):?>
					<div class="mf-captcha field">
						<input type="hidden" name="captcha_sid" value="<?=\htmlspecialcharsbx($arResult['CAPTCHA_CODE'])?>">
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=\htmlspecialcharsbx($arResult['CAPTCHA_CODE'])?>" width="180" height="40" alt="CAPTCHA">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="captcha_word"><?=Loc::getMessage("REGISTER_CAPTCHA_PROMT")?> <span class="field-label-required">*</span></label>
							<input class="input JS-FieldText-Input" type="text" id="captcha_word" name="captcha_word" size="30" maxlength="50" value="" autocomplete="off">
						</span>
					</div>
				<?endif?>

				<div class="field field_simple">
					<label class="switch">
						<input class="switch-checkbox js-form-checkbox" type="checkbox" name="agreement" checked="checked" />
						<span class="switch-decor">
							<span class="switch-icon"></span>
						</span>
						<span class="switch-label"><?=Loc::getMessage("REGISTER_I_AGREE_POLITIC")?> <a class="switch-label-link" target="_blank" href="<?=CEwpDykat::GetOption('policy_link')?>"><?=Loc::getMessage("REGISTER_AGREE_POLITIC_NAME")?></a></span>
					</label>
				</div>

				<div class="field-button">
					<input type="hidden" name="register_submit_button" value="1">
					<button class="reg-form-button button button_dark submit js-form-button"><?=Loc::getMessage("AUTH_REGISTER")?></button>
				</div>

					<?/*<div class="field js-form-validate-field">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="name">Имя</label>
							<input class="input JS-FieldText-Input" type="text" placeholder="" id="name" />
						</span>
					</div>
					<div class="field js-form-validate-field">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="surname">Фамилия</label>
							<input class="input JS-FieldText-Input" type="text" placeholder="" id="surname" />
						</span>
					</div>
					<div class="field js-form-validate-field">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="email">Email&nbsp;<span class="field-label-required">*</span></label>
							<input class="input JS-FieldText-Input" type="email" placeholder="" id="email" required />
						</span>
					</div>
					<div class="field js-form-validate-field">
						<span class="field-input JS-FieldText" data-fieldtext="{'classActive':'field-input_active'}">
							<label class="field-label JS-FieldText-Label" for="phone">Телефон</label>
							<input class="input JS-FieldText-Input js-phone" type="text" placeholder="" id="phone" />
						</span>
					</div>
					<div class="field field_simple js-form-validate-field">
						<span class="field-input js-password JS-FieldText"
							  data-fieldtext="{'classActive':'field-input_active'}"
							  data-password="field-password-active"
						>
							<label class="field-label JS-FieldText-Label" for="password1">Придумай пароль&nbsp;<span class="field-label-required">*</span></label>
							<input class="input js-password-input JS-FieldText-Input" type="password" placeholder="" id="password1" required />
							<a class="js-password-link" href="javascript:;">
								<i class="eye-icon eye-icon_hide las la-eye-slash"></i>
								<i class="eye-icon eye-icon_show las la-eye"></i>
							</a>
						</span>
					</div>
					<div class="field field_simple">
						<label class="switch">
							<input class="switch-checkbox js-form-checkbox" type="checkbox" name="agreement" checked="checked" />
							<span class="switch-decor">
								<span class="switch-icon"></span>
							</span>
							<span class="switch-label">Я согласен на <a class="switch-label-link" href="#">обработку персональных данных</a></span>
						</label>
					</div>
					<div class="field-button">
						<button class="reg-form-button button button_dark submit js-form-button">Зарегистрироваться</button>
					</div>
				</div>
				*/?>
			</div>
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
				<a class="mob-form-registration-link js-popup-profile" href="javascript:;" data-src="/ajax/login.php"><?=Loc::getMessage('AUTH')?></a>
			</div>
		</div>
	<?endif?>
</form>