<?
use Bitrix\Main\Page\Asset,
    Bitrix\Main\Localization\Loc;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die();

CJSCore::Init(["jquery"]);

# add meta styleshit
# Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/base.css");

# add meta styleshit components
# Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/base.css");

# add meta styleshit fonts
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/geometry.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/animations.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/icons.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/slider.css");

# add meta scripts
#Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/jquery-1.8.3.min.js");
#Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/jquery.flexslider.min.js");
#Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/jquery.actual.min.js");
#Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/jquery.ext.js");
#Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/jquery.fancybox.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/quantity.counter.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/app.js");

# add meta strings
//Asset::getInstance()->addString('<script>BX.message('.\CUtil::PhpToJSObject($MESS, false).')</script>', true);
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">

    <?
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    echo "<title>";
    $APPLICATION->ShowTitle();
    echo "</title>";
    ?>
	
</head>
<body onclick="window.anitosNavigation.anitosClick(event)">
	<?$APPLICATION->ShowPanel();?>

    <!--- START MOBILE HEADER --->
    <div class="d-none d1200-block container">

        <div class="row row-center py5 px6">
            <div class="col col-auto">
                <div class="py5 px4 bg-danger border-radius-10"><i class="icon icon-menu"></i></div>
            </div>
            <a href="/" class="col col-auto">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.jpg"
                     width="244"
                     title="Anytos.ru"
                     alt="Anytos.ru" />
            </a>
            <div class="col col-auto">
                <div class="py5 px4 bg-danger-2 border-radius-10"><i class="icon icon-phone"></i></div>
            </div>
            <div class="col col-auto">
                <div class="hamburger hamburger--squeeze">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-roso-infras row py5 px6">
            <div class="col">
                <div class="text-36">8-800-555-05-84</div>
                <div class="text-danger text-24">Бесплатный звонок по России</div>
            </div>
            <div class="col">
                <div class="text-36">+7(495) 646-05-84</div>
                <div class="text-danger text-24">Бесплатная доставка до многих городов России</div>
            </div>
        </div>

        <div class="row py5 px6 text-center">
            <a href="#" class="col"><i class="icon-user-60"></i></a>
            <a href="#" class="col"><i class="icon-favorite-60"></i></a>
            <a href="#" class="col"><i class="icon-basket-60"></i></a>
        </div>

        <div class="px6 pb3">
            <?$APPLICATION->IncludeComponent("bitrix:search.form", "title.search", [])?>
        </div>

    </div>
    <!--- END MOBILE HEADER --->

    <header id="s7sbp-header" class="container d1200-none">
        <div class="row row12">


            <div class="col col-auto w235">
                <div class="text-arimo text-danger text-nowrap mb2">Оптовый онлайн-гипермаркет</div>
                <a class="d-block mb3"
                   href="#">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.png"
                         width="143"
                         height="59"
                         title="Anytos.ru"
                         alt="Anytos.ru" />
                </a>
            </div>
            <div class="col">

                <div class="row mb3">
                    <div class="col col-auto">
                        <div class="text-18">8-800-555-05-84</div>
                        <div class="text-12">Бесплатный звонок по России</div>
                    </div>
                    <div class="col col-auto">
                        <div class="text-18">+7(495) 646-05-84</div>
                    </div>

                    <div class="col col-auto">
                        <a href="#"
                           class="d-block bg-roso-ultras text-decoration-none p1">
                            <i class="icon icon-phone"></i>
                            Заказать обратный звонок
                        </a>
                    </div>
                    <div class="col col-auto pt1">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "s7sbp.main",
                            array(
                                "COMPONENT_TEMPLATE" => "s7sbp.main",
                                "ROOT_MENU_TYPE" => "main",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "360000000",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "main",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N"
                            ),
                            false
                        );?>
                    </div>
                </div>

                <div class="row row12 mb1">

                    <div class="col">
                        <?$APPLICATION->IncludeComponent("bitrix:search.form", "title.search", [])?>
                    </div>

                    <div class="col col-auto">

                        <div class="row row-center text-12 w164">
                            <div class="col col-auto"><i class="icon icon-car"></i></div>
                            <div class="col px1">
                                Бесплатная доставка до многих городов России
                            </div>
                        </div>
                    </div>
                    <div class="col col-auto text-center">
                        <i class="icon icon-lk"></i>
                        <div class="text-13">Личный<br />кабинет</div>
                    </div>
                    <div class="col col-auto text-center">
                        <i class="icon icon-favorite"></i>
                        <div class="text-13">Избранное</div>
                    </div>
                    <div class="col col-auto text-center position-relative">
                        <div id="cart-informer-count">0</div>
                        <i class="icon icon-cart"></i>
                        <div class="text-13">Корзина</div>
                    </div>

                </div>

            </div>

        </div>

    </header>

    <div class="d1200-none">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "s7sbp.nav",
            array(
                "COMPONENT_TEMPLATE" => "s7sbp.nav",
                "ROOT_MENU_TYPE" => "top",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "360000000",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_CACHE_GET_VARS" => array(
                ),
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "left",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N"
            ),
            false
        );?>
    </div>

    <main id="s7sbp-main">