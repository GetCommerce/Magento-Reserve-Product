<?php
/**
 * @package     Getsquare_Reserve
 * @author      Getsquare magento@getsquare.co.uk
 * @copyright   2014 GetSquare
 */
class Getsquare_Reserve_Block_Adminhtml_Reserve_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('reserveGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);

    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('reserve/reserve')->getCollection();

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn(
            'id',
            array(
                'header' => Mage::helper('reserve')->__('ID'),
                'align'  => 'right',
                'width'  => '50px',
                'index'  => 'id',
            )
        );

        $this->addColumn(
            'name',
            array(
                'header' => Mage::helper('reserve')->__('Customer Name'),
                'align'  => 'left',
                'index'  => 'name',
            )
        );

        $this->addColumn(
            'email',
            array(
                'header' => Mage::helper('reserve')->__('Email'),
                'align'  => 'left',
                'index'  => 'email',
            )
        );

        $this->addColumn(
            'sku',
            array(
                'header' => Mage::helper('reserve')->__('Reserved SKU'),
                'align'  => 'left',
                'index'  => 'sku',
            )
        );
        $this->addColumn(
            'product_name',
            array(
                'header' => Mage::helper('reserve')->__('Reserved Product'),
                'align'  => 'left',
                'index'  => 'product_name',
            )
        );
        $this->addColumn(
            'phone',
            array(
                'header' => Mage::helper('reserve')->__('Customer Phone'),
                'align'  => 'left',
                'index'  => 'phone',
            )
        );

        $this->addColumn(
            'created_at',
            array(
                'header' => Mage::helper('reserve')->__('Created'),
                'align'  => 'left',
                'index'  => 'created_at'
            )
        );

        return parent::_prepareColumns();
    }
}