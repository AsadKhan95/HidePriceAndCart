<?php
namespace PME\Hideprice\Model\Config\Source\Customer;

use Magento\Framework\Option\ArrayInterface;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory;

class Group implements ArrayInterface
{

    protected $_options;
    protected $_collectionFactory;
    protected $_test;

    public function __construct(
        CollectionFactory $collectionFactory
        ) {
        $this->_collectionFactory = $collectionFactory;
}

    public function toOptionArray()
    {
        $this->_test = $this->_collectionFactory->create();
        if (null === $this->_options) {
            $groups = $this->_collectionFactory->create();
            $arr_groups = $groups->toOptionArray();
            array_shift($arr_groups);
            $this->_options = $arr_groups;
        }
        return $this->_options;
    }   
}
