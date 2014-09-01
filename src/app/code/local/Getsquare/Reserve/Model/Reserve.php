<?php

/**
 * @author     Graeme Houston (getsquare.co.uk)
 * @copyright  Copyright (c) 2014 GetSquare
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Getsquare_Reserve_Model_Reserve extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('reserve/reserve');
    }
}