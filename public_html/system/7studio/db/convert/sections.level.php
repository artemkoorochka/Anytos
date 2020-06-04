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


$entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock($arParams["IBLOCK_ID"]);



$rsSection = $entity::getList(array(

    "filter" => $arParams,

    "select" => array("ID", "NAME", "UF_PARENT"),

));



while($arSection=$rsSection->Fetch())

{

    $arResult[] = $arSection;

}

d($arResult);