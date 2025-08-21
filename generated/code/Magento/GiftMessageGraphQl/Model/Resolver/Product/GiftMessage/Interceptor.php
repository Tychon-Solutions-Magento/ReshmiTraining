<?php
namespace Magento\GiftMessageGraphQl\Model\Resolver\Product\GiftMessage;

/**
 * Interceptor class for @see \Magento\GiftMessageGraphQl\Model\Resolver\Product\GiftMessage
 */
class Interceptor extends \Magento\GiftMessageGraphQl\Model\Resolver\Product\GiftMessage implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\GiftMessageGraphQl\Model\Config\Messages $messagesConfig)
    {
        $this->___init();
        parent::__construct($messagesConfig);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(\Magento\Framework\GraphQl\Config\Element\Field $field, $context, \Magento\Framework\GraphQl\Schema\Type\ResolveInfo $info, ?array $value = null, ?array $args = null) : bool
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'resolve');
        return $pluginInfo ? $this->___callPlugins('resolve', func_get_args(), $pluginInfo) : parent::resolve($field, $context, $info, $value, $args);
    }
}
