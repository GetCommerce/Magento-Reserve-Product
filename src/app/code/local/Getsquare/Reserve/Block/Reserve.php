<?php
/**
 * @author    Graeme Houston (getsquare.co.uk)
 * @copyright  Copyright (c) 2014 GetSquare
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Getsquare_Reserve_Block_Reserve extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('getsquare/reserve/reserve.phtml');
    }
}