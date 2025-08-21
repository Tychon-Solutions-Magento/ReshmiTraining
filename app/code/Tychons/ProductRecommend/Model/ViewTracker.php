<?php
// namespace Tychons\ProductRecommend\Model;

// use Magento\Framework\App\ResourceConnection;
// use Magento\Customer\Model\Session as CustomerSession;
// use Magento\Framework\Session\SessionManagerInterface;
// use Magento\Catalog\Model\Product;

// class ViewTracker
// {
//     protected $resource;
//     protected $customerSession;
//     protected $session;

//     public function __construct(
//         ResourceConnection $resource,
//         CustomerSession $customerSession,
//         SessionManagerInterface $session
//     ) {
//         $this->resource = $resource;
//         $this->customerSession = $customerSession;
//         $this->session = $session;
//     }

//     public function track(Product $product)
//     {
//         $connection = $this->resource->getConnection();
//         $table = $this->resource->getTableName('personalization_customer_views');

//         $customerId = $this->customerSession->getCustomerId();
//         $sessionId = $this->session->getSessionId();

//         $connection->insert($table, [
//             'customer_id' => $customerId,
//             'session_id' => $sessionId,
//             'product_id' => $product->getId(),
//             'category_ids' => implode(',', $product->getCategoryIds()),
//             'viewed_at' => date('Y-m-d H:i:s')
//         ]);
//     }
    
// }
namespace Tychons\ProductRecommend\Model;

use Magento\Framework\App\ResourceConnection;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;

class ViewTracker
{
    protected $resource;
    protected $customerSession;
    protected $session;
    protected $registry;

    public function __construct(
        ResourceConnection $resource,
        CustomerSession $customerSession,
        SessionManagerInterface $session,
        Registry $registry
    ) {
        $this->resource = $resource;
        $this->customerSession = $customerSession;
        $this->session = $session;
        $this->registry = $registry;
    }

    // public function track(Product $product)
    // {
    //     $connection = $this->resource->getConnection();
    //     $table = $this->resource->getTableName('personalization_customer_views');

    //     $customerId = $this->customerSession->getCustomerId();
    //     $sessionId = $this->session->getSessionId();

         
    //     $category = $this->registry->registry('current_category');
    //     $categoryId = $category ? $category->getId() : null;

    //     $connection->insert($table, [
    //         'customer_id'   => $customerId,
    //         'session_id'    => $sessionId,
    //         'product_id'    => $product->getId(),
    //         'category_ids'  => $categoryId,  
    //         'viewed_at'     => date('Y-m-d H:i:s')
    //     ]);
    // }
    public function track(Product $product)
{
    $connection = $this->resource->getConnection();
    $table = $this->resource->getTableName('personalization_customer_views');

    $customerId = $this->customerSession->getCustomerId();
    $sessionId  = $this->session->getSessionId();

    $category   = $this->registry->registry('current_category');
    $categoryId = $category ? $category->getId() : null;

 
    $select = $connection->select()
        ->from($table, ['id'])
        ->where('product_id = ?', $product->getId())
        ->where('session_id = ?', $sessionId);

    if ($customerId) {
        $select->where('customer_id = ?', $customerId);
    }

    $existing = $connection->fetchOne($select);

    if ($existing) {
        
        $connection->update(
            $table,
            [
                'category_ids' => $categoryId,
                'viewed_at'    => date('Y-m-d H:i:s')
            ],
            ['id = ?' => $existing]
        );
    } else {
         
        $connection->insert($table, [
            'customer_id'   => $customerId,
            'session_id'    => $sessionId,
            'product_id'    => $product->getId(),
            'category_ids'  => $categoryId,
            'viewed_at'     => date('Y-m-d H:i:s')
        ]);
    }
}

}
