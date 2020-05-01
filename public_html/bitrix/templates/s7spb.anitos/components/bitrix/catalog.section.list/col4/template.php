<?
/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$arParams["LINE_ELEMENT_COUNT"] = 4;

if(empty($arResult["SECTIONS"]))
    return;

?>

<div class="s7spb-row s7spb-row-wrap s7spb-row12">
    <?
    foreach ($arResult["SECTIONS"] as $i=>$arItem):

        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));

        if(is_array($arItem["PICTURE"])){
            $arItem["PICTURE"] = $arItem["PICTURE"]["SRC"];
        }else{
            $arItem["PICTURE"] = $this->GetFolder() . "/images/default.jpg";
        }

        if($i > 0){
            if($i % $arParams["LINE_ELEMENT_COUNT"] === 0){
                echo '</div><div class="s7spb-row s7spb-row-wrap s7spb-row12">';
            }
        }


    ?>
        <div id="<?=$this->GetEditAreaId($arSection['ID']);?>"
             class="s7spb-col s7spb-col1200-50">

            <a href="<?=$arItem["SECTION_PAGE_URL"]?>"
               class="mb4 hm200 border-radius-10 py4 px6 text-decoration-none text-black d-block"
                 style=" background-size: cover; background-image: url(<?=$arItem["PICTURE"]?>)">
                <div class="text-20"><?=$arItem["NAME"]?></div>
            </a>

        </div>
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

