<?
/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 */

use Bitrix\Main\Localization\Loc;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
Loc::loadLanguageFile(__FILE__);
?>

<div id="cart-informer-count">0</div>
<i class="icon icon-cart"></i>
<div class="text-13"><?=Loc::getMessage("TSB1_CART")?></div>