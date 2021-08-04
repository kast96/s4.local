<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arFilter = Array("TYPE_ID" => "FEEDBACK_FORM", "ACTIVE" => "Y");
if($site !== false)
	$arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
while($arType = $dbType->GetNext())
	$arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];

$arComponentParameters = array(
	"PARAMETERS" => array(
		"TITLE" => Array(
			"NAME" => GetMessage("MFP_TITLE"), 
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("MFP_TITLE_DEFAULT"), 
			"PARENT" => "BASE",
		),
		"DESCRIPTION" => Array(
			"NAME" => GetMessage("MFP_DESCRIPTION"), 
			"TYPE" => "STRING",
			"PARENT" => "BASE",
		),
		"USE_CAPTCHA" => Array(
			"NAME" => GetMessage("MFP_CAPTCHA"), 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y", 
			"PARENT" => "BASE",
		),
		"OK_TEXT" => Array(
			"NAME" => GetMessage("MFP_OK_MESSAGE"), 
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("MFP_OK_TEXT"), 
			"PARENT" => "BASE",
		),
		"EMAIL_TO" => Array(
			"NAME" => GetMessage("MFP_EMAIL_TO"), 
			"TYPE" => "STRING",
			"DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")), 
			"PARENT" => "BASE",
		),
		"REQUIRED_FIELDS" => Array(
			"NAME" => GetMessage("MFP_REQUIRED_FIELDS"), 
			"TYPE"=>"LIST", 
			"MULTIPLE"=>"Y", 
			"VALUES" => Array("NONE" => GetMessage("MFP_ALL_REQ"), "NAME" => GetMessage("MFP_NAME"), "EMAIL" => "E-mail", "MESSAGE" => GetMessage("MFP_MESSAGE"), "PHONE" => GetMessage("MFP_PHONE")),
			"DEFAULT"=>"", 
			"COLS"=>25, 
			"PARENT" => "BASE",
		),
		"SHOW_FIELDS" => Array(
			"NAME" => GetMessage("MFP_SHOW_FIELDS"), 
			"TYPE"=>"LIST", 
			"MULTIPLE"=>"Y", 
			"VALUES" => Array("ALL" => GetMessage("MFP_ALL_SHOW"), "NAME" => GetMessage("MFP_NAME"), "EMAIL" => "E-mail", "MESSAGE" => GetMessage("MFP_MESSAGE"), "PHONE" => GetMessage("MFP_PHONE")),
			"DEFAULT"=>"", 
			"COLS"=>25, 
			"PARENT" => "BASE",
		),
		"EVENT_MESSAGE_ID" => Array(
			"NAME" => GetMessage("MFP_EMAIL_TEMPLATES"), 
			"TYPE"=>"LIST", 
			"VALUES" => $arEvent,
			"DEFAULT"=>"", 
			"MULTIPLE"=>"Y", 
			"COLS"=>25, 
			"PARENT" => "BASE",
		),
		"ADDITINAL_FIELDS_CODES" => Array(
			"NAME" => GetMessage("MFP_ADDITINAL_FIELDS_CODES"), 
			"TYPE" => "STRING",
			"MULTIPLE" => "Y",
			"REFRESH" => "Y",
		),
	)
);

if ($arCurrentValues['ADDITINAL_FIELDS_CODES']) {
	foreach ($arCurrentValues['ADDITINAL_FIELDS_CODES'] as $additionalFieldsCode) {
		$arComponentParameters['PARAMETERS']['ADDITINAL_FIELDS_NAME_'.$additionalFieldsCode] = array(
			"NAME" => GetMessage("MFP_ADDITINAL_FIELDS_NAME").' '.$additionalFieldsCode, 
			"TYPE" => "STRING",
		);
		$arComponentParameters['PARAMETERS']['ADDITINAL_FIELDS_IS_LIST_'.$additionalFieldsCode] = array(
			"NAME" => GetMessage("MFP_ADDITINAL_FIELDS_IS_LIST").' '.$additionalFieldsCode, 
			"TYPE" => "CHECKBOX",
			"REFRESH" => "Y",
		);
		if ($arCurrentValues['ADDITINAL_FIELDS_IS_LIST_'.$additionalFieldsCode] == 'Y') {
			$arComponentParameters['PARAMETERS']['ADDITINAL_FIELDS_VALUE_'.$additionalFieldsCode] = array(
				"NAME" => GetMessage("MFP_ADDITINAL_FIELDS_VALUE").' '.$additionalFieldsCode, 
				"TYPE" => "STRING",
				"MULTIPLE" => "Y",
			);
		}
	}
}
?>