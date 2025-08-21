<?php
namespace Magento\Backend\Model\Menu\Director\Director;

/**
 * Interceptor class for @see \Magento\Backend\Model\Menu\Director\Director
 */
class Interceptor extends \Magento\Backend\Model\Menu\Director\Director implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Model\Menu\Builder\CommandFactory $factory)
    {
        $this->___init();
        parent::__construct($factory);
    }

    /**
     * {@inheritdoc}
     */
    public function direct(array $config, \Magento\Backend\Model\Menu\Builder $builder, \Psr\Log\LoggerInterface $logger)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'direct');
        return $pluginInfo ? $this->___callPlugins('direct', func_get_args(), $pluginInfo) : parent::direct($config, $builder, $logger);
    }
}
