<?php
namespace Magento\QuoteGraphQl\Model\Resolver\CatalogDiscount;

/**
 * Interceptor class for @see \Magento\QuoteGraphQl\Model\Resolver\CatalogDiscount
 */
class Interceptor extends \Magento\QuoteGraphQl\Model\Resolver\CatalogDiscount implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\CatalogGraphQl\Model\Resolver\Product\Price\Discount $discount)
    {
        $this->___init();
        parent::__construct($discount);
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
