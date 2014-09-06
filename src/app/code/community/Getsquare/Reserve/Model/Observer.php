<?php

/**
 * @package     Getsquare_Reserve
 * @author      Getsquare magento@getsquare.co.uk
 * @copyright   2014 GetSquare
 */
class Getsquare_Reserve_Model_Observer
{
    const RESERVE_DAYS = 'reserve/config/days_keep';

    /**
     * Checks for entries over specified time limit (days)
     *
     * @return void
     */
    public function checkOldOrders()
    {

        $collection = Mage::getModel('reserve/reserve')->getCollection();
        $entries    = $collection->getData();
        $validDays  = intval(Mage::getStoreConfig(self::RESERVE_DAYS));

        foreach ($entries as $entry) {

            $createdAt   = $entry['created_at'];
            $id          = $entry['id'];
            $sku         = $entry['sku'];

            $created     = explode(' ', $createdAt);
            $createdDate = strtotime($created['0']);
            $days        = strtotime('-'.$validDays.'day');
            $productId   = Mage::helper('reserve')->getProductId($sku);

            if ($createdDate < $days) {

                $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($productId);
                $stock->addQty(1);
                $stock->save();

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
        Mage::getModel('reserve/reserve')->setId($id)->delete();
    }

}