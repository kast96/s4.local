<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

global $APPLICATION;
$APPLICATION->AddChainItem('Страница не найдена');
?>

<div class="page-404">
	<div class="page-404__title">404</div>
	<div class="page-404__description">Упс! Кажется что-то пошло не так. Страница, которую вы запрашиваете, не существует. Возможно она устарела, была удалена или был введен неверный адрес в адресной строке</div>
	<a href="/" class="button page-404__link">Вернуться на главную</a>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>