<?
use Bitrix\Main\Loader,
    Bitrix\Iblock\SectionTable;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

Loader::includeModule("iblock");

$arResult = [];

$arParams = [
    "IBLOCK_TYPE" => "marketplace",
    "IBLOCK_ID" => "2",
    "ACTIVE" => "Y",
    "GLOBAL_ACTIVE" => "Y",
    "DEPTH_LEVEL" => 1
];

$arParams = [
    "IBLOCK_ID" => "2",
    "ACTIVE" => "Y"
];

d($arParams);

$sections = SectionTable::getList([
    "filter" => $arParams,
    "select" => ["ID", "NAME", "DEPTH_LEVEL", "DEPTH_LEVEL"]
]);

while ($section = $sections->fetch())
{
    $arResult[] = $section;
}

d($arResult);