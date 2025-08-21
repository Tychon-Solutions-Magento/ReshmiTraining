<?php
namespace Magento\OrderCancellationGraphQl\Model\CancelOrderGuest;

/**
 * Interceptor class for @see \Magento\OrderCancellationGraphQl\Model\CancelOrderGuest
 */
class Interceptor extends \Magento\OrderCancellationGraphQl\Model\CancelOrderGuest implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\SalesGraphQl\Model\Formatter\Order $orderFormatter, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Magento\OrderCancellation\Model\Email\ConfirmationKeySender $confirmationKeySender, \Magento\OrderCancellation\Model\GetConfirmationKey $confirmationKey, \Magento\Framework\GraphQl\Query\Uid $idEncoder, \Magento\SalesGraphQl\Model\Order\Token $token)
    {
        $this->___init();
        parent::__construct($orderFormatter, $orderRepository, $confirmationKeySender, $confirmationKey, $idEncoder, $token);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(\Magento\Sales\Model\Order $order, array $input) : array
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute($order, $input);
    }
}
