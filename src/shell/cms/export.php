<?php

require_once __DIR__ . '/../abstract.php';

class Mage_Shell_Cms_Export extends Mage_Shell_Abstract
{
    /**
     * Run script
     *
     */
    public function run()
    {
        if ($this->getArg('all')) {
            echo "start export" . PHP_EOL;
            $syncService = new Flyingmana_CmsDumper_Model_SyncService();
            $syncService->exportPages();
            $syncService->exportBlocks();
            echo "end export" . PHP_EOL;
        } else {
            echo $this->usageHelp();
        }
    }

    /**
     * Retrieve Usage Help Message
     *
     */
    public function usageHelp()
    {
        return <<<USAGE
Usage:  
        php shell/cms/export.php all

  all               export all CMS pages and blocks
  help              This help

USAGE;
    }
}

$shell = new Mage_Shell_Cms_Export();
$shell->run();
