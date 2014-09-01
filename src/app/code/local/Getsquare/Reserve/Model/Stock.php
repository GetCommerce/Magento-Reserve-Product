<?php
/**
* @author     Graeme Houston (getsquare.co.uk)
* @copyright  Copyright (c) 2014 GetSquare
* @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*/

class Getsquare_Reserve_Model_Stock
{
    /**
     * Updates Model
     * @param $productId
     * @param $productQty
     */
    protected function _updateModel($productId, $productQty)
    {
        $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($productId);
        $newStockQty = intval($stockItem->getQty() + $productQty);

        $stockItem->setData('qty', $newStockQty);
        $stockItem->save();
    }

    /**
     * Returns Product back to Stock
     * @param $productId
     */
    public function updateStockQty($productId)
    {
        $this->_updateModel($productId, 1);
    }

    /**
     * Reduces Product stock level
     * @param $productId
     */
    public function reduceStockQty($productId)
    {
        $this->_updateModel($productId, -1);
    }
}