<?
/**
 * @var CMain $APPLICATION
 */


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "CART" => $componentElementParams["CART"],
        "PATH" => SITE_DIR."include/top.user.view.products.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "standard.php"
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>