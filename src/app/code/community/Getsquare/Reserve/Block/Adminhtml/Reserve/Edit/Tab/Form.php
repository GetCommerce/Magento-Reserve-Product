<?php
/**
 * @package     Getsquare_Reserve
 * @author      Getsquare magento@getsquare.co.uk
 * @copyright   2014 GetSquare
 */
class Getsquare_Reserve_Block_Adminhtml_Reserve_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'banner_info', array(
                'legend' => Mage::helper('reserve')->__('Reservation information')));

        $fieldset->addField('first-name', 'text', array(
                'label'     => Mage::helper('reserve')->__('First Name'),
                'class'     => 'required-entry',
                'required'  => true,
                'name'      => 'first-name',
            ));

        $fieldset->addField('surname', 'text', array(
                'label'     => Mage::helper('reserve')->__('Surname'),
                'class'     => 'required-entry',
                'required'  => true,
                'name'      => 'surname',
            ));

        $fieldset->addField('email', 'text', array(
                'label'     => Mage::helper('reserve')->__('Email Address'),
                'class'     => 'required-entry',
                'required'  => true,
                'name'      => 'email',
            ));

        $fieldset->addField('phone', 'text', array(
                'label'     => Mage::helper('reserve')->__('Customer Phone'),
                'class'     => 'required-entry',
                'required'  => true,
                'name'      => 'phone',
            ));


        $data = Mage::registry('reserve_data')->getData();

        $form->setValues($data);

        return parent::_prepareForm();
    }
}