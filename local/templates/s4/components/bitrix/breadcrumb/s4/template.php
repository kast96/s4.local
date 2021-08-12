<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if(empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<div class="breadcrumbs js-expand" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList" data-expand="{
	\'classActive\': \'breadcrumbs_active\',
	\'classShow\': \'breadcrumbs_show\'
	}">';
$strReturn .= '<ul class="breadcrumbs-list js-expand-block">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = '<i class="breadcrumbs-icon fa fa-angle-right"></i>';

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<li class="breadcrumbs-item" id="bx_breadcrumb_'.$index.'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a class="breadcrumbs-link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">'.$title.'</a>'.$arrow.'
				<meta itemprop="position" content="'.($index + 1).'" />
			</li>';
	}
	else
	{
		$strReturn .= '
			<li class="breadcrumbs-item">
				<span>'.$title.'</span>
			</li>';
	}
}

$strReturn .= '<li class="breadcrumbs-item breadcrumbs-item_more"><a class="breadcrumbs-link js-expand-link" href="javascript:;">...</a></li>';
$strReturn .= '</ul>';
$strReturn .= '<div style="clear:both"></div></div>';

return $strReturn;
