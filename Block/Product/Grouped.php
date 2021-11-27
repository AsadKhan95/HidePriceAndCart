<?php

namespace PME\Hideprice\Block\Product;

/**
 * @api
 * @since 100.0.2
 */
class Grouped extends \Magento\GroupedProduct\Block\Product\View\Type\Grouped
{

    public function checkGroup(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $price = $objectManager->get('PME\Hideprice\Plugin\Price');
        return $price->grouped();
    }

}
