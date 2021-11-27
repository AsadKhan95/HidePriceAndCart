<?php

namespace PME\Hideprice\Plugin\Block\Product;

use PME\Hideprice\Helper\Data as Helper;
use Magento\Catalog\Model\Product;

class ListProduct
{
    public function __construct(
//        ScopeConfigInterface $scopeConfig,
//        Context $context,
        Helper $helper
    ) {
//        $this->scopeConfig = $scopeConfig;
//        $this->context = $context;
        $this->_helper = $helper;
    }

    public function getProductPrice(Product $product)
    {
        return "Pam Kumar";
    }


}