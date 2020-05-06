<div class="col bg-white border-radius-10">
    <div class="text-20 text-semibold text-uppercase p3 pl5">Вы смотрели</div>
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
            "ELEMENT_COUNT" => "8",
            "LINE_ELEMENT_COUNT" => "4",
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
        false
    );?>
</div>