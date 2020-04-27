<?
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(empty($arResult["ITEMS"]))
    return;
?>

<div class="bg-white border-radius-10 py2 px1">

    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <div class="text-center"><?=$arResult["NAV_STRING"]?></div>
    <?endif?>

    <div class="s7spb-row s7spb-row12">
    <?
    foreach($arResult["ITEMS"] as $key=>$arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
        if($key > 0){
            if($key%$arParams["LINE_ELEMENT_COUNT"] == 0){
                echo "</div>";
                echo "<div class=\"s7spb-row s7spb-row12\">";
            }
        }
        else{

        }
    ?>

        <div id="<?=$this->GetEditAreaId($arElement['ID']);?>" class="s7spb-col text-center pb5 position-relative">
            <div class="s7spb-product-cell">
                <a href="#" class="d-block text-decoration-none text-tranqulity text-12 text-capitalize">

                    <?if(is_array($arElement["PREVIEW_PICTURE"])):?>
                        <div class="pb3">
                            <img src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>"
                                 class="img-100"
                                 height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>"
                                 width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>"
                                 title="<?=$arElement["PREVIEW_PICTURE"]["TITLE"]?>"
                                 alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>" />
                        </div>
                    <?endif;?>

                    <div class="pb1"><?=$arElement["NAME"]?></div>
                </a>

                <?foreach($arElement["PRICES"] as $code=>$arPrice):?>
                    <div class="text-<?=$code?> <?=$code == "price_yellow" ? "text-16" : "text-10"?>"
                         title="<?=$arResult["PRICES"][$code]["TITLE"]?>">
                        <?=$arPrice["PRINT_VALUE"]?>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    <?
    endforeach;

    if($key%$arParams["LINE_ELEMENT_COUNT"] > 0){
        $from = $key%$arParams["LINE_ELEMENT_COUNT"];
        $to = $arParams["LINE_ELEMENT_COUNT"] - $from;
        for($from; $from<$to; $from++){
            echo "<div class='s7spb-col'></div>";
        }
    }
    ?>


    </div>


    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <div class="text-center"><?=$arResult["NAV_STRING"]?></div>
    <?endif?>

</div>