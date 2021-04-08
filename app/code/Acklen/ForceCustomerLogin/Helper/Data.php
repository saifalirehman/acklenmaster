<?php

namespace Acklen\ForceCustomerLogin\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Enable module
     * @return bool
     */
    public function isEnable()
    {
        return $this->scopeConfig->isSetFlag(
            'forcecustomerlogin/general/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable login for product page
     * @return bool
     */
    public function isEnableProductPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcecustomerlogin/page/product_page',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable login for category page
     * @return bool
     */
    public function isEnableCategoryPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcecustomerlogin/page/category_page',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable login for cart page
     * @return bool
     */
    public function isEnableCartPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcecustomerlogin/page/cart_page',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable customer register
     * @return bool
     */
    public function isEnableRegister()
    {
        return $this->scopeConfig->isSetFlag(
            'forcecustomerlogin/general/disable_register',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get alert message after redirect login page
     * @return string
     */
    public function getAlertMessage()
    {
        $alertMessage = $this->scopeConfig->getValue(
            'forcecustomerlogin/page/message',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $alertMessage;
    }

    /**
     * Get Redirect config default
     * @return bool
     */
    public function getRedirectDashBoard()
    {
        $redirectToDashBoard = $this->scopeConfig->isSetFlag(
            'customer/startup/redirect_dashboard',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $redirectToDashBoard;
    }
}
