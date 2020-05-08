<?
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
$arParams["SORT"] = [
    "PARAMS" => [
        "sort_date"
    ]
];
$arParams["SORT"]["ITEMS"] = [
    "ITEMS" => [
        [
            "TEXT" => Loc::getMessage("BASKET_HEAD_SORT_DATE"),
            "ARROW" => "&uarr;",
            "HREF" => $APPLICATION->GetCurPageParam("sort_date=asc", $arParams["SORT"]["PARAMS"])
        ],
        [
            "TEXT" => Loc::getMessage("BASKET_HEAD_SORT_NEW"),
            "HREF" => $APPLICATION->GetCurPageParam("sort_new=asc", $arParams["SORT"]["PARAMS"])
        ],
        [
            "TEXT" => Loc::getMessage("BASKET_HEAD_SORT_PRICE"),
            "ARROW" => "&darr;",
            "HREF" => $APPLICATION->GetCurPageParam("sort_price=asc", $arParams["SORT"]["PARAMS"])
        ],
        [
            "TEXT" => Loc::getMessage("BASKET_HEAD_SORT_SUM"),
            "HREF" => $APPLICATION->GetCurPageParam("sort_sum=asc", $arParams["SORT"]["PARAMS"])
        ],
        [
            "TEXT" => Loc::getMessage("BASKET_HEAD_SORT_NAME"),
            "HREF" => $APPLICATION->GetCurPageParam("sort_name=asc", $arParams["SORT"]["PARAMS"])
        ],
        [
            "TEXT" => Loc::getMessage("BASKET_HEAD_SORT_ARTICLE"),
            "HREF" => $APPLICATION->GetCurPageParam("sort_article=asc", $arParams["SORT"]["PARAMS"])
        ]
    ]
];

$arParams["ACTIONS"] = [
    "ITEMS" => [
        [
            "TEXT" => Loc::getMessage("BASKET_HEAD_ACTIONS_ADD_ARTICLE"),
            "CLICK" => 'return saleBasket.articleShowForm(this)',
            "DATA" => [
                "title" => Loc::getMessage("BASKET_HEAD_ACTIONS_ADD_ARTICLE"),
                "btn-yes" => Loc::getMessage("BASKET_ARTICLE_BTN_YES"),
                "btn-no" => Loc::getMessage("BASKET_ARTICLE_BTN_NO"),
                "input" => Loc::getMessage("BASKET_ARTICLE_INPUT")
            ]
        ],
        [
            "TEXT" => Loc::getMessage("BASKET_HEAD_ACTIONS_ADD_FILE"),
            "CLICK" => 'return saleBasket.excelShowForm(this)',
            "DATA" => [
                "title" => Loc::getMessage("BASKET_HEAD_ACTIONS_ADD_ARTICLE"),
                "btn-yes" => Loc::getMessage("BASKET_ARTICLE_BTN_YES"),
                "btn-no" => Loc::getMessage("BASKET_ARTICLE_BTN_NO"),
                "input" => Loc::getMessage("BASKET_ARTICLE_INPUT")
            ]
        ],
        [
            "TEXT" => Loc::getMessage("BASKET_HEAD_ACTIONS_ADD_SAVE"),
            "CLICK" => 'return multiplebasketPopup.open(this)'
        ],
        [
            "TEXT" => Loc::getMessage("BASKET_HEAD_ACTIONS_ADD_SHARE"),
            "CLICK" => 'return saleBasket.toggleShare()'
        ],
    ]
];
?>

<div class="s7spb-row s7spb-row-center">
    <div class="s7spb-col">
        <?=Loc::getMessage("BASKET_HEAD_SORT_TITLE")?>:

        <?foreach ($arParams["SORT"]["ITEMS"] as $i=>$arItem):?>
            <a href="<?=$arItem["HREF"]?>"
               class="text-decoration-none pl3 pr2 text-13 <?=!$i ? "text-info" : "text-gray"?>">
                <?
                echo $arItem["TEXT"];
                if(!empty($arItem["ARROW"]))
                    echo " " . $arItem["ARROW"];
                ?>
            </a>
        <?endforeach;?>
    </div>
    <div class="s7spb-col s7spb-col-auto">

        <a href="/catalog/" class="text-info px3 text-decoration-none"><i class="icon icon-reload text-vertical-middle"></i> Вернуться к покупкам</a>

        <a href="/order/"
           class="btn btn-info px5 text-bold text-uppercase text-roboto text-16 text-white border-radius-0 mb1 cursor-pointer">
            Оформить заказ
        </a>

    </div>
</div>


<div class="s7spb-row s7spb-row-center">
    <div class="s7spb-col s7spb-col-auto">
        <?=Loc::getMessage("BASKET_HEAD_CHECKED_TITLE")?>
        <span class="px1 cursor-pointer"
              data-title="<?=Loc::getMessage("BASKET_CNT_DELETES_TITLE")?>"
              data-desc="<?=Loc::getMessage("BASKET_CNT_DELETES_DESC")?>"
              data-delete="<?=Loc::getMessage("BASKET_CNT_DELETE")?>"
              data-cancel="<?=Loc::getMessage("BASKET_CNT_CANCELS")?>"
              title="<?=Loc::getMessage("BASKET_CNT_REMOVE")?>"
              onclick="saleBasket.deleteSelectedConfirm(this)">
            <i class="icon-delete"></i> <?=Loc::getMessage("BASKET_HEAD_CHECKED_DELETE")?>
        </span>
        <span class="px1 cursor-pointer"
              title="<?=Loc::getMessage("BASKET_ITEM_FAVORITE")?>"
              onclick="saleBasket.favoriteSelected()">
            <i class="item-favorite-fill"></i>
            <?=Loc::getMessage("BASKET_HEAD_CHECKED_FAVORITE_WONT")?>
        </span>
    </div>
    <div class="s7spb-col text-right">
        <?foreach ($arParams["ACTIONS"]["ITEMS"] as $arItem):?>
            <span class="position-relative">

                <a href="#"
                   <?if(isset($arItem["CLICK"])):?>
                    onclick='<?=$arItem["CLICK"]?>'
                   <?endif;?>
                   <?if(is_array($arItem["DATA"])):?>
                        <?foreach ($arItem["DATA"] as $key=>$value):?>
                            data-<?=$key?>="<?=$value?>"
                        <?endforeach;?>
                   <?endif;?>
                   class="p3 text-black-hole text-decoration-none d-inline-block"><?=$arItem["TEXT"]?></a>

                <?if(Loc::getMessage("BASKET_HEAD_ACTIONS_ADD_SHARE") == $arItem["TEXT"]):?>
                    <div id="element-share" class="d-none">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.share",
                            "universal",
                            Array(
                                "HANDLERS" => array("vk", "facebook", "twitter"),
                                "HIDE" => "N",
                                "PAGE_TITLE" => "",
                                "PAGE_URL" => "",
                                "SHORTEN_URL_KEY" => "",
                                "SHORTEN_URL_LOGIN" => ""
                            )
                        );?>
                    </div>
                <?endif;?>

            </span>
        <?endforeach;?>
    </div>
</div>
