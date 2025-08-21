<?php
namespace Magento\OrderCancellationGraphQl\Model\Resolver\ConfirmCancelOrder;

/**
 * Interceptor class for @see \Magento\OrderCancellationGraphQl\Model\Resolver\ConfirmCancelOrder
 */
class Interceptor extends \Magento\OrderCancellationGraphQl\Model\Resolver\ConfirmCancelOrder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\OrderCancellationGraphQl\Model\Validator\ValidateConfirmRequest $validateRequest, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Magento\OrderCancellationGraphQl\Model\ConfirmCancelOrder $confirmCancelOrder, \Magento\OrderCancellationGraphQl\Model\Validator\ValidateOrder $validateOrder, \Magento\Framework\GraphQl\Query\Uid $idEncoder)
    {
        $this->___init();
        parent::__construct($validateRequest, $orderRepository, $confirmCancelOrder, $validateOrder, $idEncoder);
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
