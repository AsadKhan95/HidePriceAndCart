<?php
namespace PME\Hideprice\Block;


use Magento\Framework\View\Element\Template\Context;
use Magento\Reports\Block\Product\Viewed;
use Magento\Catalog\Model\ProductFactory;

class Testttt extends \Magento\Framework\View\Element\Template
{
    /**
     * Limit of orders
     */
    const ORDER_LIMIT = 4;  //Image Limit this can be changed from here


    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        Viewed $recentlyViewed,
        ProductFactory $productFactory,
        array $data = []
    ) {
        $this->_recentlyViewed = $recentlyViewed;
        $this->_productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->getRecentlyviewed();
    }

    /**
     * Get recently placed orders. By default they will be limited by 5.
     */
    
    public function getRecentlyviewed()
    {
        
     $recentViewedCollection =  $this->_recentlyViewed->getItemsCollection()->setPageSize(
            self::ORDER_LIMIT
        )->load();
     ;
        $this->setRecentlyviewedcol($recentViewedCollection);
     return $this->getRecentlyviewedcol();    }


    /**
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->getRecentlyviewedcol()->getSize() > 0) {
            return parent::_toHtml();
        }
       return parent::_toHtml();
    }

    public function getProductLoader()
    {
        return $this->_productFactory;
    }

}