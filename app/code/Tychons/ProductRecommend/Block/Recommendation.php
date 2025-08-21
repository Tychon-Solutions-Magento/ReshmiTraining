<?php
namespace Tychons\ProductRecommend\Block;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\App\ResourceConnection;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Model\CategoryFactory;
use Psr\Log\LoggerInterface;

class Recommendation extends AbstractProduct
{
    protected $resource;
    protected $customerSession;
    protected $session;
    protected $productCollectionFactory;
    protected $categoryFactory;
    protected $logger;

    public function __construct(
        Context $context,
        ResourceConnection $resource,
        CustomerSession $customerSession,
        SessionManagerInterface $session,
        ProductCollectionFactory $productCollectionFactory,
        CategoryFactory $categoryFactory,
        LoggerInterface $logger,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->resource = $resource;
        $this->customerSession = $customerSession;
        $this->session = $session;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryFactory = $categoryFactory;
        $this->logger = $logger;

        $this->logger->info('Recommendation Block: __construct called');
    }

    public function getRecommendedProducts()
    {
        $connection = $this->resource->getConnection();
        $table = $this->resource->getTableName('personalization_customer_views');

        $customerId = $this->customerSession->getCustomerId();
        $sessionId  = $this->session->getSessionId();

        $this->logger->info('Recommendation Block: CustomerId = ' . ($customerId ?: 'NULL'));
        $this->logger->info('Recommendation Block: SessionId = ' . $sessionId);

        $select = $connection->select()
            ->from($table, ['category_ids','product_id'])
            ->order('viewed_at DESC')
            ->limit(1);

        if ($customerId) {
            $select->where('customer_id = ?', $customerId);
        } else {
            $select->where('session_id = ?', $sessionId);
        }

        $row = $connection->fetchRow($select);

        $this->logger->info('Recommendation Block: SQL Row', $row ?: []);

        if (!$row || empty($row['category_ids'])) {
            $this->logger->warning('Recommendation Block: No category_ids found');
            return [];
        }

        $categoryIds = explode(',', $row['category_ids']);
        $productId   = $row['product_id'];

       
        $categoryId  = (int) end($categoryIds); 
        $this->logger->info('Recommendation Block: Using single categoryId = ' . $categoryId);
 
        $category = $this->categoryFactory->create()->load($categoryId);

       
        $collection = $this->getProductCollection($category, $productId);

        $this->logger->info('Recommendation Block: Products found in categoryId = ' . $collection->getSize());
        $this->logger->info('SQL test= ' . $collection->getSelect());

        if ($collection->getSize() > 0) {
            return $collection;
        }

      
        $childIds = [];
        foreach ($category->getChildrenCategories() as $child) {
            $childIds[] = $child->getId();
        }

        $this->logger->info('Recommendation Block: childIds = ' . implode(',', $childIds));

        if (!empty($childIds)) {
            $childCollection = $this->productCollectionFactory->create();
            $childCollection->addAttributeToSelect(['name','status','visibility','price','small_image','type_id'])
                ->addCategoriesFilter(['in' => $childIds])
                ->addAttributeToFilter('entity_id', ['neq' => $productId])
                ->addAttributeToFilter('status', 1)
                ->addAttributeToFilter('visibility', ['in' => [
                    \Magento\Catalog\Model\Product\Visibility::VISIBILITY_IN_CATALOG,
                    \Magento\Catalog\Model\Product\Visibility::VISIBILITY_IN_SEARCH,
                    \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH
                ]])
                ->addAttributeToFilter('type_id', ['in' => [
                    \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE,
                    \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE,
                    \Magento\GroupedProduct\Model\Product\Type\Grouped::TYPE_CODE,
                    \Magento\Bundle\Model\Product\Type::TYPE_CODE,
                    \Magento\Downloadable\Model\Product\Type::TYPE_DOWNLOADABLE,
                    \Magento\Catalog\Model\Product\Type::TYPE_VIRTUAL
                ]])
                ->setPageSize(5);

            $childCollection->getSelect()->group('e.entity_id');

            $this->logger->info('Recommendation Block: Child category products found = ' . $childCollection->getSize());
            $this->logger->info('SQL test child= ' . $childCollection->getSelect());

            return $childCollection;
        }

        $this->logger->warning('Recommendation Block: No recommended products found');
        return [];
    }

    protected function getProductCollection($category, $excludeProductId)
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect(['name','status','visibility','price','small_image','type_id'])
            ->addCategoryFilter($category)  
            ->addAttributeToFilter('entity_id', ['neq' => $excludeProductId])
            ->addAttributeToFilter('status', 1)
            ->addAttributeToFilter('visibility', ['in' => [
                \Magento\Catalog\Model\Product\Visibility::VISIBILITY_IN_CATALOG,
                \Magento\Catalog\Model\Product\Visibility::VISIBILITY_IN_SEARCH,
                \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH
            ]])
            ->addAttributeToFilter('type_id', ['in' => [
                \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE,
                \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE,
                \Magento\GroupedProduct\Model\Product\Type\Grouped::TYPE_CODE,
                \Magento\Bundle\Model\Product\Type::TYPE_CODE,
                \Magento\Downloadable\Model\Product\Type::TYPE_DOWNLOADABLE,
                \Magento\Catalog\Model\Product\Type::TYPE_VIRTUAL
            ]])
            ->setPageSize(5);

        $collection->getSelect()->group('e.entity_id');

        return $collection;
    }
}
