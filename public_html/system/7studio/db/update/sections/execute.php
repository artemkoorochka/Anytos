<?
use Bitrix\Main\Loader,
    Bitrix\Iblock\SectionTable;

/**
 * Перебор єлементов инфоблока
 */

$_SERVER["DOCUMENT_ROOT"] = "/home/c/ca01826813/anitos/public_html";
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define("BX_CRONTAB", true);
define('BX_WITH_ON_AFTER_EPILOG', true);
define('BX_NO_ACCELERATOR_RESET', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

///
$arParams = [
    "IBLOCK_ID" => 2, // catalog
];

$arResult = [
    "SECTIONS" => []
];
///
Loader::includeModule("iblock");

$sections = SectionTable::getList([
    "filter" => $arParams,
    "select" => ["ID", "DESCRIPTION"],
    //"limit" => 10000
    "limit" => 100000
]);
$lastID = 0;
$neo = new CIBlockSection();
while ($section = $sections->fetch()){
    $section["DESCRIPTION"] = unserialize($section["DESCRIPTION"]);
    $arResult["SECTIONS"][$section["DESCRIPTION"]["id"]] = $section;
}


foreach ($arResult["SECTIONS"] as $section){

    /*
    $neo->Update($section["ID"], [
        "IBLOCK_SECTION_ID" => $arResult["SECTIONS"][$section["DESCRIPTION"]["group_id"]]["ID"]
    ]);
    */

}