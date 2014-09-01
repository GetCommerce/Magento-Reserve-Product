<?php

class Getsquare_Reserve_Block_Adminhtml_Reserve_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('reserve_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('reserve')->__('Banner Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('reserve')->__('Banner Information'),
          'title'     => Mage::helper('reserve')->__('Banner Information'),
          'content'   => $this->getLayout()->createBlock('reserve/adminhtml_reserve_edit_tab_form')->toHtml(),
      ));
	  
	  
     
      return parent::_beforeToHtml();
  }
}