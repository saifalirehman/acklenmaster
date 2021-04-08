<?php

namespace Acklen\ForceCustomerLogin\Block\Form\Login;

class Info extends \Magento\Customer\Block\Form\Login\Info
{
    /**
     * @var \Magento\Customer\Model\Url
     */
    protected $_customerUrl;
    /**
     * Checkout data
     * @var \Magento\Checkout\Helper\Data
     */
    protected $checkoutData;

    /**
     * Core url
     * @var \Magento\Framework\Url\Helper\Data
     */
    protected $coreUrl;

    /**
     * Registration
     * @var \Magento\Customer\Model\Registration
     */
    protected $registration;
    /**
     * Acklen Helper Data
     * @var \Acklen\ForceCustomerLogin\Helper\Data
     */
    protected $helper;

    /**
     * Info constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Registration $registration
     * @param \Magento\Customer\Model\Url $customerUrl
     * @param \Magento\Checkout\Helper\Data $checkoutData
     * @param \Magento\Framework\Url\Helper\Data $coreUrl
     * @param \Acklen\ForceCustomerLogin\Helper\Data $helper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Registration $registration,
        \Magento\Customer\Model\Url $customerUrl,
        \Magento\Checkout\Helper\Data $checkoutData,
        \Magento\Framework\Url\Helper\Data $coreUrl,
        \Acklen\ForceCustomerLogin\Helper\Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $registration, $customerUrl, $checkoutData, $coreUrl, $data);
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
     * Enable customer register
     * @return bool
     */
    public function getEnableRegister()
    {
        return $this->helper->isEnableRegister();
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $enable = $this->getEnable();
        $enableRegister = $this->getEnableRegister();
        if ($enable && $enableRegister || !$this->getTemplate()) {
            return '';
        } else {
            return $this->fetchView($this->getTemplateFile());
        }
    }
}
