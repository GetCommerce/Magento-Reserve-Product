<?php
/**
 * @package     Getsquare_Reserve
 * @author      Getsquare magento@getsquare.co.uk
 * @copyright   2014 GetSquare
 */
class Getsquare_Reserve_Model_Reserve extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('reserve/reserve');
    }
}