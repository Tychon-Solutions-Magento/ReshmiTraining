<?php
namespace Tychons\ProductInquiry\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Registry;

class ProductInquiry extends Template
{
    protected $customerSession;
    protected $registry;

    public function __construct(
        Template\Context $context,
        CustomerSession $customerSession,
        Registry $registry,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function isCustomerLoggedIn()
    {
        return $this->customerSession->isLoggedIn();
    }

    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    public function getSendUrl()
    {
        return $this->getUrl('productinquiry/index/send');
    }
}