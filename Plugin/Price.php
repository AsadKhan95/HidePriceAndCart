<?php

namespace PME\Hideprice\Plugin;

use PME\Hideprice\Helper\Data as Helper;

class Price
{

    const DISABLE_PRICE = 'pme_hideprice/general/price';

    public function __construct (
        Helper $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        $this->product = $this->helper->getProduct();
        $this->category = $this->helper->getCurrentCategory();
        $this->flagCatalog = true;
        $this->test = 0;
        $this->flag = false;
    }

    function afterToHtml(\Magento\Catalog\Pricing\Render\FinalPriceBox $subject, $result) {

        //this part is used for PRODUCT CATEGORY hide
        $categories_main = $this->helper->getCurrentCategoryProduct();
        $allowed = $this->helper->categoryHide();
           if (is_array($categories_main))
           {
               $resultt=array_intersect($categories_main,$allowed);
           }else{
               $categoriess[] = $categories_main;
               $categories = $categoriess;
               $resultt=array_intersect($categories,$allowed);
           }

        //Now this one is for STOREVIEWS
        $storetype_main = $this->helper->getStoreId();
        $storetypee[] = $storetype_main;
        $storetype = $storetypee;
        $allowedstoretype = $this->helper->storeviewData();
        $res=array_intersect($storetype,$allowedstoretype);

            if (!empty($resultt) && $this->helper->getIsEnable() && !$this->helper->isCustomerLoggedIn()) {
                if($this->product)
                    {
                        $this->flag = true;
                        if($this->test < 1){
                            $this->test =$this->test + 1;
                                return "<p>".$this->helper->custompricetext()." <a href=".$this->helper->getBaseURL().$this->helper->linkoption().">"
                                            .$this->helper->cmsLabel()."</a></p><br><p>".$this->helper->customcarttext()."</P>";
                                }else{
                                return $result;
                                }
                    }else if($this->category){
                            
                        return "<p>".$this->helper->custompricetext()." <a href=".$this->helper->getBaseURL().$this->helper->linkoption().">"
                                    .$this->helper->cmsLabel()."</a></p><br><p>".$this->helper->customcarttext()."</P>";
                        }
                    
            }else{
                return $result;
            }
    }

    public function grouped(){
        return $this->flag;
    }

}