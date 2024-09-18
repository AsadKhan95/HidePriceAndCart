<?php
namespace PME\Hideprice\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Http\Context;
use Magento\Customer\Model\Context as CustomerContext;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;

class Data extends AbstractHelper
{

    /**
     * Customer Group
     *
     * @var \Magento\Customer\Model\ResourceModel\Group\Collection
    */
    protected $_customerGroup;
    protected $cmsCollection;

    protected $getarray;
    protected $gettarray;
    protected $getttarray;

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

     /**
     * SalablePlugin constructor.
     *
     * @param ScopeConfigInterface $scopeConfig ScopeConfigInterface
     * @param Context              $context     Context
     */

     /**
     * @var \Magento\Framework\Registry
     */
 
 protected $_registry;
 
 /**
 * ...
 * ...
 * @param \Magento\Framework\Registry $registry,
 */

    public function __construct(
        Context $context,
        CollectionFactory $cmsCollection,
        \Magento\Framework\App\Helper\Context $helpercontext,
        \Magento\Store\Model\StoreManagerInterface $storeManager, 
        \Magento\Theme\Block\Html\Header\Logo $logo,            //this is used for to get Homepage
        \Magento\Customer\Model\Session $_customerSession,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup
    ) {
        $this->_customerSession = $_customerSession;
        $this->context = $context;
        $this->_registry = $registry;
        $this->_cmsCollection = $cmsCollection;
        $this->_logo = $logo;
        $this->_storeManager = $storeManager;
        $this->cmsValue = 0;
        $this->_customerGroup = $customerGroup;
        parent::__construct($helpercontext);
    }

    public function isCustomerLoggedIn() {
        
        return $this->context->getValue(CustomerContext::CONTEXT_AUTH);
        //to check login mean that to check that the customer is logged in or not
    }

    public function getIsEnable(){
        return $this->scopeConfig->getValue('pme_hideprice/general/enabled', 
                                            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getPriceEnable(){
        return $this->scopeConfig->getValue('pme_hideprice/general/price', 
                                            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function isEnabled($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'pme_hideprice/general/enabled',
            $scope
        );
    }

    public function arrayData()
    {
        $getarray = $this->scopeConfig->getValue('pme_hideprice/general/category',
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return explode ( ',',$getarray);
    }

    public function custompricetext()
    {
        $getarray = $this->scopeConfig->getValue('pme_hideprice/general/customprice',
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $getarray;
    }

    public function customcarttext()
    {
        $getarray = $this->scopeConfig->getValue('pme_hideprice/general/customcart',
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $getarray;
    }

    public function storeviewData()
    {
        $gettarray = $this->scopeConfig->getValue('pme_hideprice/general/storeview',
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return explode ( ',',$gettarray);
    }

    public function linkoption()
    {
        $gettarray = $this->scopeConfig->getValue('pme_hideprice/general/link',
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $gettarray;
    }

    public function cms()
    {
        $gettarray = $this->scopeConfig->getValue('pme_hideprice/general/cms',
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $this->cmsValue = $gettarray;
        return $gettarray;
    }

    public function cmsLabel()
    {
        $res = array();
        $gettarray = $this->scopeConfig->getValue('pme_hideprice/general/link',
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $cmsCollect = $this->_cmsCollection->create();
            foreach($cmsCollect as $page)
            {
                if($page->getData('identifier') == $gettarray)
                    {
                        return $page->getData('title');
                    }else if($gettarray == 'customer/account/login')
                    {
                        return "Login";
                    }else if($gettarray == 'customer/account/create')
                    {
                        return "SignUp";
                    }else if($gettarray == 'contact')
                    {
                    return "Contact Us";
                    }else if($gettarray == ' ')
                    {
                   return " ";
                    }
            }
            return $res;
    }

    /**
     * Get store identifier
     *
     * @return  int
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    public function getBaseURL()
    {
       return $this->_storeManager->getStore()->getBaseUrl();
    }

        /**
     * Return catalog product object
     *
     * @return \Magento\Catalog\Model\Product
     */
    
    public function getProduct()
    {
        return $this->_registry->registry('current_product');
    }
    
    /**
     * Return catalog current category object
     *
     * @return \Magento\Catalog\Model\Category
     */

     public function getCurrentCategory()
     {
         return $this->_registry->registry('current_category');
     }
    
    public function getCurrentCategoryProduct()
    {
        $temp2 =  $this->_registry->registry('current_product');
        $temp =  $this->_registry->registry('current_category');
        if($temp2)
        {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $save = array();
            $ak = $this->_registry->registry('current_product')->getCategoryIds();
                foreach ($ak as $temp)
                {
                    $save[] = $objectManager->create('Magento\Catalog\Model\Category')->load($temp)->getId();
                }
            return $save;
        }else if($temp)
        {
            return $this->_registry->registry('current_category')->getId();
        }
    }

    public function getProductHot()
    {
        $temp =  $this->_registry->registry('current_product');
        if($temp) {
            $ak = $this->_registry->registry('current_product')->getCategoryIds();
            return $ak[0];
        }
    }
    
    /**
     * Check if current url is url for home page
     *
     * @return bool
     */
    public function isHomePage()
    {	
		return $this->_logo->isHomePage();
    }
    
    public function GroupsData()
    {
        $getttarray = $this->scopeConfig->getValue('pme_hideprice/general/hide_for_groups',
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return explode ( ',',$getttarray);
    }

    public function getGroup()
    {
        return $this->_customerSession->getCustomer()->getGroupId();
    }

    public function categoryHide()
    {
        $data = $this->arrayData();
        $save = array();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of Object Manager
        $categoryFactory = $objectManager->get('\Magento\Catalog\Model\CategoryFactory');// Instance of Category Model
        foreach($data as $test)
        {
            $category = $categoryFactory->create()->load($test);
            $this->addToSave($category, $save);
        }
        return array_merge($data,$save);   
    }

    public function addToSave($category, &$save)
    {
        $childrenCategories = $category->getChildrenCategories();
        foreach ($childrenCategories as $cat){
            $save[] = $cat->getId();
            $this->addToSave($cat, $save);
        }
    }

}
