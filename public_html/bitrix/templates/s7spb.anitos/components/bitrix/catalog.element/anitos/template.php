<?
/**
 * @var array $arResult
 */
use Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
Loc::loadLanguageFile(__FILE__);

// <editor-fold defaultstate="s7spb-collapsed" desc="# View targets">

$this->SetViewTarget('TABS_DETAIL_TEXT');
    echo "<p>";
    echo $arResult["DETAIL_TEXT"]["context"];
    echo "</p>";
    echo "<p>";
    echo $arResult["DETAIL_TEXT"]["description"];
    echo "</p>";
$this->EndViewTarget();

$this->SetViewTarget('TABS_CONVERT_DATA');
    d($arResult["DETAIL_TEXT"]);
    unset($arResult["DETAIL_TEXT"]);
    d($arResult);
$this->EndViewTarget();

$this->SetViewTarget('FORUM_MESSAGE_CNT');
echo Loc::getMessage("PROPERTIES_FORUM_MESSAGE_CNT", [
    "NUM" => $arResult["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"] ? $arResult["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"] : 0
]);
$arEnds = [
    Loc::getMessage("TSB1_WORD_OBNOVL_END1"),
    Loc::getMessage("TSB1_WORD_OBNOVL_END2"),
    Loc::getMessage("TSB1_WORD_OBNOVL_END3"),
    Loc::getMessage("TSB1_WORD_OBNOVL_END4")
];

if (
        $arResult["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"]>1 &&
        substr($arResult["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"], strlen($arResult["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"])-2, 1)=="1")
{
    echo $arEnds[0];
}
else
{
    $c = IntVal(substr($arResult["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"], strlen($arResult["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"])-1, 1));
    if ($c==0 || ($c>=5 && $c<=9))
        echo $arEnds[1];
    elseif ($c==1)
        echo $arEnds[2];
    else
        echo $arEnds[3];
}

    // ForumNumberWordEndings($arResult["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"]);
$this->EndViewTarget();

if (!function_exists('ForumNumberWordEndings'))
{
    function ForumNumberWordEndings($num)
    {
        if ($arEnds===false)


        if (strlen($num)>1 && substr($num, strlen($num)-2, 1)=="1")
        {
            return $arEnds[0];
        }
        else
        {
            $c = IntVal(substr($num, strlen($num)-1, 1));
            if ($c==0 || ($c>=5 && $c<=9))
                return $arEnds[1];
            elseif ($c==1)
                return $arEnds[2];
            else
                return $arEnds[3];
        }
        
    }
}

// H_COMPANY
// AddMessage2Log($arResult['MORE_PHOTO']);

// </editor-fold>
?>

<div class="s7spb-row py5">
    <div class="s7spb-col"
         id="anitos-catalog-element-photos">

        <?if(count($arResult['MORE_PHOTO']) > 1):?>
            <!--- START SLIDER --->
            <ul id="anitos-catalog-element-thumbs">
                <?foreach ($arResult['MORE_PHOTO'] as $photo):?>
                    <li>
                        <img src="<?=$photo["THUMB"]["src"]?>"
                             height="<?=$photo["THUMB"]["height"]?>"
                             width="<?=$photo["THUMB"]["width"]?>" />
                    </li>
                <?endforeach;?>
            </ul>
            <img src="<?=$arResult['MORE_PHOTO'][0]["BIG"]?>" class="d-inline-block" />
            <!--- END SLIDER --->
        <?else:?>
            <img src="<?=SITE_TEMPLATE_PATH?>/images/no_image400.jpg" class="d-inline-block" />
        <?endif;?>

    </div>
    <div class="s7spb-col text-16 text-gray" id="anitos-catalog-element-properties">
        <!--- Start properties --->
        <div class="s7spb-row border-dotted-bottom border-gray mb1 ">
            <div class="s7spb-col s7spb-col-auto position-relative top2 bg-white">ID номер на портале</div>
            <div class="s7spb-col s7spb-col-auto position-relative top2 bg-white"><?=$arResult["ID"]?></div>
        </div>

        <?
        foreach ($arResult["DISPLAY_PROPERTIES"] as $code=>$arProperty):

            // <editor-fold defaultstate="s7spb-collapsed" desc="# View targets">
            switch ($code){
                case "BARCODE";
                    $this->SetViewTarget('ELEMENT_BARCODE');
                        echo $arProperty["NAME"] . ": " . $arProperty["DISPLAY_VALUE"];
                    $this->EndViewTarget();
                break;
                case "ARTICLE";
                    $this->SetViewTarget('ELEMENT_ARTICLE');
                        echo $arProperty["NAME"] . ": <b>" . $arProperty["DISPLAY_VALUE"] . "</b>";
                    $this->EndViewTarget();
                break;
                case "TRADE_MARK";
                    $this->SetViewTarget('ELEMENT_TRADE_MARK');
                    ?>
                    <a href="<?=$arProperty["LINK_ELEMENT_VALUE"][$arProperty["VALUE"]]["DETAIL_PAGE_URL"]?>"
                       class="bg-danger text-white text-24 text-bold d-block text-decoration-none text-uppercase"
                       style="height: 44px; width: 44px; line-height: 44px; text-align: center;">
                        <?=substr($arProperty["LINK_ELEMENT_VALUE"][$arProperty["VALUE"]]["NAME"], 0, 1)?>
                    </a>
                    <?
                    $this->EndViewTarget();
                break;
            }
            // </editor-fold>
        ?>
            <div class="s7spb-row border-dotted-bottom border-gray mb1">
                <div class="s7spb-col s7spb-col-auto position-relative top2 bg-white"><?=$arProperty["NAME"]?></div>
                <div class="s7spb-col s7spb-col-auto position-relative top2 bg-white"><?=$arProperty["DISPLAY_VALUE"]?></div>
            </div>
        <?endforeach;?>

        <!--- End properties --->
    </div>
    <form class="s7spb-col"
          id="anitos-catalog-element-sale"
          data-siteid="<?=SITE_ID?>"
          data-id="<?=$arResult["ID"]?>"
          action="<?=$arResult["DETAIL_PAGE_URL"]?>"
          method="post">

        <input type="hidden" name="action" value="ADD2BASKET">
        <input type="hidden" name="id" value="<?=$arResult["ID"]?>">
        <?=bitrix_sessid_post()?>

        <!---- START ART ----->

        <div>

            <div class="mb2 text-16">
                Цена:
            </div>

            <?if(!empty($arResult["PRICES"])):?>
                <?
                foreach ($arResult["PRICES"] as $code=>$arPrice):
                    switch ($code){
                        case "price_red":
                            ?>
                            <div class="s7spb-row s7spb-row-baseline mb2">
                                <div class="s7spb-col text-18 text-danger"><?=$arPrice["PRINT_VALUE"]?></div>
                            </div>
                            <?
                            break;
                        case "price_yellow":
                            ### $arPrice["TITLE"] = "от 10 000 ₽";
                            ?>
                            <div class="s7spb-row s7spb-row-baseline mb2">
                                <div class="s7spb-col text-28 text-warning">
                                    <?=$arPrice["PRINT_VALUE"]?>

                                    <div class="circle-24 text-20 ml5 cursor-pointer bg-gray text-bold text-gray d-inline-block">i</div>
                                </div>
                            </div>
                            <?
                            break;
                        case "price_green":
                            ?>
                            <div class="s7spb-row s7spb-row-baseline mb2">
                                <div class="s7spb-col text-18 text-success-ultras"><?=$arPrice["PRINT_VALUE"]?></div>
                            </div>
                            <?
                            break;
                    }
                    ?>


                <?
                endforeach;
                ?>
            <?endif;?>

            <div class="s7spb-row s7spb-row12 mt3">
                <div class="s7spb-col s7spb-col-auto">
                    <div class="s7spb-row quantity-counter">
                        <div class="s7spb-col quantity-counter-minus"
                             onclick="quantityCounter.down(this)">&ndash;</div>
                        <input type="text"
                               name="<?=$arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"]?>"
                               value="1"
                               class="s7spb-col" />
                        <div class="s7spb-col quantity-counter-plus"
                             onclick="quantityCounter.up(this)">+</div>
                    </div>
                </div>
                <div class="s7spb-col">
                    <input type="submit"
                           class="btn btn-info px5 text-bold text-uppercase text-roboto text-16 text-white border-radius-0 mb1 h42 cursor-pointer"
                           value="купить" />

                    <a href="#" class="text-info d-block">Как заказать оптом</a>
                </div>
            </div>

        </div>

        <!----- END ART ---->

    </form>

</div>