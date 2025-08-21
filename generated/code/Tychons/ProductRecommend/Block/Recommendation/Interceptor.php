<?php
namespace Tychons\ProductRecommend\Block\Recommendation;

/**
 * Interceptor class for @see \Tychons\ProductRecommend\Block\Recommendation
 */
class Interceptor extends \Tychons\ProductRecommend\Block\Recommendation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Block\Product\Context $context, \Magento\Framework\App\ResourceConnection $resource, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\Session\SessionManagerInterface $session, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Catalog\Model\CategoryFactory $categoryFactory, \Psr\Log\LoggerInterface $logger, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $resource, $customerSession, $session, $productCollectionFactory, $categoryFactory, $logger, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getImage($product, $imageId, $attributes = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getImage');
        return $pluginInfo ? $this->___callPlugins('getImage', func_get_args(), $pluginInfo) : parent::getImage($product, $imageId, $attributes);
    }
}
