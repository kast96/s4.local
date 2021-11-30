<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

CModule::includeModule('kast.s4');
?>

			<?if($APPLICATION->GetCurPage(false) != '/' && $APPLICATION->GetProperty('widepage') != 'Y'):?>
				</div>
			<?endif?>
			<!--container-->
		</div>
		<!--main-content-->
	</div>
	<!--wrapper-->

	<footer class="footer">
		<div class="container">
			<div class="footer-body">
				<div class="footer-col footer-col_company">
					<div class="footer-company">
						<a class="footer-logo" href="/">
							<?$APPLICATION->IncludeFile(
								"/include/logo.php",
								array(),
								array("MODE"=>"html")
							);?>
						</a>
					</div>
				</div>
				<div class="footer-col footer-col_menu">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"bottom",
						array(
							"ROOT_MENU_TYPE" => "bottom1",
							"MAX_LEVEL" => "3",
							"CHILD_MENU_TYPE" => "bottom1",
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
				<div class="footer-col footer-col_menu-add">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"bottom",
						array(
							"ROOT_MENU_TYPE" => "bottom2",
							"MAX_LEVEL" => "3",
							"CHILD_MENU_TYPE" => "bottom2",
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
				<div class="footer-col footer-col_socials">
					<div class="footer-title">Мы в социальных сетях</div>
					<?$APPLICATION->IncludeFile(
						"/include/socials.php",
						array(),
						array("MODE"=>"html")
					);?>
				</div>
				<div class="footer-col footer-col_contacts">
					<?
					$arPhones = CKastS4::GetPhonesArray();
					$email = CKastS4::GetEmail();
					$address = CKastS4::GetAddress();
					?>
					<div class="footer-contacts">
						<div class="footer-contacts-info">
							<div class="footer-title">Контакты</div>
							<?foreach ($arPhones as $arPhone):?>
								<div class="footer-phone">
									<a href="tel:<?=$arPhone['TEL']?>"><?=$arPhone['PHONE']?></a>
								</div>
							<?endforeach?>
							<div class="footer-email">
								<i class="footer-menu-icon footer-menu-icon--left fa fa-envelope"></i>
								<a href="mailto:<?=$email?>"><?=$email?></a>
							</div>
							<div class="footer-address">
								<i class="footer-menu-icon footer-menu-icon--left fa fa-map-marker-alt"></i>
								<span><?=$address?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="footer-copyright">
					<div class="footer-copyright-company">© МОУ СОШ №4 г. Каменка, 2017-2021</div>
				</div>
				<div class="footer-developer">При использовании любых материалов просим указывать ссылку на shool4.ru</div>
			</div>
		</div>
	</footer>

	<div class="preloader g-hidden js-preloader">
		<div class="preloader-container"></div>
	</div>

	<div class="svg-box">
		<?require($_SERVER['DOCUMENT_ROOT'].'/include/svg.php')?>
	</div>
</body>
</html>