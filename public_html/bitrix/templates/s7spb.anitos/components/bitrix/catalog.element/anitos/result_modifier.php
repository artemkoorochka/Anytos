<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


$arEmptyPreview = false;
$strEmptyPreview = SITE_TEMPLATE_PATH.'/images/no_image400.jpg';
if (file_exists($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview))
{
	$arSizes = getimagesize($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview);
	if (!empty($arSizes))
	{
		$arEmptyPreview = array(
			'SRC' => $strEmptyPreview,
			'WIDTH' => (int)$arSizes[0],
			'HEIGHT' => (int)$arSizes[1]
		);
	}
	unset($arSizes);
}
unset($strEmptyPreview);

$sample = 80659;


### TODO START Emulation
$arResult["MORE_PHOTO"] = [];

$i=0;

if(is_array($arResult["PREVIEW_PICTURE"])){
    ### SET DETAIL PICTURE ###
    if(!is_array($arResult["DETAIL_PICTURE"])){
        $arResult["DETAIL_PICTURE"] = $arResult["PREVIEW_PICTURE"];
    }
    ### FORMAT MORE PHOTO ###
    $arResult["MORE_PHOTO"][$i] = [
        "BIG" => $arResult["PREVIEW_PICTURE"]["SRC"],
        "SMALL" => \CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array("width" => 340, "height" => 340), BX_RESIZE_IMAGE_PROPORTIONAL, true, array()),
        "THUMB" => \CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array("width" => 66, "height" => 66), BX_RESIZE_IMAGE_EXACT, true, array())
    ];
}

if(is_array($arResult["DETAIL_PICTURE"])){
    $i++;
    for($i; $i < 5; $i++){

        $arResult["MORE_PHOTO"][$i] = [
            "BIG" => \CFile::GetPath($sample),
            "SMALL" => \CFile::ResizeImageGet($sample, array("width" => 340, "height" => 340), BX_RESIZE_IMAGE_PROPORTIONAL, true, array()),
            "THUMB" => \CFile::ResizeImageGet($sample, array("width" => 66, "height" => 66), BX_RESIZE_IMAGE_EXACT, true, array())
        ];

    }
}

### TODO END Emulation

if(empty($arResult["MORE_PHOTO"])) {
	$arResult['MORE_PHOTO'][] = $arEmptyPreview;
}

$arResult["DETAIL_PAGE_URL"] = "/catalog/section/" . $arResult["ID"] . "/";
$arResult["DETAIL_TEXT"] = unserialize($arResult["~DETAIL_TEXT"]);


// <editor-fold defaultstate="collapsed" desc="# Send out data from cache. Cach this out on epilog">

/**
 * Send out vendor property
 */
$cp = $this->__component;
if (is_object($cp))
{
    if(!empty($arResult["DISPLAY_PROPERTIES"]["H_COMPANY"]["VALUE"])){
        $cp->arResult["H_COMPANY"] = $arResult["DISPLAY_PROPERTIES"]["H_COMPANY"];
    }
    $cp->SetResultCacheKeys(["H_COMPANY"]); //cache keys in $arResult array
}


// </editor-fold>