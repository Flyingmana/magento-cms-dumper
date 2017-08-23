<?php

require_once __DIR__ . '/../abstract.php';

class Mage_Shell_Cms_Import extends Mage_Shell_Abstract
{
    /**
     * Run script
     *
     */
    public function run()
    {
        if ($this->getArg('all')) {
            echo "start import" . PHP_EOL;
            $syncService = new Flyingmana_CmsDumper_Model_SyncService();
            $syncService->importPages();
//            $syncService->importBlocks();
            echo "end import" . PHP_EOL;
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
        php shell/cms/import.php all

  all               import all CMS pages and blocks
  help              This help

USAGE;
    }
}

$shell = new Mage_Shell_Cms_Import();
$shell->run();
