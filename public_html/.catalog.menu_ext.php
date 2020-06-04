<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksExt = [];

$arParams = [
    "FILTER" => [
        "IBLOCK_ID" => "2",
        "ACTIVE" => "Y",
        "GLOBAL_ACTIVE" => "Y",
        "<DEPTH_LEVEL" => 3
    ]
];

$arResult = $APPLICATION->IncludeComponent("studio7sbp:iblock.sections.menu", null, $arParams, null, ["HIDE_ICONS" => "Y"]);

foreach ($arResult as $section)
{
    $aMenuLinksExt[] = [
        $section["NAME"],
        $section["SECTION_PAGE_URL"],
        [],
        [
            "FROM_IBLOCK" => $arParams["FILTER"]["IBLOCK_ID"],
            "IS_PARENT" => (empty($section["CHIELDS"]) ? false : true),
            "DEPTH_LEVEL" => $section["DEPTH_LEVEL"]
        ]
    ];
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

AddMessage2Log($aMenuLinks);