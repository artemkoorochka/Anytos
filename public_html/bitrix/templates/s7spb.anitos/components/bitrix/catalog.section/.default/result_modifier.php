<?
/**
 * @var array $arParams
 * @var array $arResult
 */

$arParams["RESIZE"] = [
    "height" => 200,
    "width" => 200
];

if(!empty($arResult["ITEMS"])){
    foreach ($arResult["ITEMS"] as $key=>$arElement){

        // bitrix/templates/s7spb.anitos/images/no_image200.jpg

        if(is_array($arElement["PREVIEW_PICTURE"])){
            if($arElement["DETAIL_PICTURE"] > 0){
                $arElement["PREVIEW_PICTURE"] = $arElement["DETAIL_PICTURE"];
            }
        }
        else{
            if(is_array($arElement["DETAIL_PICTURE"])){
                $arElement["PREVIEW_PICTURE"] = $arElement["DETAIL_PICTURE"];
            }
        }


        if(is_array($arElement["PREVIEW_PICTURE"])){
            // Resize
            $arElement["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
                $arElement["PREVIEW_PICTURE"]["ID"],
                $arParams["RESIZE"],
                BX_RESIZE_IMAGE_EXACT,
                false
            );
            $arElement["PREVIEW_PICTURE"] = [
                "SRC" => $arElement["PREVIEW_PICTURE"]["src"],
                "HEIGHT" => $arParams["RESIZE"]["height"],
                "WIDTH" => $arParams["RESIZE"]["width"]
            ];
        }else{
            $arElement["PREVIEW_PICTURE"] = [
                "SRC" => SITE_TEMPLATE_PATH . "/images/no_image200.jpg",
                "TITLE" => $arElement["NAME"],
                "ALT" => "..."
            ];
        }

        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = $arElement["PREVIEW_PICTURE"];
    }
}
