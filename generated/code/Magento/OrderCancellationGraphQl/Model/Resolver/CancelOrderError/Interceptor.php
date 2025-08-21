<?php
namespace Magento\OrderCancellationGraphQl\Model\Resolver\CancelOrderError;

/**
 * Interceptor class for @see \Magento\OrderCancellationGraphQl\Model\Resolver\CancelOrderError
 */
class Interceptor extends \Magento\OrderCancellationGraphQl\Model\Resolver\CancelOrderError implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(array $errorMessageCodesMapper)
    {
        $this->___init();
        parent::__construct($errorMessageCodesMapper);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(\Magento\Framework\GraphQl\Config\Element\Field $field, $context, \Magento\Framework\GraphQl\Schema\Type\ResolveInfo $info, ?array $value = null, ?array $args = null) : ?array
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'resolve');
        return $pluginInfo ? $this->___callPlugins('resolve', func_get_args(), $pluginInfo) : parent::resolve($field, $context, $info, $value, $args);
    }
}
