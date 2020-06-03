<?
// пример файла .left.menu_ext.php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    array(
        "IBLOCK_TYPE" => "marketplace",
        "IBLOCK_ID" => "2",
        "IS_SEF" => "Y",
        "SEF_BASE_URL" => "/catalog/",
        "SECTION_PAGE_URL" => "#SECTION_CODE#/",
        "DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_ID#",
        "DEPTH_LEVEL" => "3",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000"
    ),
    false,
    ["HIDE_ICONS" => "Y"]
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);