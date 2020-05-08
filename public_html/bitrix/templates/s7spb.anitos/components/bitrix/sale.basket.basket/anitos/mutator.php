<?

use Bitrix\Catalog\PriceTable;
use Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
Loc::loadLanguageFile(__FILE__);


/**
 *
 * This file modifies result for every request (including AJAX).
 * Use it to edit output result for "{{ mustache }}" templates.
 *
 * @var array $result
 * Prepare
 */

$result["MARKET_LIST"] = array();
$result["SPACE"] = array(
    "TOTAL" => array(
        "LHW_ctn" => 0,
        "WEIGHT" => 0
    ),
    "NUMBER_ROUND" => 2
);
$result["PRODUCT_PRICES"] = [];

/**
 * Favorite feature
 */
/// Add favorite feature
\CBitrixComponent::includeComponentClass("studio7sbp:favorite");
$favorite = new \studio7sbpFavorite();
global $USER;
$favorite->onPrepareComponentParams(array("USER_ID" => $USER->GetID()));
$result["USER_FAVORITE"] = $favorite->getUserFavorite();

/**
 * Basket items
 */
$ID = [];
foreach ($this->basketItems as $arItem)
{

    # collect id
    $ID = [];
    # collect prices
    $prices = PriceTable::getList([
        "filter" => [
            "PRODUCT_ID" => $arItem["PRODUCT_ID"]
        ],
        "select" => [
            "CATALOG_GROUP_ID",
            "PRODUCT_ID",
            "PRICE",
            "CURRENCY",
        ]
    ]);

    while ($price = $prices->fetch()){
        $price["PRICE_FORMATED"] = $price["PRICE"];
        $result["PRODUCT_PRICES"][$price["PRODUCT_ID"]][$price["CATALOG_GROUP_ID"]] = $price;
    }


}

// CURRENCIES FORMAT
$result["CURRENCIES_FORMAT"] = array();
foreach ($result["CURRENCIES"] as $currency){
    $result["CURRENCIES_FORMAT"][$currency["CURRENCY"]] = $currency["FORMAT"]["FORMAT_STRING"];
}

// get iblock elements data

 if(empty($ID) && Loader::includeModule("iblock")){
     $result["ELEMENTS"] = [];
     $elements = CIBlockElement::GetList(
         [],
         [
             "IBLOCK_TYPE" => "marketplace",
             "IBLOCK_ID" => "2",
             "ID" => $ID
         ],
         false,
         false,
         [
             "ID",
             "PROPERTY_ARTICLE"
         ]
     );
     d($elements->SelectedRowsCount());
     while($element = $elements->Fetch()){
         $result["ELEMENTS"][$element["ID"]] = $element;
     }
 }
