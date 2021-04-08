<?php

namespace Acklen\ForceCustomerLogin\Plugin\Product;

use Acklen\ForceCustomerLogin\Helper\Data;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\Session as CatalogSession;

class View
{
    /**
     * @var Data
     */
    protected $helperData;
    /**
     * @var Session
     */
    protected $customerSession;
    /**
     * @var Context
     */
    protected $context;
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;
    /**
     * @var CatalogSession
     */
    protected $catalogSession;
    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * View constructor.
     * @param Context $context
     * @param Data $helperData
     * @param Session $customerSession
     * @param CatalogSession $catalogSession
     */
    public function __construct(
        Context $context,
        Data $helperData,
        Session $customerSession,
        CatalogSession $catalogSession
    ) {
        $this->helperData = $helperData;
        $this->customerSession = $customerSession;
        $this->url = $context->getUrl();
        $this->messageManager = $context->getMessageManager();
        $this->catalogSession = $catalogSession;
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
    }

    /**
     * Force Login for Product Page
     * @param \Magento\Catalog\Controller\Product\View $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function aroundExecute(\Magento\Catalog\Controller\Product\View $subject, \Closure $proceed)
    {
        $enableLogin = $this->helperData->isEnable();
        $enableProductPage = $this->helperData->isEnableProductPage();
        if ($enableLogin && $enableProductPage) {
            $customerLogin = $this->customerSession->isLoggedIn();
            if (!$customerLogin) {
                $resultRedirect = $this->resultRedirectFactory->create();
                $currentUrl = $this->url->getCurrentUrl();
                $this->catalogSession->setAcklenCurrentUrl($currentUrl);
                $message = $this->helperData->getAlertMessage();
                if ($message) {
                    $this->messageManager->addErrorMessage($message);
                }
                return $resultRedirect->setPath('customer/account/login');
            } else {
                return $proceed();
            }
        } else {
            return $proceed();
        }
    }
}
