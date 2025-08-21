<?php
namespace Magento\Weee\Model\Tax;

/**
 * Interceptor class for @see \Magento\Weee\Model\Tax
 */
class Interceptor extends \Magento\Weee\Model\Tax implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\Context $context, \Magento\Framework\Registry $registry, \Magento\Eav\Model\Entity\AttributeFactory $attributeFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Tax\Model\CalculationFactory $calculationFactory, \Magento\Customer\Model\Session $customerSession, \Magento\Customer\Api\AccountManagementInterface $accountManagement, \Magento\Tax\Helper\Data $taxData, \Magento\Weee\Model\ResourceModel\Tax $resource, \Magento\Weee\Model\Config $weeeConfig, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, ?\Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $registry, $attributeFactory, $storeManager, $calculationFactory, $customerSession, $accountManagement, $taxData, $resource, $weeeConfig, $priceCurrency, $resourceCollection, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductWeeeAttributes($product, $shipping = null, $billing = null, $website = null, $calculateTax = null, $round = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductWeeeAttributes');
        return $pluginInfo ? $this->___callPlugins('getProductWeeeAttributes', func_get_args(), $pluginInfo) : parent::getProductWeeeAttributes($product, $shipping, $billing, $website, $calculateTax, $round);
    }
}
