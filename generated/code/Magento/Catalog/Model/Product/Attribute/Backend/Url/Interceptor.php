<?php
namespace Magento\Catalog\Model\Product\Attribute\Backend\Url;

/**
 * Interceptor class for @see \Magento\Catalog\Model\Product\Attribute\Backend\Url
 */
class Interceptor extends \Magento\Catalog\Model\Product\Attribute\Backend\Url implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $config)
    {
        $this->___init();
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'validate');
        return $pluginInfo ? $this->___callPlugins('validate', func_get_args(), $pluginInfo) : parent::validate($object);
    }
}
