<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var array $skuTemplate */
/** @var array $templateData */
$this->setFrameMode(true);

$intRowsCount = count($arResult['ITEMS']);
$strRand = $this->randString();
$strContID = 'cat_top_cont_'.$strRand;
?><div id="<? echo $strContID; ?>" class="bx_catalog_tile_home_type_2 col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>">
    <div class="bx_catalog_tile_section">
        <?
        $i=0;
        $boolFirst = true;
        $arRowIDs = array();
        foreach ($arResult['ITEMS'] as $keyRow => $arOneRow)
        {
            $strRowID = 'cat-top-'.$keyRow.'_'.$strRand;
            $arRowIDs[] = $strRowID;
            ?>
            <div id="<? echo $strRowID; ?>" class="bx_catalog_tile_slide <? echo ($boolFirst ? 'active' : 'notactive'); ?>">
                <!-- Catalog section start -->
                <div class="border border-danger">
                    <?
                    d("Catalog section");
                    d($keyRow);
                    ?>
                </div>
                <!-- Catalog section end -->
                <div class="clearfix"></div>
            </div>
            <?
            $boolFirst = false;
        }
        ?>
    </div>
    <?
    if (1 < $intRowsCount)
    {
        $arJSParams = array(
            'cont' => $strContID,
            'left' => array(
                'id' => $strContID.'_left_arr',
                'className' => 'bx_catalog_tile_slider_arrow_left'
            ),
            'right' => array(
                'id' => $strContID.'_right_arr',
                'className' => 'bx_catalog_tile_slider_arrow_right'
            ),
            'rows' => $arRowIDs,
            'rotate' => (0 < $arParams['ROTATE_TIMER']),
            'rotateTimer' => $arParams['ROTATE_TIMER']
        );
        if ('Y' == $arParams['SHOW_PAGINATION'])
        {
            $arJSParams['pagination'] = array(
                'id' => $strContID.'_pagination',
                'className' => 'bx_catalog_tile_slider_pagination'
            );
        }
        ?>
        <script type="text/javascript">
            var ob<? echo $strContID; ?> = new JCCatalogTopSliderList(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
        </script>
        <?
    }
    ?>
</div>