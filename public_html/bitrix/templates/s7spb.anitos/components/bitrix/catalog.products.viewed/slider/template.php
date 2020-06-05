<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogTopComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (empty($arResult['ITEMS']))
    return;

Loc::loadLanguageFile(__FILE__);
?>


<div class="position-relative">


    <div class="s7spb-row row-center" id="products-viewed-items">

        <?foreach ($arResult['ITEMS'] as $i=>$arItem):?>
            <div id="products-viewed-item-<?=$i?>" class="products-viewed-item">

                <?
                switch ($arItem["STIKER"]["ID"]){
                    case 12:
                        echo '<div class="stiker" title="' . $arItem["STIKER"]["TITLE"] . '">' . $arItem["STIKER"]["CODE"] . '</div>';
                        break;
                    case 13:
                        echo '<div class="stiker stiker-primary" title="' . $arItem["STIKER"]["TITLE"] . '">' . $arItem["STIKER"]["CODE"] . '</div>';
                        break;
                    case 14:
                        echo '<div class="stiker stiker-warning" title="' . $arItem["STIKER"]["TITLE"] . '">' . $arItem["STIKER"]["CODE"] . '</div>';
                        break;
                    case 15:
                        echo '<div class="stiker" title="' . $arItem["STIKER"]["TITLE"] . '">' . $arItem["STIKER"]["CODE"] . '</div>';
                        break;
                }
                ?>

                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                         width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                         height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                         title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                         alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" />
                </a>

                <?if(!empty($arResult['PRICES'])):?>
                    <div class="py2">
                        <?
                        foreach ($arResult['PRICES'] as $codePrice=>$arPrice):
                            switch ($codePrice){
                                case "price_red":
                                    $arPrice["COLOR"] = "text-danger";
                                    break;
                                case "price_green":
                                    $arPrice["COLOR"] = "text-success-ultras";
                                    break;
                                case "price_yellow":
                                    $arPrice["COLOR"] = "text-warning";
                                    break;
                            }
                            $arPrice["PRINT_VALUE"] = $arResult['PRODUCT_PRICES'][$arItem["ID"]][$arPrice["ID"]]["PRINT_VALUE"];
                            $arPrice["VALUE"] = $arResult['PRODUCT_PRICES'][$arItem["ID"]][$arPrice["ID"]]["PRICE"];
                            ?>
                            <div class="s7spb-row s7spb-row-baseline mb2">
                                <?if($arPrice["VALUE"] > 999):?>
                                    <div class="s7spb-col text-14 text-height-16 <?=$arPrice["COLOR"]?>"><?=$arPrice["PRINT_VALUE"]?></div>
                                <?else:?>
                                    <div class="s7spb-col text-16 text-height-16 <?=$arPrice["COLOR"]?>"><?=$arPrice["PRINT_VALUE"]?></div>
                                <?endif;?>
                                <div class="s7spb-col text-11"><?=$arPrice["TITLE"]?></div>
                            </div>
                        <?endforeach;?>
                    </div>
                <?endif;?>

            </div>
        <?endforeach;?>

    </div>

    <?if(count($arResult['ITEMS']) > 6):?>
    <div class="carousel-controls">
        <div onclick="koorochkaProductsViewedSlider.slidePrev();" class="carousel-control-prev"></div>
        <div onclick="koorochkaProductsViewedSlider.slideNext();" class="carousel-control-next"></div>
    </div>
    <?endif;?>


</div>