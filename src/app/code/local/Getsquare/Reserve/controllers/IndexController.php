<?php

/**
 * @author     Graeme Houston (getsquare.co.uk)
 * @copyright  Copyright (c) 2014 GetSquare
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Getsquare_Reserve_IndexController extends Mage_Core_Controller_Front_Action
{

    public $params;
    public $firstName;
    public $productName;

    /**
     * Render Layout and append new block
     *
     * @return void
     */
    public function indexAction()
    {
        $this->loadLayout();

        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'getsquare.reserve',
            array(
                'template' => 'getsquare/reserve/reserve.phtml'
            )
        );

        $this->getLayout()->getBlock('content')->append($block);

        $this->_initLayoutMessages('core/session');

        $this->renderLayout();
    }

    /**
     * Sends email to specified address
     *
     * @return void
     */
    public function successAction()
    {

        $this->params = $this->getRequest()->getParams();

        $params = $this->params;

        $supportEmailName = Mage::getStoreConfig('trans_email/ident_support/name');
        $supportEmail     = Mage::getStoreConfig('trans_email/ident_support/email');

        $mail = new Zend_Mail();
        $mail->setBodyText($params['product_name'] . ' has been reserved in store for collection.');
        $mail->addTo($params['email'], $params['first-name']);
        $mail->setFrom($supportEmail, $supportEmailName);
        $mail->setSubject($params['product_name'] . 'Reserved In Store');

        try {
            $mail->send();
        } catch (Exception $ex) {
            Mage::getSingleton('core/session')->addError('Unable to send email.');

        }

        $this->firstName   = $params['first-name'];
        $this->productName = $params['product_name'];

        $productName = $this->productName;
        $firstName   = $this->firstName;


        if (!empty($params)) {

            $this->saveAction();

        }

        $this->successPageAction($firstName, $productName);

    }

    /**
     * Builds success page
     *
     * @param $firstName
     * @param $productName
     *
     * @return void
     */

    public function successPageAction($firstName, $productName)
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'getsquare.success',
            array(
                'template' => 'getsquare/reserve/success.phtml'
            )
        );

        $this->getLayout()->getBlock('content')->append($block);

        $block->setFirstName($firstName);
        $block->setProductName($productName);

        $this->_initLayoutMessages('core/session');

        $this->renderLayout();
    }

    /**
     * Saves params in DB
     *
     * @return void
     */
    public function saveAction()
    {

        $params = $this->params;
        $model  = Mage::getModel('reserve/reserve');
        $helper = Mage::helper('reserve');
        $sku    = $params['product_sku'];

        $now         = Mage::getModel('core/date')->timestamp(time());
        $productId   = $helper->getProductId($sku);
        $productName = $helper->getProductName($sku);
        $comment     = $helper->sanitizeComment($params['comment']);

        $reservationDetails = array(
            'name'         => $params['first-name'] . ' ' . $params['surname'],
            'phone'        => $params['phone'],
            'sku'          => $sku,
            'product_name' => $productName,
            'email'        => $params['email'],
            'comment'      => $comment,
            'created_at'   => $now
        );

        foreach ($reservationDetails as $key => $value) {

            $model->setData($key, $value);
        }

        $model->save();


        $stock = Mage::getModel('reserve/stock');
        $stock->reduceStockQty($productId);

    }

}