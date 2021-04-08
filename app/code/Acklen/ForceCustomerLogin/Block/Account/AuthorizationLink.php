<?php

namespace Acklen\ForceCustomerLogin\Block\Account;

use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Url;
use Magento\Framework\Data\Helper\PostHelper;
use Acklen\ForceCustomerLogin\Helper\Data;

class AuthorizationLink extends \Magento\Customer\Block\Account\AuthorizationLink
{
    /**
     * @var $context
     */
    protected $context;
    /**
     * @var \Magento\Framework\App\Http\Context $httpContext
     */
    protected $httpContext;
    /**
     * @var Magento\Customer\Model\Url $customerUrl
     */
    protected $customerUrl;
    /**
     * @var Magento\Framework\Data\Helper\PostHelper $postDataHelper
     */
    protected $postDataHelper;
    /**
     * @var Data
     */
    protected $helper;

    /**
     * AuthorizationLink constructor.
     * @param Context $context
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param Url $customerUrl
     * @param PostHelper $postDataHelper
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\Http\Context $httpContext,
        Url $customerUrl,
        PostHelper $postDataHelper,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $httpContext, $customerUrl, $postDataHelper, $data);
        $this->helper = $helper;
    }

    /**
     * Enable module
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

}
