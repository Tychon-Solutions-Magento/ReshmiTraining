<?php
namespace Magento\OrderCancellationGraphQl\Model\Resolver\RequestGuestOrderCancel;

/**
 * Interceptor class for @see \Magento\OrderCancellationGraphQl\Model\Resolver\RequestGuestOrderCancel
 */
class Interceptor extends \Magento\OrderCancellationGraphQl\Model\Resolver\RequestGuestOrderCancel implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\OrderCancellationGraphQl\Model\Validator\ValidateGuestRequest $validateRequest, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Magento\OrderCancellationGraphQl\Model\Validator\ValidateOrder $validateOrder, \Magento\OrderCancellationGraphQl\Model\CancelOrderGuest $cancelOrderGuest, \Magento\Framework\Api\SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\SalesGraphQl\Model\Order\Token $token)
    {
        $this->___init();
        parent::__construct($validateRequest, $orderRepository, $validateOrder, $cancelOrderGuest, $searchCriteriaBuilderFactory, $storeManager, $token);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(\Magento\Framework\GraphQl\Config\Element\Field $field, $context, \Magento\Framework\GraphQl\Schema\Type\ResolveInfo $info, ?array $value = null, ?array $args = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'resolve');
        return $pluginInfo ? $this->___callPlugins('resolve', func_get_args(), $pluginInfo) : parent::resolve($field, $context, $info, $value, $args);
    }
}
