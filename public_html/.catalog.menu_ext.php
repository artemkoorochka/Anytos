<?
use Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!Loader::includeModule("iblock"))
    return;

$arParams = [
    "IBLOCK_TYPE" => "marketplace",
    "IBLOCK_ID" => "2",
    "ACTIVE" => "Y",
    "GLOBAL_ACTIVE" => "Y",
    "DEPTH_LEVEL" => 1
];

$aMenuLinksExt = [];

$sections = CIBlockSection::GetList(
    ["DEPTH_LEVEL" => "ASC"],
    $arParams,
    false,
    ["ID", "NAME", "DEPTH_LEVEL", "UF_PARENT", "SECTION_PAGE_URL", "DEPTH_LEVEL"]
);
while ($section = $sections->GetNext())
{

    if(!empty($section["UF_PARENT"])){
        unset($section["UF_PARENT"][array_search($section["ID"],$section["UF_PARENT"])]);
    }

    $arSections[$section["ID"]] = $section;

}

foreach ($arSections as $section){

    $section["IS_PARENT"] = false;
    if(!empty($section["UF_PARENT"])){
        foreach ($section["UF_PARENT"] as $key=>$parentSection){

            if($parentSection == $section["ID"]){
                unset($arSections[$parentSection["ID"]]["UF_PARENT"][$key]);
                continue;
            }

            if($arSections[$parentSection["ID"]]["ID"] > 0 && $arSections[$parentSection["ID"]]["DEPTH_LEVEL"] < $section["DEPTH_LEVEL"]){

                $arSections[$parentSection["ID"]]["NAME"] .= " test name " . $arSections[$parentSection["ID"]]["NAME"] . " test level = " . $arSections[$parentSection["ID"]]["DEPTH_LEVEL"];

                $section["IS_PARENT"] = true;
                break;
            }
        }
    }
    $arSections[$section["ID"]]["IS_PARENT"] = $section["IS_PARENT"];
}

foreach ($arSections as $section)
{
    $aMenuLinksExt[] = [
        $section["NAME"] . "[" . $section["ID"] . "] - " . implode("#", $section["UF_PARENT"]),
        $section["SECTION_PAGE_URL"],
        [],
        [
            "FROM_IBLOCK" => $arParams["IBLOCK_ID"],
            "IS_PARENT" => (empty($section["UF_PARENT"]) ? false : true),
            "DEPTH_LEVEL" => $section["DEPTH_LEVEL"]
        ]
    ];

    addMenuSection($aMenuLinksExt, $arSections, $section, $arParams);


}

function addMenuSection(&$aMenuLinksExt, $arSections, $section, $arParams){
    // UF_PARENT
    if(!empty($section["UF_PARENT"])){
        foreach ($section["UF_PARENT"] as $parentSection){

            if(!empty($parentSection["ID"])){
                $aMenuLinksExt[] = [
                    $arSections[$parentSection["ID"]]["NAME"],
                    $arSections[$parentSection["ID"]]["SECTION_PAGE_URL"],
                    [],
                    [
                        "FROM_IBLOCK" => $arParams["IBLOCK_ID"],
                        "IS_PARENT" =>  (empty($arSections[$parentSection["ID"]]["UF_PARENT"]) ? false : true),
                        "DEPTH_LEVEL" => $arSections[$parentSection["ID"]]["DEPTH_LEVEL"]
                    ]
                ];
                addMenuSection($aMenuLinksExt, $arSections, $arSections[$parentSection["ID"]], $arParams);
            }

        }
    }
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

AddMessage2Log($aMenuLinks);