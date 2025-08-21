<?php
namespace Magento\CustomerGraphQl\Model\Resolver\CustomerAddressesV2;

/**
 * Interceptor class for @see \Magento\CustomerGraphQl\Model\Resolver\CustomerAddressesV2
 */
class Interceptor extends \Magento\CustomerGraphQl\Model\Resolver\CustomerAddressesV2 implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Customer\Api\AddressRepositoryInterface $addressRepository, \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder, \Magento\CustomerGraphQl\Model\Formatter\CustomerAddresses $addressesFormatter, \Magento\CustomerGraphQl\Model\ValidateAddressRequest $validateAddressRequest)
    {
        $this->___init();
        parent::__construct($addressRepository, $searchCriteriaBuilder, $addressesFormatter, $validateAddressRequest);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(\Magento\Framework\GraphQl\Config\Element\Field $field, $context, \Magento\Framework\GraphQl\Schema\Type\ResolveInfo $info, ?array $value = null, ?array $args = null) : array
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'resolve');
        return $pluginInfo ? $this->___callPlugins('resolve', func_get_args(), $pluginInfo) : parent::resolve($field, $context, $info, $value, $args);
    }
}
