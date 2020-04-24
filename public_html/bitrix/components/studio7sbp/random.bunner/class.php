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
        $bunner = ElementTable::getList([
            "filter" => [
                "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                "ACTIVE" => "Y"
            ],
            "select" => [
                "ID",
                "IBLOCK_ID",
                "DETAIL_PICTURE",
                "PREVIEW_PICTURE"
            ]
        ]);
        if($bunner = $bunner->fetch()){
            if($bunner["DETAIL_PICTURE"] <= 0){
                if($bunner["PREVIEW_PICTURE"] > 0){
                    $bunner["DETAIL_PICTURE"] = $bunner["PREVIEW_PICTURE"];
                }
            }
            if($bunner["DETAIL_PICTURE"] > 0){
                $bunner["DETAIL_PICTURE"] = CFile::GetFileArray($bunner["DETAIL_PICTURE"]);
            }
        }
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