<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<div class="callback-form">
	<h2>Написать нам</h2>
	<?$APPLICATION->IncludeComponent(
		"custom:main.feedback",
		"popup",
		Array(
			"EMAIL_TO" => "",
			"EVENT_MESSAGE_ID" => array("7"),
			"OK_TEXT" => "Спасибо, ваше сообщение принято.",
			"REQUIRED_FIELDS" => array("NAME","EMAIL","MESSAGE", "PHONE"),
			"SHOW_FIELDS" => array("NAME","EMAIL","MESSAGE", "PHONE"),
			"TITLE" => "Написать нам",
			"DESCRIPTION" => "",
			"USE_CAPTCHA" => "Y",
		)
	);?>
</div>