<?php

namespace PME\Hideprice\Block\Product;

use PME\Hideprice\Helper\Data as Helper;
use Magento\Catalog\Model\Product;

class ListProduct extends \Magento\Catalog\Block\Product\ListProduct
{
    protected $_customerSession;
    protected $categoryFactory;

    /**
     * ListProduct constructor.
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\Data\Helper\PostHelper $postDataHelper
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     * @param \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param Helper $helper
     * @param array $data
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     */
    public function __construct(
    \Magento\Catalog\Block\Product\Context $context,
    \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
    \Magento\Catalog\Model\Layer\Resolver $layerResolver,
    \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
    \Magento\Framework\Url\Helper\Data $urlHelper,
    Helper $helper,
    array $data = [],
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Catalog\Model\CategoryFactory $categoryFactory
    ) {
        $this->_customerSession = $customerSession;
        $this->categoryFactory = $categoryFactory;
        $this->_helper = $helper;
        parent::__construct(
            $context,
            $postDataHelper,
            $layerResolver,
            $categoryRepository,
            $urlHelper,
            $data
        );

    }

//    public function getProductPrice(Product $product)
//    {
//        return "Abdus Salam";
//    }

    public function getIfNotLoggedIn()
    {
        return "<p>".$this->_helper->custompricetext()." <a href=".$this->_helper->getBaseURL().$this->_helper->linkoption().">"
                    .$this->_helper->cmsLabel()."</a></p><br><p>".$this->_helper->customcarttext()."</P>";
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

}