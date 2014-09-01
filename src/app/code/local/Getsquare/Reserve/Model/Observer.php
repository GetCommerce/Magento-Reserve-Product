<?php

/**
 * @author     Graeme Houston (getsquare.co.uk)
 * @copyright  Copyright (c) 2014 GetSquare
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Getsquare_Reserve_Model_Observer extends Mage_Core_Model_Abstract
{

    public $model;

    public function _construct()
    {
        $this->model = Mage::getModel('reserve/reserve');
        parent::_construct();
    }

    /**
     * Checks for entries over 7 days
     *
     * @return void
     */
    public function checkOldOrders()
    {

        $collection = $this->model->getCollection();
        $entries    = $collection->getData();

        foreach ($entries as $entry) {

            $createdAt = $entry['created_at'];
            $id         = $entry['id'];
            $sku        = $entry['sku'];

            $created      = explode(' ', $createdAt);
            $createdDate = strtotime($created['0']);

            $sevenDays = strtotime('-7 day');

            $products = Mage::getModel('catalog/product');
            $product  = $products->loadByAttribute('sku', $sku);

            $productId = $product->getId();

            $stock = Mage::getModel('reserve/stock');

            if ($createdDate < $sevenDays) {

                $stock->updateStockQty($productId);
                $this->deleteEntry($id);

            }
        }

    }

    /**
     * Delete matching entries from DB
     *
     * @param $id
     *
     * @return void
     */

    public function deleteEntry($id)
    {
        $this->model->setId($id)->delete();
    }

}