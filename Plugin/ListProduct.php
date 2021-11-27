<?php

namespace PME\Hideprice\Plugin;

use PME\Hideprice\Helper\Data as Helper;

    class ListProduct
    {
        public function aroundGetProductDetailsHtml(
            \Magento\Catalog\Block\Product\ListProduct $subject,
            callable $proceed,
            \Magento\Catalog\Model\Product $product
        ) {
            $result = $proceed($product);
            $block = $subject->getChildBlock("SubscribeCategory")
                -> setData('product', $product);
            return $result.$block->toHtml();
            // return $result;
        }

    }