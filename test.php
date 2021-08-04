<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');?>

<?$APPLICATION->IncludeComponent(
            "ewp:main.feedback",
            "question",
            Array(
                "EMAIL_TO" => "",
                "EVENT_MESSAGE_ID" => array("51"),
                "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                "ADDITINAL_FIELDS_CODES" => array("THEME", "QUESTION", "COMPANY", "NOTIFY_OF_REPLIES"),
                "ADDITINAL_FIELDS_NAME_THEME" => "Тема вопроса",
                "ADDITINAL_FIELDS_IS_LIST_THEME" => "Y",
                "ADDITINAL_FIELDS_VALUE_THEME" => array(
                    "theme-1" => "Тема вопроса 1",
                    "theme-2" => "Тема вопроса 2",
                    "theme-3" => "Тема вопроса 3",
                    "theme-4" => "Тема вопроса 4",
                ),
                "ADDITINAL_FIELDS_NAME_QUESTION" => "Вопрос",
                "ADDITINAL_FIELDS_NAME_COMPANY" => "Название компании",
                "ADDITINAL_FIELDS_IS_LIST_COMPANY" => "Y",
                "ADDITINAL_FIELDS_VALUE_COMPANY" => array(
                    "theme-1" => "Компания 1",
                    "theme-2" => "Компания 2",
                    "theme-3" => "Компания 3",
                    "theme-4" => "Компания 4",
                ),
                "ADDITINAL_FIELDS_NAME_NOTIFY_OF_REPLIES" => "Уведомлять об ответах",
                "REQUIRED_FIELDS" => array("NAME"),
                "SHOW_FIELDS" => array("NAME", "THEME", "QUESTION", "COMPANY", "NOTIFY_OF_REPLIES"),
                "TITLE" => "Задать вопрос",
                "DESCRIPTION" => "",
                "USE_CAPTCHA" => "Y",
            )
        );?>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>