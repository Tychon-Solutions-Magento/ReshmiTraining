<?php
namespace Magento\Email\Model\Transport;

/**
 * Interceptor class for @see \Magento\Email\Model\Transport
 */
class Interceptor extends \Magento\Email\Model\Transport implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Mail\EmailMessageInterface $message, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, ?\Psr\Log\LoggerInterface $logger = null)
    {
        $this->___init();
        parent::__construct($message, $scopeConfig, $logger);
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessage() : void
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'sendMessage');
        $pluginInfo ? $this->___callPlugins('sendMessage', func_get_args(), $pluginInfo) : parent::sendMessage();
    }
}
