<?php

namespace PME\Hideprice\Model\Config\Source;
/**
* @api
* @since 100.0.2
*/
class Stores implements \Magento\Framework\Option\ArrayInterface
{
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_storeManager = $storeManager;
    }

    /**
    * Options getter
    *
    * @return array
    */
   public function toOptionArray()
   {
       $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
       $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');

       $storeManagerDataList = $storeManager->getStores();
       $options = array();
       foreach ($storeManagerDataList as $key => $value)
       {
           $options[] = ['label' => $value['name'],  'value' => $key ];
       }
       return $options;
   }


}