<?php 

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();
$installer->run("

//Add your SQL here...

");

$installer->endSetup();