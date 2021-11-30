<?
use Bitrix\Main\Loader;

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Контакты');

CModule::includeModule('kast.s4');

$arPhones = CKastS4::GetPhonesArray();
$email = CKastS4::GetEmail();
$address = CKastS4::GetAddress();

 $arPhonesFormatted = array_map(function($arPhone) {
	 return '<a href="tel:'.$arPhone['TEL'].'">'.$arPhone['PHONE'].'</a>';
}, $arPhones);
?>

<div class="contacts">
	<div class="contacts-info">
		<div class="contacts-item">
			<div class="contacts-icon">
				<i class="icon fa fa-phone"></i>
			</div>
			<div class="contacts-text">
				<?=implode(', ', $arPhonesFormatted)?>
				<?$APPLICATION->IncludeFile(
					"/include/contacts-phones.php",
					array(),
					array("MODE"=>"html")
				);?>
			</div>
		</div>
		<div class="contacts-item">
			<div class="contacts-icon">
				<i class="icon fa fa-clock"></i>
			</div>
			<div class="contacts-text contacts-phone">
				<?$APPLICATION->IncludeFile(
					"/include/contacts-time.php",
					array(),
					array("MODE"=>"html")
				);?>
			</div>
		</div>
		<div class="contacts-item">
			<div class="contacts-icon">
				<i class="icon fa fa-envelope"></i>
			</div>
			<div class="contacts-text contacts-phone">
				<a href="mailto:<?=$email?>"><?=$email?></a>
				<?$APPLICATION->IncludeFile(
					"/include/contacts-email.php",
					array(),
					array("MODE"=>"html")
				);?>
			</div>
		</div>
		<div class="contacts-item">
			<div class="contacts-icon">
				<i class="icon fa fa-map-marker-alt"></i>
			</div>
			<div class="contacts-text contacts-phone">
				<span><?=$address?></span>
				<?$APPLICATION->IncludeFile(
					"/include/contacts-address.php",
					array(),
					array("MODE"=>"html")
				);?>
			</div>
		</div>
	</div>
	<div class="contacts-map">
		<div class="js-map" data-mapid="map-contacts" data-centercoord="[53.194769, 43.980995]">
			<div class="js-map-item d-none" data-objectid="1" data-objectcoord="[53.194769, 43.980995]">
				<span class="js-map-item-value">
					<i class="contacts-points-icon las la-map-marker"></i>
					МОУ СОШ №4<br>г.Каменка, ул.Чернышевского, 6
				</span>
			</div>
			<div id="map-contacts" class="map"></div>
		</div>
	</div>
</div>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php')?>