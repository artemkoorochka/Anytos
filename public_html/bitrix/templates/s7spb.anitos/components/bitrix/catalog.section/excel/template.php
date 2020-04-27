<?
// <editor-fold defaultstate="s7spb-collapsed" desc=" # Preparacia">
/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

$arParams["ALFAVITE"] = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG");
// </editor-fold>

$objPHPExcel = new PHPExcel();

// <editor-fold defaultstate="s7spb-collapsed" desc=" # Stiliziren">
$objPHPExcel->getActiveSheet()->freezePane('C3');
$objPHPExcel->getActiveSheet()->gets7spb-columnDimension('B')->setWidth(80);
$objPHPExcel->getActiveSheet()->gets7spb-columnDimension('C')->setWidth(16);
// </editor-fold>

// <editor-fold defaultstate="s7spb-collapsed" desc=" # Cicle items">
if(!empty($arResult['ITEMS'])){

    $i = 1;
    $i++;

    $objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setIndent(2);
    $objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->gets7spb-rowDimension($i)->sets7spb-rowHeight(22);
    $objPHPExcel->getActiveSheet()->getStyle($i)->getFont()->setSize(18);
    $objPHPExcel->getActiveSheet()->getStyle($i)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle($i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStarts7spb-color()->setRGB('ff6f00');
    $objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($i)->getFont()->gets7spb-color()->setARGB(PHPExcel_Style_s7spb-color::s7spb-colOR_WHITE);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("B" . $i, Loc::getMessage("CATALOG_SECTION_NAME"), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("C" . $i, Loc::getMessage("CATALOG_SECTION_PRICE"), PHPExcel_Cell_DataType::TYPE_STRING);

    $j = 2;
    foreach ($arParams["PROPERTY_CODE"] as $code){
        $j++;
        if(is_set($arParams["ALFAVITE"][$j])){
            $objPHPExcel->getActiveSheet()->gets7spb-columnDimension($arParams["ALFAVITE"][$j])->setWidth(30);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit($arParams["ALFAVITE"][$j] . $i, $arResult['ITEMS'][0]["PROPERTIES"][$code]["NAME"], PHPExcel_Cell_DataType::TYPE_STRING);
        }
    }


    $i++;

    foreach ($arResult['ITEMS'] as $arItem){
        $i++;
        $objPHPExcel->getActiveSheet()->gets7spb-rowDimension($i)->sets7spb-rowHeight(18);
        $objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->setCellValueExplicit("B" . $i, $arItem["NAME"], PHPExcel_Cell_DataType::TYPE_STRING);

        // Price format feature
        // $arItem["MIN_PRICE"]["PRINT_VALUE"]
        // 1&amp;nbsp;002.60 руб.
        // $arItem["MIN_PRICE"]["PRINT_VALUE"] = str_replace(array("&amp;", "&nbsp;", "&amp;nbsp;"), " ", $arItem["MIN_PRICE"]["PRINT_VALUE"]);

        $objPHPExcel->getActiveSheet()->setCellValueExplicit("C" . $i, $arItem["MIN_PRICE"]["VALUE"], PHPExcel_Cell_DataType::TYPE_STRING);

        $j = 2;
        foreach ($arParams["PROPERTY_CODE"] as $code){
            $j++;
            if(is_set($arParams["ALFAVITE"][$j])){

                $property = $arItem["DISPLAY_PROPERTIES"][$code];
                if(empty($property)){
                    $property = $arItem["PROPERTIES"][$code];
                    $property["DISPLAY_VALUE"] = $property["VALUE"];
                }

                if($code == "TRADE_MARK"){
                    $property["DISPLAY_VALUE"] = $property["LINK_ELEMENT_VALUE"][$property["VALUE"]]["NAME"];
                }

                $objPHPExcel->getActiveSheet()->setCellValueExplicit($arParams["ALFAVITE"][$j] . $i, $property["DISPLAY_VALUE"], PHPExcel_Cell_DataType::TYPE_STRING);
            }
        }

    }
}
// </editor-fold>

// <editor-fold defaultstate="s7spb-collapsed" desc=" # Output">
header("Content-Disposition: filename=" . $arResult["NAME"] . ".xlsx");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
// </editor-fold>
