<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die();

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
Loc::loadLanguageFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
	<title><?$APPLICATION->ShowTitle()?></title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">

	<?
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/fonts/proxima.nova/lansi.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/base.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/flexslider.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/jquery.fancybox.min.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/style.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/media.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/hamburger.css");

		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/jquery-1.8.3.min.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/jquery.flexslider.min.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/jquery.actual.min.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/jquery.ext.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/jquery.fancybox.min.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/app.js");
		Asset::getInstance()->addString('<script>BX.message('.\CUtil::PhpToJSObject($MESS, false).')</script>', true);

		$APPLICATION->ShowCSS();
		$APPLICATION->ShowHeadStrings();

		CJSCore::Init(array('ajax'));

		$moduleOptions = \Studio7spb\Marketplace\CMarketplaceOptions::getInstance()->getOptionList();

        global $curPage;
        $curPage = $APPLICATION->GetCurPage(true);
        if($curPage =="/index.php"){
            $notNeedBurger = true;
        }else{
            $notNeedBurger = preg_match("~^".SITE_DIR."(catalog)/~", $curPage);
        }
	?>
	
</head>
<body>
	<?$APPLICATION->ShowPanel();?>
