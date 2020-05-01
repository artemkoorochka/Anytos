<?
/**
 * @var array $arParams
 * @var array $arResult
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


###### START Emulate ########
$arParams["LINE_ELEMENT_COUNT"] = 4;
$arParams["COLORS"] = [
    "BG" => [
        "bg-info",
        "bg-info-ultras",
        "bg-info-infras",
        "bg-success",
        "bg-success-ultras",
        "bg-success-infras",
        "bg-danger-ultras",
        "bg-primary-ultras"
    ],
    "IMAGES" => [
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/bitovaja.tech.png",
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/books.png",
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/children.game.discont.png",
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/children.png",
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/cuchina.png",
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/kanstovar.png",
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/school.png",
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/selebrate.png",
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/shoose.png",
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/suvenire.png",
        "/bitrix/templates/s7spb.anitos/components/bitrix/catalog.section.list/col4/images/toys.png"
    ]
];


###### END Emulate ########



if(empty($arResult["SECTIONS"]))
    return;

?>

<div class="s7spb-row s7spb-row-wrap s7spb-row12">
    <?
    foreach ($arResult["SECTIONS"] as $i=>$arItem):
        $arItem["BG"] = $arParams["COLORS"]["BG"][rand(0, count($arParams["COLORS"]["BG"]))];
        $arItem["PICTURE"] = $arParams["COLORS"]["IMAGES"][rand(0, count($arParams["COLORS"]["IMAGES"]))];
        if($i > 0){
            if($i % $arParams["LINE_ELEMENT_COUNT"] === 0){
                echo '</div><div class="s7spb-row s7spb-row-wrap s7spb-row12">';
            }
        }


    ?>
        <a href="<?=$arItem["SECTION_PAGE_URL"]?>"
           class="s7spb-col s7spb-col1200-50 <?=$arItem["BG"]?>  mb4 hm200 border-radius-10 py4 px6 text-decoration-none text-black"
             style=" background-size: cover; background-image: url(<?=$arItem["PICTURE"]?>)">
            <div class="text-20"><?=$arItem["NAME"]?></div>
        </a>
    <?
    endforeach;
    $i++;
    $i = $i % $arParams["LINE_ELEMENT_COUNT"];

    if($i){
        for($i; $i < $arParams["LINE_ELEMENT_COUNT"]; $i++){
            echo '<div class="s7spb-col s7spb-col1200-50 py4 px6"></div>';
        }
    }
    ?>
</div>

