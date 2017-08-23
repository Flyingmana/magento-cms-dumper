<?php

class Flyingmana_CmsDumper_Model_SyncService
{
    const TYPE_CMS_PAGE = 'cms_page';
    const TYPE_CMS_BLOCK = 'cms_block';

    public function getStorageBasePath()
    {
        return Mage::getBaseDir('var') . '/export/cms/';
    }

    private function getTypeByObject($object) {
        if ($object instanceof Mage_Cms_Model_Page) {
            return self::TYPE_CMS_PAGE;
        }
        if ($object instanceof Mage_Cms_Model_Block) {
            return self::TYPE_CMS_BLOCK;
        }
        throw new InvalidArgumentException('object of type "' . get_class($object) . '" could not be recognized');
    }

    private function getStoragePathForObject($object)
    {
        return $this->getStorageBasePath() . $this->getTypeByObject($object) . '/';
    }

    private function getStorageFilePathForObject($object)
    {
        return $this->getStoragePathForObject($object) . $object->getId() . '.json';
    }

    public function writeObject($object)
    {
        $path = $this->getStorageFilePathForObject($object);
        $directory = dirname($path);
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        file_put_contents($path, json_encode($object->getData(), JSON_PRETTY_PRINT));
    }

    public function exportPages()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $cmsPageCollection */
        $cmsPageCollection = Mage::getModel('cms/page')->getCollection();
        $cmsPageCollection->removeAllFieldsFromSelect();
        foreach ($cmsPageCollection as $page) {
            /** @var $page Mage_Cms_Model_Page */
            $fullPage = Mage::getModel('cms/page')->load($page->getId());

            $this->writeObject($fullPage);
        }
    }

    public function exportBlocks()
    {
        /** @var Mage_Cms_Model_Resource_Block_Collection $cmsPageCollection */
        $cmsPageCollection = Mage::getModel('cms/block')->getCollection();
        $cmsPageCollection->removeAllFieldsFromSelect();
        foreach ($cmsPageCollection as $page) {
            /** @var $page Mage_Cms_Model_Block */
            $fullPage = Mage::getModel('cms/block')->load($page->getId());

            $this->writeObject($fullPage);
        }
    }

    private function arrayDiff($array1,$array2) {
        $fullDiff = array_merge(array_diff($array1, $array2), array_diff($array2, $array1));
        var_dump(
            [count($array1), count($array2), "diff_size" => count($fullDiff)],
            $fullDiff
        );
    }

    public function importPages($dryRun = false)
    {
        $directory = $this->getStorageBasePath() . self::TYPE_CMS_PAGE;
        foreach (glob($directory.'/*.json') as $file) {
            $data = json_decode(file_get_contents($file), true);
//            var_dump($file);
            $page = Mage::getModel('cms/page')->load($data['page_id']);
            $page->setData($data);
            if ($dryRun === false) {
                $page->save();
            } else {
                echo $file . PHP_EOL;
                $this->arrayDiff($data, $page->getData());
            }
//            return;
        }
    }

    public function importBlocks($dryRun = false)
    {
        $directory = $this->getStorageBasePath() . self::TYPE_CMS_BLOCK;
        foreach (glob($directory.'/*.json') as $file) {
            $data = json_decode(file_get_contents($file), true);
//            var_dump($file);
            $page = Mage::getModel('cms/block')->load($data['block_id']);
            $page->setData($data);
            if ($dryRun === false) {
                $page->save();
            } else {
                echo $file . PHP_EOL;
                $this->arrayDiff($data, $page->getData());
            }
//            return;
        }
    }

}
