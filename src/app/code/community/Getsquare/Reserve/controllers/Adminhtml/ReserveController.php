<?php
/**
 * @package     Getsquare_Reserve
 * @author      Getsquare magento@getsquare.co.uk
 * @copyright   2014 GetSquare
 */
class Getsquare_Reserve_Adminhtml_ReserveController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();

    }
}