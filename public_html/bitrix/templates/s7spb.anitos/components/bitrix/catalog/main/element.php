<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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

use Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc,
    Bitrix\Main\Application;

Loc::loadLanguageFile(__FILE__);

global $brandInfo;

$request = Application::getInstance()->getContext()->getRequest();

$this->addExternalCss("/bitrix/templates/s7spb.anitos/assets/css/marketplace/catalog.element.detail.css");
$this->addExternalJs("//yastatic.net/es5-shims/0.0.2/es5-shims.min.js");
$this->addExternalJs("//yastatic.net/share2/share.js");
$this->setFrameMode(true);

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y') {
	$basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? array($arParams['COMMON_ADD_TO_BASKET_ACTION']) : array());
} else {
	$basketAction = (isset($arParams['DETAIL_ADD_TO_BASKET_ACTION']) ? $arParams['DETAIL_ADD_TO_BASKET_ACTION'] : array());
}
?>





<div class="container">
	<?
    $APPLICATION->ShowViewContent('ELEMENT_H_COMPANY');
    # start breadcrumb
    $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "",
        [
            "PATH" => "",
            "SITE_ID" => SITE_ID,
            "START_FROM" => "0"
        ],
        false,
        ["HIDE_ICONS" => "Y"]
    );

	$componentElementParams = array(
	    //"CART" => array(),
		//'FORUM_ID' => $arParams["FORUM_ID"],

        "AJAX_MODE" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "Y",

		'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'PROPERTY_CODE' => (isset($arParams['DETAIL_PROPERTY_CODE']) ? $arParams['DETAIL_PROPERTY_CODE'] : []),
		'META_KEYWORDS' => $arParams['DETAIL_META_KEYWORDS'],
		'META_DESCRIPTION' => $arParams['DETAIL_META_DESCRIPTION'],
		'BROWSER_TITLE' => $arParams['DETAIL_BROWSER_TITLE'],
		'SET_CANONICAL_URL' => $arParams['DETAIL_SET_CANONICAL_URL'],
		'BASKET_URL' => $arParams['BASKET_URL'],
		'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
		'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
		'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
		'CHECK_SECTION_ID_VARIABLE' => (isset($arParams['DETAIL_CHECK_SECTION_ID_VARIABLE']) ? $arParams['DETAIL_CHECK_SECTION_ID_VARIABLE'] : ''),
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
		'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
		'CACHE_TYPE' => $arParams['CACHE_TYPE'],
		'CACHE_TIME' => $arParams['CACHE_TIME'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
		'SET_TITLE' => $arParams['SET_TITLE'],
		'SET_LAST_MODIFIED' => $arParams['SET_LAST_MODIFIED'],
		'MESSAGE_404' => $arParams['~MESSAGE_404'],
		'SET_STATUS_404' => $arParams['SET_STATUS_404'],
		'SHOW_404' => $arParams['SHOW_404'],
		'FILE_404' => $arParams['FILE_404'],
		'PRICE_CODE' => $arParams['~PRICE_CODE'],

		/*
		'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
		'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
		'PRICE_VAT_SHOW_VALUE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
		'PRODUCT_PROPERTIES' => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),
		'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
		'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
		'LINK_IBLOCK_TYPE' => $arParams['LINK_IBLOCK_TYPE'],
		'LINK_IBLOCK_ID' => $arParams['LINK_IBLOCK_ID'],
		'LINK_PROPERTY_SID' => $arParams['LINK_PROPERTY_SID'],
		'LINK_ELEMENTS_URL' => $arParams['LINK_ELEMENTS_URL'],
        */


		'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
		//'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'],
		//'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
		//'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
		'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
		'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
		'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
		'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
		'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
		'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
		'STRICT_SECTION_CHECK' => (isset($arParams['DETAIL_STRICT_SECTION_CHECK']) ? $arParams['DETAIL_STRICT_SECTION_CHECK'] : ''),
		'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
		'LABEL_PROP' => $arParams['LABEL_PROP'],
		'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
		'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
		'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
		'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
		'DISCOUNT_PERCENT_POSITION' => (isset($arParams['DISCOUNT_PERCENT_POSITION']) ? $arParams['DISCOUNT_PERCENT_POSITION'] : ''),
		'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
		'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
		'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
		'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
		'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
		'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
		'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
		'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
		'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
		'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
		'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
		'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),
		'MESS_PRICE_RANGES_TITLE' => (isset($arParams['~MESS_PRICE_RANGES_TITLE']) ? $arParams['~MESS_PRICE_RANGES_TITLE'] : ''),
		'MESS_DESCRIPTION_TAB' => (isset($arParams['~MESS_DESCRIPTION_TAB']) ? $arParams['~MESS_DESCRIPTION_TAB'] : ''),
		'MESS_PROPERTIES_TAB' => (isset($arParams['~MESS_PROPERTIES_TAB']) ? $arParams['~MESS_PROPERTIES_TAB'] : ''),
		'MESS_COMMENTS_TAB' => (isset($arParams['~MESS_COMMENTS_TAB']) ? $arParams['~MESS_COMMENTS_TAB'] : ''),
		'MAIN_BLOCK_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE'] : ''),
		'MAIN_BLOCK_OFFERS_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE'] : ''),
		'USE_VOTE_RATING' => $arParams['DETAIL_USE_VOTE_RATING'],
		'VOTE_DISPLAY_AS_RATING' => (isset($arParams['DETAIL_VOTE_DISPLAY_AS_RATING']) ? $arParams['DETAIL_VOTE_DISPLAY_AS_RATING'] : ''),
		'USE_COMMENTS' => $arParams['DETAIL_USE_COMMENTS'],
		'BLOG_USE' => (isset($arParams['DETAIL_BLOG_USE']) ? $arParams['DETAIL_BLOG_USE'] : ''),
		'BLOG_URL' => (isset($arParams['DETAIL_BLOG_URL']) ? $arParams['DETAIL_BLOG_URL'] : ''),
		'BLOG_EMAIL_NOTIFY' => (isset($arParams['DETAIL_BLOG_EMAIL_NOTIFY']) ? $arParams['DETAIL_BLOG_EMAIL_NOTIFY'] : ''),
		'VK_USE' => (isset($arParams['DETAIL_VK_USE']) ? $arParams['DETAIL_VK_USE'] : ''),
		'VK_API_ID' => (isset($arParams['DETAIL_VK_API_ID']) ? $arParams['DETAIL_VK_API_ID'] : 'API_ID'),
		'FB_USE' => (isset($arParams['DETAIL_FB_USE']) ? $arParams['DETAIL_FB_USE'] : ''),
		'FB_APP_ID' => (isset($arParams['DETAIL_FB_APP_ID']) ? $arParams['DETAIL_FB_APP_ID'] : ''),
		'BRAND_USE' => (isset($arParams['DETAIL_BRAND_USE']) ? $arParams['DETAIL_BRAND_USE'] : 'N'),
		'BRAND_PROP_CODE' => (isset($arParams['DETAIL_BRAND_PROP_CODE']) ? $arParams['DETAIL_BRAND_PROP_CODE'] : ''),
		'DISPLAY_NAME' => (isset($arParams['DETAIL_DISPLAY_NAME']) ? $arParams['DETAIL_DISPLAY_NAME'] : ''),
		'IMAGE_RESOLUTION' => (isset($arParams['DETAIL_IMAGE_RESOLUTION']) ? $arParams['DETAIL_IMAGE_RESOLUTION'] : ''),
		'PRODUCT_INFO_BLOCK_ORDER' => (isset($arParams['DETAIL_PRODUCT_INFO_BLOCK_ORDER']) ? $arParams['DETAIL_PRODUCT_INFO_BLOCK_ORDER'] : ''),
		'PRODUCT_PAY_BLOCK_ORDER' => (isset($arParams['DETAIL_PRODUCT_PAY_BLOCK_ORDER']) ? $arParams['DETAIL_PRODUCT_PAY_BLOCK_ORDER'] : ''),
		'ADD_DETAIL_TO_SLIDER' => (isset($arParams['DETAIL_ADD_DETAIL_TO_SLIDER']) ? $arParams['DETAIL_ADD_DETAIL_TO_SLIDER'] : ''),
		'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
		'ADD_SECTIONS_CHAIN' => (isset($arParams['ADD_SECTIONS_CHAIN']) ? $arParams['ADD_SECTIONS_CHAIN'] : ''),
		// 'ADD_ELEMENT_CHAIN' => (isset($arParams['ADD_ELEMENT_CHAIN']) ? $arParams['ADD_ELEMENT_CHAIN'] : ''),
		'ADD_ELEMENT_CHAIN' => "N",



	);

	// User favorites
	\CBitrixComponent::includeComponentClass("studio7sbp:favorite");
	$favorite = new \studio7sbpFavorite();
	if($USER->IsAuthorized()){
		$favorite->onPrepareComponentParams(array("USER_ID" => $USER->GetID()));
        $componentElementParams["USER_ID"] = $USER->GetID();
	}

	// User basket
    if(CModule::IncludeModule("sale")){
        $dbBasketItems = CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL",
                //"PRODUCT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"]
            ),
            false,
            false,
            array("PRODUCT_ID", "QUANTITY")
        );
        while ($arItems = $dbBasketItems->Fetch())
        {
            $componentElementParams["CART"][$arItems["PRODUCT_ID"]] = $arItems["QUANTITY"];
        }
    }

    $componentElementParams["LANGUAGE_MODE"] = "en";
    if(!empty($request->get("lang"))){
        $componentElementParams["LANGUAGE_MODE"] = htmlspecialcharsbx($request->get("lang"));
        $_SESSION["LANGUAGE_MODE"] = $componentElementParams["LANGUAGE_MODE"];
    }
    if(!empty($_SESSION["LANGUAGE_MODE"])){
        $componentElementParams["LANGUAGE_MODE"] = $_SESSION["LANGUAGE_MODE"];
    }
?>
<div class="bg-white border-radius-10 px4 py5">

    <div class="row row-bottom text-roboto">
        <div class="col text-24 text-uppercase pb1"><?$APPLICATION->ShowTitle()?></div>
        <div class="col col-auto pb1">
            <?$APPLICATION->ShowViewContent('ELEMENT_TRADE_MARK');?>
        </div>
    </div>

    <div class="row row-baseline row20 text-roboto text-16">

        <div class="col">
            <div class="row bg-white-infras">
                <div class="col col-auto py1">
                    <?$APPLICATION->ShowViewContent('ELEMENT_ARTICLE');?>
                </div>
                <div class="col col-auto py1">
                    <?$APPLICATION->ShowViewContent('ELEMENT_BARCODE');?>
                </div>
                <div class="col col-auto text-success-ultras py1">
                    <i class="icon icon-avaliable"></i> В наличии
                </div>
            </div>
        </div>

        <div class="col">
            <div class="row">
                <div class="col col-auto text-14 text-dark">
                    Рейтинг:
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:iblock.vote",
                        "product_rating",
                        [
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "ELEMENT_ID" => $arResult['VARIABLES']['ELEMENT_ID'],
                            "MAX_VOTE" => 5,
                            "VOTE_NAMES" => array(),
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "DISPLAY_AS_RATING" => 'vote_avg'
                        ],
                        $component, array("HIDE_ICONS" =>"Y")
                    );?>
                </div>

                <div class="col col-auto text-14 text-info">
                    25 отзывов
                </div>

                <?if(in_array($arResult["VARIABLES"]["ELEMENT_ID"], $favorite->getUserFavorite())):?>
                    <div class="col col-auto text-14 cursor-pointer active"
                         data-title="<?=Loc::getMessage("ELEMENT_FAVORITE_WONT")?>"
                         data-titlein="<?=Loc::getMessage("ELEMENT_FAVORITE_IN")?>"
                         data-id="<?=$arResult["VARIABLES"]["ELEMENT_ID"]?>"
                         id="anitos-element-favorite"
                         onclick="anitosCatalogElement.toggleFavorite(this)">
                        <i class="icon icon-favorite-info square-16"></i>
                        <?=Loc::getMessage("ELEMENT_FAVORITE_WONT")?>
                    </div>
                <?else:?>
                    <div class="col col-auto text-14 cursor-pointer"
                         data-title="<?=Loc::getMessage("ELEMENT_FAVORITE_WONT")?>"
                         data-titlein="<?=Loc::getMessage("ELEMENT_FAVORITE_IN")?>"
                         data-id="<?=$arResult["VARIABLES"]["ELEMENT_ID"]?>"
                         id="anitos-element-favorite"
                         onclick="anitosCatalogElement.toggleFavorite(this)">
                        <i class="icon icon-favorite-info square-16"></i>
                        <?=Loc::getMessage("ELEMENT_FAVORITE_IN")?>
                    </div>
                <?endif;?>

                <div class="col col-auto text-14 text-info cursor-pointer">

                    <div class="s7sbp--marketplace--catalog-element-detail-product--header-line--item">
                        <div class="s7sbp--marketplace--catalog-element-detail-product--header-line--item--share">
                            <div class="share_wrapp">
                                <div class="text button transparent">
                                    <i class="icon icon-share"></i> <?=Loc::getMessage("ELEMENT_SHARE")?>
                                </div>
                                <div class="ya-share2 yashare-auto-init shares" data-services="vkontakte,facebook,twitter"></div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>

    </div>

<?
// <editor-fold defaultstate="collapsed" desc="# bitrix:catalog.element">
$elementId = $APPLICATION->IncludeComponent(
    'bitrix:catalog.element',
    'anitos',
    $componentElementParams,
    $component
);
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="# H_COMPANY">
if(!empty($brandInfo["VALUE"])) {

    // Filter sample
    //global $arrFilterBrand;
    //$arrFilterBrand = array("PROPERTY_FACTORY" => $brandInfo["VALUE"]);

    $this->SetViewTarget('ELEMENT_H_COMPANY');
    ?>
    <div class="py3 row">
        <div class="col">
            <?=$brandInfo["NAME"]?>
            <span class="p3 bg-danger h-company-link"><?=$brandInfo["DISPLAY_VALUE"]?></span>

        </div>
        <div class="col">
            <?
            echo Loc::getMessage("ELEMENT_REATING");
            $APPLICATION->IncludeComponent(
                "bitrix:iblock.vote",
                "product_rating",
                [
                    "IBLOCK_TYPE" => $brandInfo["LINK_ELEMENT_VALUE"][$brandInfo["VALUE"]]["IBLOCK_TYPE_ID"],
                    "IBLOCK_ID" => $brandInfo["LINK_ELEMENT_VALUE"][$brandInfo["VALUE"]]["IBLOCK_ID"],
                    "ELEMENT_ID" => $brandInfo["VALUE"],
                    "MAX_VOTE" => 5,
                    "VOTE_NAMES" => array(),
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "DISPLAY_AS_RATING" => 'vote_avg'
                ],
                $component,
                array("HIDE_ICONS" =>"Y")
            );
            ?>
        </div>
    </div>
    <?
    $this->EndViewTarget();
}
// </editor-fold>



?>
</div>

    <?$APPLICATION->IncludeComponent(
        'studio7sbp:bx.tabs',
        'anitos',
        [
            "REQUEST_PARAM" => "tab",
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "Y",
            "TABS" => [
                    [
                        "TITLE" => "Описание товара",
                        "CODE" => "about"
                    ],
                    [
                        "TITLE" => "Данные для конвертации",
                        "CODE" => "data"
                    ],
                    [
                        "TITLE" => "Отзывы",
                        "CODE" => "reviews"
                    ],
                    [
                        "TITLE" => "Доставка и оплата",
                        "CODE" => "delivery"
                    ],
                    [
                        "TITLE" => "Гарантии продавца",
                        "CODE" => "garanty"
                    ]
            ],
            "REVIEWS" => [
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
                "USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
                "PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
                "FORUM_ID" => $arParams["FORUM_ID"],
                "URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
                "SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
                "DATE_TIME_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
                "ELEMENT_ID" => $elementId,
                "AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "URL_TEMPLATES_DETAIL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
            ]
        ],
        false,
        ["HIDE_ICONS" => "Y"]
    );?>

<?
// <editor-fold defaultstate="collapsed" desc=" # Get recomend data like also buy">
global $arRecomData;
$arRecomData = array();
$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
$obCache = new CPHPCache();
if ($obCache->InitCache($arParams["CACHE_TIME"], serialize($recomCacheID), "/catalog/recommended"))
{
    $arRecomData = $obCache->GetVars();
}
elseif ($obCache->StartDataCache())
{
    if (Loader::includeModule("sale"))
    {
        $orders = array();
        $items = \Bitrix\Sale\Basket::getList(array(
            "filter" => array(
                "!ORDER_ID" => false,
                "PRODUCT_ID" => $elementId
            ),
            "select" => array("ORDER_ID")
        ));
        while ($item = $items->fetch())
        {
            $orders[] = $item["ORDER_ID"];
        }

        /**
         * Get basket items by orders exept that product
         */
        if(!empty($orders)){
            $arRecomData = array();
            $items = \Bitrix\Sale\Basket::getList(array(
                "filter" => array(
                    "ORDER_ID" => $orders,
                    "!PRODUCT_ID" => $elementId
                ),
                "select" => array("PRODUCT_ID")
            ));
            while ($item = $items->fetch())
            {
                $arRecomData[] = $item["PRODUCT_ID"];
            }
        }

        if (!empty($arRecomData))
        {
            if(defined("BX_COMP_MANAGED_CACHE"))
            {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache("/catalog/recommended");
                $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
                $CACHE_MANAGER->EndTagCache();
            }
        }
    }
    $obCache->EndDataCache($arRecomData);
}
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc=" # Output also buy block">
if(!empty($arRecomData))
{
    $arRecomData = array(
        "ID" => $arRecomData
    );
	$arParams["FILTER_NAME"] = "arRecomData";
}


foreach ($arParams["~PRICE_CODE"] as $key => $val){
	if (
	        $val == "FOB" ||
	        $val == "quickly_price"
    ){
		unset($arParams["PRICE_CODE"][$key]);
		unset($arParams["~PRICE_CODE"][$key]);
	}
}

?>
<div class="border border-radius-10 bg-white my3">
    <div class="text-20 text-uppercase p3">C этим товаром покупают</div>

<?
$APPLICATION->IncludeComponent(
	"bitrix:catalog.top",
	"mainpage",
	array(
        ### TODO START Emulation
        "Emulation" => "LABEL",
        "VIEW_MODE" => "SLIDER",
        ### TODO END Emulation
	    "USER_ID" => $USER->GetID(),
	    "CART" => $componentElementParams["CART"],
		"MESS_BLOCK_LABEL" => Loc::getMessage("RECCOMEND_LABEL"),
		"BLOCK_LABEL_TYPE" => "RECCOMEND",
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
		"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : array()),
		"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["~MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PAGE_ELEMENT_COUNT" => $arParams["TOP_PRODUCT_ROW_VARIANTS"],
		"ELEMENT_COUNT" => $arParams["TOP_PRODUCT_ROW_VARIANTS"],
		"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => $arParams["~PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
		"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
		"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : array())
	),
    false,
    ["HIDE_ICONS" => "Y"]
);
?>
</div>
<?
// </editor-fold>
?>

    <div class="mb4">
        <img src="<?=$this->GetFolder()?>/images/discont20.jpg">
    </div>

    <section class="row row1200-column row12 bg-roso pb6">
        <div class="col bg-white border-radius-10">
            <div class="text-20 text-semibold text-uppercase pt3 pl5">Похожие товары</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.top",
                "mainpage",
                array(
                    ### TODO Emulation
                    "Emulation" => "LABEL",
                    "VIEW_MODE" => "SLIDER",
                    "IBLOCK_ID" => "2",
                    "COMPONENT_TEMPLATE" => "mainpage",
                    "IBLOCK_TYPE" => "marketplace",
                    "FILTER_NAME" => "",
                    "CUSTOM_FILTER" => "",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                    "ELEMENT_SORT_FIELD" => "sort",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "ELEMENT_SORT_FIELD2" => "id",
                    "ELEMENT_SORT_ORDER2" => "desc",
                    "ELEMENT_COUNT" => "9",
                    "LINE_ELEMENT_COUNT" => "3",
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE_MOBILE" => array(
                    ),
                    "OFFERS_LIMIT" => "5",
                    "USER_FAVORITES" => "",
                    "TEMPLATE_THEME" => "blue",
                    "ADD_PICT_PROP" => "-",
                    "LABEL_PROP" => "",
                    "SHOW_DISCOUNT_PERCENT" => "N",
                    "SHOW_OLD_PRICE" => "N",
                    "SHOW_MAX_QUANTITY" => "N",
                    "SHOW_CLOSE_POPUP" => "N",
                    "ROTATE_TIMER" => "30",
                    "SHOW_PAGINATION" => "N",
                    "PRODUCT_SUBSCRIPTION" => "Y",
                    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                    "ENLARGE_PRODUCT" => "STRICT",
                    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                    "SHOW_SLIDER" => "Y",
                    "SLIDER_INTERVAL" => "3000",
                    "SLIDER_PROGRESS" => "N",
                    "MESS_BTN_BUY" => "Купить",
                    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                    "MESS_BTN_DETAIL" => "Подробнее",
                    "MESS_NOT_AVAILABLE" => "Нет в наличии",
                    "MESS_BLOCK_LABEL" => "",
                    "BLOCK_LABEL_TYPE" => "RECCOMEND",
                    "SECTION_URL" => "",
                    "DETAIL_URL" => "",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "SEF_MODE" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_FILTER" => "N",
                    "ACTION_VARIABLE" => "action",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "PRICE_CODE" => array(
                    ),
                    "USE_PRICE_COUNT" => "N",
                    "SHOW_PRICE_COUNT" => "1",
                    "PRICE_VAT_INCLUDE" => "Y",
                    "CONVERT_CURRENCY" => "N",
                    "BASKET_URL" => "/personal/basket.php",
                    "USE_PRODUCT_QUANTITY" => "N",
                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                    "PRODUCT_PROPERTIES" => array(
                    ),
                    "ADD_TO_BASKET_ACTION" => "ADD",
                    "DISPLAY_COMPARE" => "N",
                    "MESS_BTN_COMPARE" => "Сравнить",
                    "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
                    "USE_ENHANCED_ECOMMERCE" => "N",
                    "COMPATIBLE_MODE" => "Y"
                ),
                false,
                ["HIDE_ICONS" => "Y"]
            );?>
        </div>
        <div class="col bg-white border-radius-10">
            <div class="text-20 text-semibold text-uppercase pt3 pl5">Вы смотрели</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.top",
                "mainpage",
                array(
                    ### TODO Emulation
                    "Emulation" => "LABEL",
                    "VIEW_MODE" => "SLIDER",
                    "IBLOCK_ID" => "2",
                    "COMPONENT_TEMPLATE" => "mainpage",
                    "IBLOCK_TYPE" => "marketplace",
                    "FILTER_NAME" => "",
                    "CUSTOM_FILTER" => "",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                    "ELEMENT_SORT_FIELD" => "sort",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "ELEMENT_SORT_FIELD2" => "id",
                    "ELEMENT_SORT_ORDER2" => "desc",
                    "ELEMENT_COUNT" => "9",
                    "LINE_ELEMENT_COUNT" => "3",
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE_MOBILE" => array(
                    ),
                    "OFFERS_LIMIT" => "5",
                    "USER_FAVORITES" => "",
                    "TEMPLATE_THEME" => "blue",
                    "ADD_PICT_PROP" => "-",
                    "LABEL_PROP" => "",
                    "SHOW_DISCOUNT_PERCENT" => "N",
                    "SHOW_OLD_PRICE" => "N",
                    "SHOW_MAX_QUANTITY" => "N",
                    "SHOW_CLOSE_POPUP" => "N",
                    "ROTATE_TIMER" => "30",
                    "SHOW_PAGINATION" => "N",
                    "PRODUCT_SUBSCRIPTION" => "Y",
                    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                    "ENLARGE_PRODUCT" => "STRICT",
                    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                    "SHOW_SLIDER" => "Y",
                    "SLIDER_INTERVAL" => "3000",
                    "SLIDER_PROGRESS" => "N",
                    "MESS_BTN_BUY" => "Купить",
                    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                    "MESS_BTN_DETAIL" => "Подробнее",
                    "MESS_NOT_AVAILABLE" => "Нет в наличии",
                    "MESS_BLOCK_LABEL" => "New",
                    "BLOCK_LABEL_TYPE" => "RECCOMEND",
                    "SECTION_URL" => "",
                    "DETAIL_URL" => "",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "SEF_MODE" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_FILTER" => "N",
                    "ACTION_VARIABLE" => "action",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "PRICE_CODE" => array(
                    ),
                    "USE_PRICE_COUNT" => "N",
                    "SHOW_PRICE_COUNT" => "1",
                    "PRICE_VAT_INCLUDE" => "Y",
                    "CONVERT_CURRENCY" => "N",
                    "BASKET_URL" => "/personal/basket.php",
                    "USE_PRODUCT_QUANTITY" => "N",
                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                    "PRODUCT_PROPERTIES" => array(
                    ),
                    "ADD_TO_BASKET_ACTION" => "ADD",
                    "DISPLAY_COMPARE" => "N",
                    "MESS_BTN_COMPARE" => "Сравнить",
                    "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
                    "USE_ENHANCED_ECOMMERCE" => "N",
                    "COMPATIBLE_MODE" => "Y"
                ),
                false,
                ["HIDE_ICONS" => "Y"]
            );?>
        </div>
    </section>

<div class="anitos-disconts pb4">
    <?$APPLICATION->IncludeComponent(
        "bitrix:catalog.top",
        "mainpage",
        array(
            ### TODO Emulation
            "Emulation" => "LABEL",
            "VIEW_MODE" => "SLIDER",
            "SLIDER_TEMPLATE" => "discont_40",
            //"TEMPLATE_THEME" => "wood",

            "IBLOCK_ID" => "2",
            "COMPONENT_TEMPLATE" => "mainpage",
            "IBLOCK_TYPE" => "marketplace",
            "FILTER_NAME" => "",
            "CUSTOM_FILTER" => "",
            "HIDE_NOT_AVAILABLE" => "N",
            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
            "ELEMENT_SORT_FIELD" => "sort",
            "ELEMENT_SORT_ORDER" => "asc",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER2" => "desc",
            "ELEMENT_COUNT" => "20",
            "LINE_ELEMENT_COUNT" => "4",
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "PROPERTY_CODE_MOBILE" => array(
            ),
            "OFFERS_LIMIT" => "5",
            "USER_FAVORITES" => "",
            "ADD_PICT_PROP" => "-",
            "LABEL_PROP" => "",
            "SHOW_DISCOUNT_PERCENT" => "N",
            "SHOW_OLD_PRICE" => "N",
            "SHOW_MAX_QUANTITY" => "N",
            "SHOW_CLOSE_POPUP" => "N",
            "ROTATE_TIMER" => "30",
            "SHOW_PAGINATION" => "N",
            "PRODUCT_SUBSCRIPTION" => "Y",
            "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
            "ENLARGE_PRODUCT" => "STRICT",
            "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
            "SHOW_SLIDER" => "Y",
            "SLIDER_INTERVAL" => "3000",
            "SLIDER_PROGRESS" => "N",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "MESS_BLOCK_LABEL" => "СКИДКИ до <span class='text-30'>40</span>%",
            "BLOCK_LABEL_TYPE" => "RECCOMEND",
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "SEF_MODE" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "CACHE_FILTER" => "N",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRICE_CODE" => array(
            ),
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "BASKET_URL" => "/personal/basket.php",
            "USE_PRODUCT_QUANTITY" => "N",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRODUCT_PROPERTIES" => array(
            ),
            "ADD_TO_BASKET_ACTION" => "ADD",
            "DISPLAY_COMPARE" => "N",
            "MESS_BTN_COMPARE" => "Сравнить",
            "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
            "USE_ENHANCED_ECOMMERCE" => "N",
            "COMPATIBLE_MODE" => "Y"
        ),
        false,
        ["HIDE_ICONS" => "Y"]
    );?>
</div>
</div>