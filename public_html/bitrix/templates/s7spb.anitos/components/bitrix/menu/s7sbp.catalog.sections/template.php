<?
/**
 * @var array $arParams
 * @var array $arResult
 */
if(empty($arResult))
    return;
?>


<div id="s7sbp-catalog-sections">

    <div class="text-15 text-danger text-bold text-uppercase pb3 px3">Канцтовары</div>

    <?foreach ($arResult as $arItem):?>
        <a href="/catalog/section/" class="d-block text-roboto py1 px3">Бумажно-беловые товары</a>
    <?endforeach;?>

</div>