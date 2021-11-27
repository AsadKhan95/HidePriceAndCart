<?php

namespace PME\Hideprice\Block\Product\ProductList;

use PME\Hideprice\Helper\Data as Helper;
use Magento\Catalog\Model\Product;

class Related extends \Magento\Catalog\Block\Product\ProductList\Related
{

   /**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Checkout\Model\ResourceModel\Cart $checkoutCart
     * @param \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     */

    public function __construct(
    \Magento\Catalog\Block\Product\Context $context,
    \Magento\Checkout\Model\ResourceModel\Cart $checkoutCart,
    \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility,
    \Magento\Checkout\Model\Session $checkoutSession,
    \Magento\Framework\Module\Manager $moduleManager,
    Helper $helper,
    array $data = []
    ) {
        $this->_helper = $helper;
        parent::__construct(
            $context,
            $checkoutCart,
            $catalogProductVisibility,
            $checkoutSession,
            $moduleManager,
            $data
        );

    }

//    public function getProductPrice(Product $product)
//    {
//        return "Abdus Salam";
//    }

    public function getIfNotLoggedIn()
    {
        return "<p>".$this->_helper->custompricetext()." <a href=".$this->_helper->getBaseURL().$this->_helper->linkoption().">".$this->_helper->cmsLabel()."</a></p>";
    }

    public function getEnable()
    {
        return $this->_helper->getIsEnable();
    }

    public function getLoggedIn()
    {
       return $this->_helper->isCustomerLoggedIn();
    }

    public function getLinkOption()
    {
        return $this->_helper->linkoption();
    }

    public function getCustomPrice()
    {
       return $this->_helper->custompricetext();
    }

    public function getUrll()
    {
        return $this->_helper->getBaseURL();
    }

    public function getCartText()
    {
        return $this->_helper->customcarttext();
    }

    public function getCategoryHide()
    {
        // return "AsadUllah";
        return $this->_helper->categoryHide();
    }

    public function getStoreId()
    {
        return $this->_helper->getStoreId();
    }

    public function getStoreviewData()
    {
        return $this->_helper->storeviewData();
    }

    public function getCategoryProductData()
    {
        return $this->_helper->getCurrentCategoryProduct();
    }

    public function test()
    {
        return"Sheikh Shb";
    }

}