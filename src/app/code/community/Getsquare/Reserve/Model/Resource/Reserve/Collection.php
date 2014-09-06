<?php
/**
 * @package     Getsquare_Reserve
 * @author      Getsquare magento@getsquare.co.uk
 * @copyright   2014 GetSquare
 */
class Getsquare_Reserve_Model_Resource_Reserve_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('reserve/reserve');
    }
}