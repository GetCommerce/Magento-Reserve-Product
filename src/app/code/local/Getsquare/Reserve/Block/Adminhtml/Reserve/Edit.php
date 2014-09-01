<?php

class Getsquare_Reserve_Block_Adminhtml_Reserve_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'resevre';
        $this->_controller = 'adminhtml_reserve';
        
        $this->_updateButton('save', 'label', Mage::helper('reserve')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('reserve')->__('Delete'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('reserve_data') && Mage::registry('reserve_data')->getId() ) {
            return Mage::helper('reserve')->__("Edit entry '%s'", $this->htmlEscape(Mage::registry('reserve_data')->getTitle()));
        } else {
            return Mage::helper('reserve')->__('Add Entry');
        }
    }
}