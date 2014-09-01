<?php

/**
 * @author     Graeme Houston (getsquare.co.uk)
 * @copyright  Copyright (c) 2014 GetSquare
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Getsquare_Reserve_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * Load product by sku
     *
     * @param $sku
     *
     * @return bool|Mage_Catalog_Model_Abstract
     */
    public function loadProductBySku($sku)
    {
        $products = Mage::getModel('catalog/product');
        $product  = $products->loadByAttribute('sku', $sku);

        return $product;
    }

    /**
     * Get product id from sku
     *
     * @param $sku
     *
     * @return mixed
     */
    public function getProductId($sku)
    {
        $product   = $this->loadProductBySku($sku);
        $productId = $product->getId();

        return $productId;
    }

    /**
     * Get Product name from sku
     *
     * @param $sku
     *
     * @return mixed
     */
    public function getProductName($sku)
    {
        $product     = $this->loadProductBySku($sku);
        $productName = $product->getName();

        return $productName;
    }

    /**
     * Clean comments if default
     *
     * @param $comment
     *
     * @return string
     */
    public function sanitizeComment($comment)
    {

        if ($comment == 'Please let us know any additional comments.') {
            $commentText = '';
        } else {
            $commentText = $comment;
        }

        return $commentText;
    }

}