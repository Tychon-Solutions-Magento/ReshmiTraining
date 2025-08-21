<?php
namespace Magento\CatalogInventoryGraphQl\Model\Resolver\MaxSaleQtyResolver;

/**
 * Interceptor class for @see \Magento\CatalogInventoryGraphQl\Model\Resolver\MaxSaleQtyResolver
 */
class Interceptor extends \Magento\CatalogInventoryGraphQl\Model\Resolver\MaxSaleQtyResolver implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\CatalogInventoryGraphQl\Model\StockItemService $stockItemService)
    {
        $this->___init();
        parent::__construct($stockItemService);
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
