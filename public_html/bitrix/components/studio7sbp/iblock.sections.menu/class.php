<?
use Bitrix\Main\Loader,
    Bitrix\Iblock\SectionTable;

class iblockSectionsMenu extends CBitrixComponent
{

    private $parents;
    private $sections;

    /**
     * @param mixed $parents
     */
    public function setParents($parents)
    {
        $this->parents = $parents;
    }

    /**
     * @param mixed $parents
     */
    public function setParent($parentID, $parent)
    {
        $parent["CHIELDS"] = [];
        $this->parents[$parentID] = $parent;
    }

    public function atachChieldsToParent($parentID, $section){

        if(!empty($this->parents[$parentID])){
            $this->parents[$parentID]["CHIELDS"][] = $section;
        }

    }

    /**
     * @return mixed
     */
    public function getParents()
    {
        return $this->parents;
    }

    /**
     * @return mixed
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param mixed $sections
     */
    public function setSections($sections)
    {
        $this->sections = $sections;
    }

    /**
     * @return mixed
     */
    public function getSectionsFromDB()
    {
        Loader::includeModule("iblock");
        $entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock($this->arParams["FILTER"]["IBLOCK_ID"]);
        $rsSection = $entity::getList(array(
            "filter" => $this->arParams["FILTER"],
            "select" => array(
                "ID",
                "NAME",
                "CODE",
                "DEPTH_LEVEL",
                "ACTIVE",
                "GLOBAL_ACTIVE",
                'IBLOCK_SECTION_PAGE_URL' => 'IBLOCK.SECTION_PAGE_URL',
                "UF_PARENT"
            )
        ));
        while($arSection=$rsSection->Fetch())
        {
            $arSection["SECTION_PAGE_URL"] = $arSection["IBLOCK_SECTION_PAGE_URL"];
            $this->sections[$arSection["ID"]] = $arSection;
        }

        $this->organizeParent();
    }

    public function organizeParent()
    {
        foreach ($this->getSections() as $id=>$section)
        {
            if(!empty($section["UF_PARENT"])){
                foreach ($section["UF_PARENT"] as $key=>$parent){

                    # убрать родителя самого себя
                    if($id == $parent){
                        unset($this->sections[$id]["UF_PARENT"][$key]);
                        continue;
                    }
                    #
                    $this->setParent($parent, $this->sections[$parent]);

                }
            }




        }

        foreach ($this->getSections() as $id=>$section)
        {
            if(!empty($section["UF_PARENT"])) {
                foreach ($section["UF_PARENT"] as $parent) {

                    $this->atachChieldsToParent($parent, $this->sections[$section["ID"]]);
                }
            }
        }

    }

    public function executeComponent()
    {
        $this->getSectionsFromDB();

        $this->arResult = $this->getParents();

        return $this->arResult;
    }
}