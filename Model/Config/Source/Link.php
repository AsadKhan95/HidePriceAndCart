<?php

namespace PME\Hideprice\Model\Config\Source;

use Magento\Cms\Model\Config\Source\Page;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;

/**
 * Store Options for Cms Pages and Blocks
 */

class Link implements \Magento\Framework\Option\ArrayInterface
{
    public $dataa = array();
    public function __construct(
        CollectionFactory $pageCollectionFactory
    )
    {
        $this->_cms = $pageCollectionFactory;
    }
    /**
     * Get options
     *
     * @return array
     */
   
    public function checkArray()
    {
        $this->dataa = [['value' => ' ', 'label' => __(' ')],['value' => 'customer/account/login', 'label' => __('Login')], 
        ['value' => 'customer/account/create', 'label' => __('SignUp')], ['value' => 'contact', 'label' => __('Contact Us')]];

            return [['value' => ' ', 'label' => __(' ')],['value' => 'customer/account/login', 'label' => __('Login')], 
            ['value' => 'customer/account/create', 'label' => __('SignUp')], ['value' => 'contact', 'label' => __('Contact Us')]];
    }

    public function toOptionArray()
    {
        $cmsdata = array();
        $marge = array();
        $collection = $this->_cms->create()->addFieldToFilter('is_active', 1)
        ->addFieldToSelect('title')->addFieldToSelect('identifier');
        foreach ($collection as $key) {
            $cmsdata[] = ['value' => $key->getIdentifier(), 'label' => $key->getTitle()];
        }
        $this->dataa = [['value' => ' ', 'label' => 'Empty'],
                        ['value' => 'customer/account/login', 'label' => 'Login'], 
                        ['value' => 'customer/account/create', 'label' => 'SignUp'],
                        ['value' => 'contact', 'label' => 'Contact Us']];
         $marge =  array_merge($this->dataa,$cmsdata);
        return $marge;
    }
}