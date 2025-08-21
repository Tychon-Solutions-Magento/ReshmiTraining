<?php
namespace Magento\Framework\Mail\Transport;

/**
 * Interceptor class for @see \Magento\Framework\Mail\Transport
 */
class Interceptor extends \Magento\Framework\Mail\Transport implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Mail\EmailMessageInterface $message, ?\Psr\Log\LoggerInterface $logger = null)
    {
        $this->___init();
        parent::__construct($message, $logger);
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
