<?php
/**
 * @package     Getsquare_Reserve
 * @author      Getsquare magento@getsquare.co.uk
 * @copyright   2014 GetSquare
 */
class Getsquare_Reserve_IndexController extends Mage_Core_Controller_Front_Action
{

    public $params;
    public $firstName;
    public $productName;

    function __construct($firstName, $params, $productName)
    {
        $this->params      = $this->getRequest()->getParams();
        $this->firstName   = $this->params['first-name'];
        $this->productName = $this->params['product_name'];
    }


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

        $supportEmailName = Mage::getStoreConfig('trans_email/ident_support/name');
        $supportEmail     = Mage::getStoreConfig('trans_email/ident_support/email');

        $mail = new Zend_Mail();
        $mail->setBodyText($this->params['product_name'] . ' has been reserved in store for collection.');
        $mail->addTo($this->params['email'], $this->params['first-name']);
        $mail->setFrom($supportEmail, $supportEmailName);
        $mail->setSubject($this->params['product_name'] . 'Reserved In Store');

        try {
            $mail->send();
        } catch (Exception $ex) {
            Mage::getSingleton('core/session')->addError('Unable to send email.');

        }

        if (!empty($params)) {

            $this->saveAction();

        }

        $this->successPageAction($this->firstName, $this->productName);

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

        $model  = Mage::getModel('reserve/reserve');
        $helper = Mage::helper('reserve');
        $sku    = $this->params['product_sku'];

        $now         = Mage::getModel('core/date')->timestamp(time());
        $productId   = $helper->getProductId($sku);
        $productName = $helper->getProductName($sku);
        $comment     = $helper->sanitizeComment($this->params['comment']);

        $reservationDetails = array(
            'name'         => $this->params['first-name'] . ' ' . $this->params['surname'],
            'phone'        => $this->params['phone'],
            'sku'          => $sku,
            'product_name' => $productName,
            'email'        => $this->params['email'],
            'comment'      => $comment,
            'created_at'   => $now
        );

        foreach ($reservationDetails as $key => $value) {

            $model->setData($key, $value);
        }

        $model->save();

        $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($productId);
        $stock->subtractQty(1);
        $stock->save();

    }

}