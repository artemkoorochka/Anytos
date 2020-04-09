<?
use Bitrix\Main\EventManager,
    Bitrix\Main\Loader,
    Studio7spb\Marketplace\SaleAddressTable,
    Studio7spb\Marketplace\RequisitsTable;

include "include/lansy/lansy.price.generator.php";

$eventManager = EventManager::getInstance();

// <editor-fold defaultstate="User events">
$eventManager->AddEventHandler("main", "OnAfterUserUpdate", array("lansyPriceGenerator", "OnAfterUserUpdateHandler"));
// </editor-fold>



// <editor-fold defaultstate="Ather tools">

if (!function_exists("d") )
{
    function d($value, $type="pre")
    {
        if ( is_array( $value ) || is_object( $value ) )
        {
            echo "<" . $type . " class=\"prettyprint\">".htmlspecialcharsbx( print_r($value, true) )."</" . $type . ">";
        }
        else
        {
            echo "<" . $type . " class=\"prettyprint\">".htmlspecialcharsbx($value)."</" . $type . ">";
        }
    }
}
// </editor-fold>