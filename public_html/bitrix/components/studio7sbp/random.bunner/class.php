<?
use Bitrix\Iblock\ElementTable,
    Bitrix\Main\Loader;

class randomBunner extends CBitrixComponent
{
    private $_bunner;

    /**
     * @param mixed $bunner
     */
    public function setBunner($bunner)
    {
        $this->_bunner = $bunner;
    }

    /**
     * Load bunner from BD
     */
    public function loadBunner()
    {
        $this->_bunner = $bunner;
    }

    /**
     * @return mixed
     */
    public function getBunner()
    {
        return $this->_bunner;
    }

    public function executeComponent()
    {



        $this->includeComponentTemplate();
    }
}