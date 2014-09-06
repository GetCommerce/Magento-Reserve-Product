<?php
/**
 * @package     Getsquare_Reserve
 * @author      Getsquare magento@getsquare.co.uk
 * @copyright   2014 GetSquare
 */
class Getsquare_Reserve_Block_Adminhtml_Reserve extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_reserve';
        $this->_blockGroup = 'reserve';
        $this->_headerText = Mage::helper('reserve')->__('Reserved Items');
        parent::__construct();
    }
}