<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;
use \Bitrix\Main\Localization\Loc;
global $USER;

Loc::loadMessages(__FILE__);

CModule::includeModule('iblock');
CModule::includeModule('kast.s4');

$context = \Bitrix\Main\Application::getInstance()->getContext();

$arBadEye = array(
	array(
		'ID' => 'theme',
		'NAME' => 'Цветовая схема',
		'VALUES' => array('default', 'dark', 'light'),
	),
	array(
		'ID' => 'font-size',
		'NAME' => 'Размер шрифта',
		'VALUES' => array('small', 'default', 'big'),
	),
	array(
		'ID' => 'images',
		'NAME' => 'Изображения',
		'VALUES' => array('default', 'bw', 'none'),
	),
);

$strBadEyeBodyData = '';
foreach ($arBadEye as $arItem) {
	$strBadEyeBodyData .= ' data-'.$arItem['ID'].'="'.$_COOKIE['eyebad-'.$arItem['ID']].'"';
}
?>

<!doctype html>
<html class="html"<?=$strBadEyeBodyData?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />

	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle()?></title>
	<?
		$instance = Asset::getInstance();
		$instance->addCss(SITE_TEMPLATE_PATH . "/assets/libs/fontawesome/css/all.min.css");
		//$instance->addCss(SITE_TEMPLATE_PATH . "/assets/libs/line-awesome/css/line-awesome.min.css");
		$instance->addCss(SITE_TEMPLATE_PATH . "/assets/libs/OwlCarousel/assets/owl.carousel.min.css");
		$instance->addCss(SITE_TEMPLATE_PATH . "/assets/libs/fancybox/jquery.fancybox.min.css");
		//$instance->addCss(SITE_TEMPLATE_PATH . "/assets/libs/Selectric/public/selectric.css");
		//$instance->addCss(SITE_TEMPLATE_PATH . "/assets/libs/simplebar/simplebar.min.css");
		//$instance->addCss(SITE_TEMPLATE_PATH . "/assets/libs/jquery-ui/jquery-ui.min.css");
		//$instance->addCss(SITE_TEMPLATE_PATH . "/assets/libs/slick/slick.css");
		//$instance->addCss(SITE_TEMPLATE_PATH . "/assets/libs/slick/slick-theme.css");
		//$instance->addCss(SITE_TEMPLATE_PATH . "/assets/libs/tipped/css/tipped.css");
		$instance->addCss(SITE_TEMPLATE_PATH . "/assets/css/bootstrap-grid.css");
		//$instance->addCss(SITE_TEMPLATE_PATH . "/assets/css/common.css");
		//$instance->addCss(SITE_TEMPLATE_PATH . "/assets/css/custom.css");
		$instance->addCss(SITE_TEMPLATE_PATH . "/assets/css/bundle.css");
		$instance->addCss(SITE_TEMPLATE_PATH . "/assets/css/badeye.css");

		$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/jquery/jquery-3.5.1.min.js");
		$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/OwlCarousel/owl.carousel.min.js");
		$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/fancybox/jquery.fancybox.min.js");
		$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/mask/jquery.mask.min.js");
		$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/validate/jquery.validate.min.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/Selectric/public/jquery.selectric.min.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/masonry/masonry.pkgd.min.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/parallax/parallax.min.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/simplebar/simplebar.min.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/jquery-ui/jquery-ui.min.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/jquery-ui/jquery.ui.touch-punch.min.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/slick/slick.min.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/tipped/js/tipped.min.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/libs/multifile/jquery.MultiFile.min.js");

		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.Dropdown.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.Menu.js");
		$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.MobileMenu.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.Fix.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.FieldText.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.ShowMore.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.DropSearch.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.Voice.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.Accordion.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.Quantity.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.AjaxMore.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.Tab.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/JSC.Columns.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/catalog.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/add2favorite.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/add2compare.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/add2config.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/main.js");
		//$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/custom.js");
		$instance->addJs("https://api-maps.yandex.ru/2.1/?lang=ru_RU");
		$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.cookie.js");
		$instance->addJs(SITE_TEMPLATE_PATH . "/assets/js/bundle.js");
	?>
</head>
<body class="body">
	<div class="panel"><?$APPLICATION->ShowPanel()?></div>
	<div class="wrapper">
		<header class="header">
			<div class="badeye js-badeye">
				<div class="container">
					<div class="row">
						<?foreach ($arBadEye as $arItem):?>
							<div class="col-12 col-md-4">
								<div class="badeye-item">
									<div class="badeye-title"><?=$arItem['NAME']?></div>
									<div class="badeye-controls">
										<?foreach ($arItem['VALUES'] as $value):?>
											<a class="badeye-control js-badeye-control<?=($_COOKIE['eyebad-'.$arItem['ID']] == $value || (!$_COOKIE['eyebad-'.$arItem['ID']] && $value == 'default')) ? ' is-active' : ''?>" data-id="<?=$arItem['ID']?>" data-value="<?=$value?>">
												<span class="badeye-<?=$arItem['ID']?> <?=$value?>"></span>
											</a>
										<?endforeach?>
									</div>
								</div>
							</div>
						<?endforeach?>
					</div>
				</div>
			</div>
			<div class="header-top">
				<div class="header-top-block container">
					<div class="header-top-menu">
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"header-top",
							array(
								"ROOT_MENU_TYPE" => "top",
								"MAX_LEVEL" => "3",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "Y",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000000",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_CACHE_GET_VARS" => ""
							),
							false,
							array(
								"ACTIVE_COMPONENT" => "Y"
							)
						);?>
					</div>
					<ul class="header-actions header-menu">
						<li class="header-menu-item">	
							<div class="header-bad-eye">
								<a class="header-actions-place header-menu-link js-badeye-switcher" href="javascript:;">
									<i class="header-menu-icon header-menu-icon--left fa fa-eye"></i>
									<span class="header-menu-switcher switcher">Для слабовидящих</span>
								</a>
							</div>
						</li>
						<li class="header-menu-item">	
							<div class="header-bad-eye">
								<a class="header-actions-place header-menu-link" href="/auth/">
									<i class="header-menu-icon header-menu-icon--left fa fa-sign-in-alt"></i>
									<span class="header-menu-switcher switcher">Войти</span>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="header-panel">
				<div class="header-panel-block container">
					<a class="header-logo" href="/">
						<?$APPLICATION->IncludeFile(
							"/include/logo.php",
							array(),
							array("MODE"=>"html")
						);?>
					</a>
					<div class="header-panel-list">
						<div class="header-panel-item header-panel-item-search">
							<form class="search-form" action="/search/">
								<div class="search-container">
									<input class="search-input input" type="text" name="q" value="" placeholder="" maxlength="100" autocomplete="off">
									<button class="search-button" name="s" type="submit">
										<i class="search-icon fa fa-search"></i>
									</button>
								</div>
							</form>
						</div>
						<?
						$arPhones = CKastS4::GetPhonesArray();
						$email = CKastS4::GetEmail();
						?>
						<div class="header-panel-item header-panel-item-contacts">
							<div class="header-contacts">
								<div class="header-main-contact-container">
									<a href="tel:<?=current($arPhones)['TEL']?>" class="header-main-contact">
										<?=current($arPhones)['PHONE']?>
										<i class="header-menu-icon fa fa-angle-down"></i>
									</a>
									<ul class="header-contacts-list">
										<?foreach ($arPhones as $arPhone):?>
											<li class="header-contacts-item">
												<a href="tel:<?=$arPhone['TEL']?>" class="header-contact">
													<i class="header-menu-icon header-menu-icon--left fa fa-phone"></i>
													<?=$arPhone['PHONE']?>
												</a>
											</li>
										<?endforeach?>
										<li class="header-contacts-item">
											<a href="mailto:<?=$email?>" class="header-contact">
												<i class="header-menu-icon header-menu-icon--left fa fa-envelope"></i>
												<?=$email?>
											</a>
										</li>
										<li class="header-contacts-item header-contacts-item--socials">
											<div class="header-contacts-tilte">Мы в социальных сетях</div>
											<div class="header-socials">
												<?$APPLICATION->IncludeFile(
													"/include/socials.php",
													array(),
													array("MODE"=>"html")
												);?>
											</div>
										</li>
									</ul>
								</div>
								<div class="header-contacts-text">Контактные данные</div>
							</div>
						</div>
						<div class="header-panel-item header-panel-item-feedback">
							<a class="header-feedback-button button button_simple js-popup-feedback" href="javascript:;" data-src="/ajax/feedback.php">Написать нам</a>
						</div>
					</div>
				</div>
			</div>
			<div class="header-main-menu JS-Fix" data-fix="{'classActive': 'main-menu-container_fix'}">
				<div class="main-menu-container JS-Fix-Item">
					<div class="container main-menu JS-Dropdown" data-dropdown="{
										'classActive': 'catalog-menu_active',
										'classShow': 'catalog-menu-show'
					}">
						<div class="main-menu-block">
							<div class="mob-menu JS-MobileMenu" data-mobilemenu="{
								'classActive': 'open',
								'classShow': 'mob-menu-show',
								'classElementActive': 'mob-menu_active'
							}">
								<a class="mob-menu-switcher JS-MobileMenu-Burger" href="javascript:;">
									<svg class="mob-menu-icon"><use xlink:href="#burger-icon"></use></svg>
								</a>
								<div class="mob-block JS-MobileMenu-Dropdown">
									<div class="mob-close-panel">
										<a class="mob-company-logo" href="/">
											<?$APPLICATION->IncludeFile(
												"/include/logo.php",
												array(),
												array("MODE"=>"html")
											);?>
										</a>
										<a href="javascript:;" class="mob-close JS-MobileMenu-Close">
											<svg class="close-icon"><use xlink:href="#close-icon"></use></svg>
										</a>
									</div>
									<div class="mob-nav">
										<div class="mob-list">
											<div class="mob-list-main">
												<?$APPLICATION->IncludeComponent(
													"bitrix:menu", 
													"main_mobile", 
													array(
														"ROOT_MENU_TYPE" => "main",
														"MAX_LEVEL" => "4",
														"CHILD_MENU_TYPE" => "left",
														"USE_EXT" => "Y",
														"MENU_CACHE_TYPE" => "A",
														"MENU_CACHE_TIME" => "36000000",
														"MENU_CACHE_USE_GROUPS" => "Y",
														"MENU_CACHE_GET_VARS" => ""
													),
													false,
													array(
														"ACTIVE_COMPONENT" => "Y"
													)
												);?>
											</div>
											<div class="mob-list-main-mobile">
												<?$APPLICATION->IncludeComponent(
													"bitrix:menu", 
													"main_mobile", 
													array(
														"ROOT_MENU_TYPE" => "top",
														"MAX_LEVEL" => "4",
														"CHILD_MENU_TYPE" => "left",
														"USE_EXT" => "Y",
														"MENU_CACHE_TYPE" => "A",
														"MENU_CACHE_TIME" => "36000000",
														"MENU_CACHE_USE_GROUPS" => "Y",
														"MENU_CACHE_GET_VARS" => ""
													),
													false,
													array(
														"ACTIVE_COMPONENT" => "Y"
													)
												);?>
											</div>
										</div>
									</div>
									<div class="mob-info">
										<div class="mob-user-info">
											<div class="mob-callback-button">
												<a class="button js-popup-feedback" href="javascript:;" data-src="/ajax/feedback.php">Написать нам</a>
											</div>
										</div>
									</div>
									<div class="mob-info">
										<div class="mob-socials-title">Мы в социальных сетях</div>
										<?$APPLICATION->IncludeFile(
											"/include/socials.php",
											array(),
											array("MODE"=>"html")
										);?>
									</div>
								</div>
								<div class="mob-menu-decor JS-MobileMenu-Close"></div>
							</div>
							<a class="main-menu-logo" href="/">
								<?$APPLICATION->IncludeFile(
									"/include/logo.php",
									array(),
									array("MODE"=>"html")
								);?>
							</a>
							<?$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"main", 
								array(
									"ROOT_MENU_TYPE" => "main",
									"MAX_LEVEL" => "4",
									"CHILD_MENU_TYPE" => "left",
									"USE_EXT" => "Y",
									"MENU_CACHE_TYPE" => "A",
									"MENU_CACHE_TIME" => "36000000",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_CACHE_GET_VARS" => ""
								),
								false,
								array(
									"ACTIVE_COMPONENT" => "Y"
								)
							);?>			
						</div>
					</div>
				</div>
			</div>
		</header>

		<main class="main-content">
			<?if($APPLICATION->GetCurPage(false) != '/' && $APPLICATION->GetProperty('hide_breadcrumb') != 'Y'):?>
				<div class="container">
					<?$APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"s4",
						Array(
							"PATH" => "",
							"SITE_ID" => SITE_ID,
							"START_FROM" => "0"
						)
					);?>
				</div>
			<?endif?>

			<?if($APPLICATION->GetCurPage(false) != '/' && $APPLICATION->GetProperty('widepage') != 'Y'):?>
            	<div class="container">
			<?endif?>

			<?if($APPLICATION->GetCurPage(false) != '/' && $APPLICATION->GetProperty('hide_h1') != 'Y'):?>
				<h1><?$APPLICATION->ShowTitle(false)?></h1>
			<?endif?>

