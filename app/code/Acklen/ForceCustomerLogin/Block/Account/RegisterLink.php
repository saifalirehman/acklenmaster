<?php

namespace Acklen\ForceCustomerLogin\Block\Account;

use Magento\Customer\Model\Context;

class RegisterLink extends \Magento\Customer\Block\Account\RegisterLink
{
    /**
     * RegisterLink constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param \Magento\Customer\Model\Registration $registration
     * @param \Magento\Customer\Model\Url $customerUrl
     * @param \Acklen\ForceCustomerLogin\Helper\Data $helper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magento\Customer\Model\Registration $registration,
        \Magento\Customer\Model\Url $customerUrl,
        \Acklen\ForceCustomerLogin\Helper\Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $httpContext, $registration, $customerUrl, $data);
        $this->helper = $helper;
    }

    /**
     * Enable Module
     * @return bool
     */
    public function getEnable()
    {
        return $this->helper->isEnable();
    }

    /**
     * Enable Register
     * @return bool
     */
    public function getEnableRegister()
    {
        return $this->helper->isEnableRegister();
    }

    /**
     * Get string to html
     * @return string
     */
    protected function _toHtml()
    {
        $enable = $this->getEnable();
        $enableRegister = $this->getEnableRegister();
        if (!$this->_registration->isAllowed()
            || $this->httpContext->getValue(Context::CONTEXT_AUTH)
        ) {
            return '';
        }
        if ($enable && $enableRegister) {
            return '';
        }
        return parent::_toHtml();
    }
}
