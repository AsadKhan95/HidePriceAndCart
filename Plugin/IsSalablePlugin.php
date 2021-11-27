<?php

declare(strict_types=1);

namespace PME\Hideprice\Plugin;

use Magento\Framework\App\Http\Context;
use Magento\Customer\Model\Context as CustomerContext;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use PME\Hideprice\Helper\Data as Helper;

/**
 * Class IsSalablePlugin
 *
 * @category Plugin
 * @package  PME\Hideprice\Plugin
 */
class IsSalablePlugin
{
    /**
     * Scope config
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * HTTP Context
     * Customer session is not initialized yet
     *
     * @var Context
     */
    protected $context;

    protected $_initialValue = false;

    // const DISABLE_ADD_TO_CART = 'pme_hideprice/general/catalog_frontend_disable_add_to_cart_for_guest';

    /**
     * SalablePlugin constructor.
     *
     * @param ScopeConfigInterface $scopeConfig ScopeConfigInterface
     * @param Context              $context     Context
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Context $context,
        Helper $helper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->context = $context;
        $this->_helper = $helper;
    }

    /**
     *
     */
    public function afterIsSalable(
        \Magento\Catalog\Model\Product $subject,
        $result
    )
    {

        $this->initialValue = $result;
        $scope = ScopeInterface::SCOPE_STORE;

//        $categories_main = $this->_helper->getCurrentCategoryProduct();
//        $categoriess[] = $categories_main;
//        $categories = $categoriess;
//        $allowed = $this->_helper->categoryHide();
//        $resultt = array_intersect($categories,$allowed);

        $categories_main = $this->_helper->getCurrentCategoryProduct();
        $allowed = $this->_helper->categoryHide();
        if (is_array($categories_main))
        {
            $resultt=array_intersect($categories_main,$allowed);
        }else{
            $categoriess[] = $categories_main;
            $categories = $categoriess;
            $resultt=array_intersect($categories,$allowed);
        }

        //Now this one is for STOREVIEWS
        $storetype_main = $this->_helper->getStoreId();
        $storetypee[] = $storetype_main;
        $storetype = $storetypee;
        $allowedstoretype = $this->_helper->storeviewData();
        $res=array_intersect($storetype,$allowedstoretype);

//        if(!empty($res))
        if(1)
        {

            if (!empty($resultt)) {
                if($this->_helper->getIsEnable()) {
                    if ($this->_helper->isCustomerLoggedIn()) {
                        return true;
                    }
                    return false;
                }
            }
        }
        return $result;
    }

    public function afterGetIsSalable (
        \Magento\Catalog\Model\Product $subject,
        $result
    ) {
        $scope = ScopeInterface::SCOPE_STORE;

    //     //this part is used for PRODUCT CATEGORY hide
    //    $categories_main = $this->_helper->test();
    //    $categoriess[] = $categories_main;
    //    $categories = $categoriess;
    //    $allowed = $this->_helper->arrayData();
    //    $resultt=array_intersect($categories,$allowed);

        $categories_main = $this->_helper->getCurrentCategoryProduct();
        $allowed = $this->_helper->categoryHide();
        if (is_array($categories_main))
        {
            $resultt=array_intersect($categories_main,$allowed);
        }else{
            $categoriess[] = $categories_main;
            $categories = $categoriess;
            $resultt=array_intersect($categories,$allowed);
        }

        //Now this one is for STOREVIEWS
        $storetype_main = $this->_helper->getStoreId();
        $storetypee[] = $storetype_main;
        $storetype = $storetypee;
        $allowedstoretype = $this->_helper->storeviewData();
        $res=array_intersect($storetype,$allowedstoretype);

//        if(!empty($res))
        if(1)
        {
            if (!empty($resultt)) {
                if($this->_helper->getIsEnable()) {
                    if ($this->_helper->isCustomerLoggedIn()) {
                        return true;
                    }
                    return $this->initialValue;
                }
            }
        }
        return $result;
    }
}