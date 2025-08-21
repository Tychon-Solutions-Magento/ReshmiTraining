<?php
namespace Tychons\ProductRecommend\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Tychons\ProductRecommend\Model\ViewTracker;
use Magento\Catalog\Helper\Data as CatalogData;

class TrackProductView implements ObserverInterface
{
    protected $tracker;
     protected $catalogData;

    public function __construct(ViewTracker $tracker,CatalogData $catalogData)
    {
        $this->tracker = $tracker;
         $this->catalogData = $catalogData;
        
    }

    public function execute(Observer $observer)
    {
        // $product = $observer->getEvent()->getProduct();
        // if ($product) {
        //     $this->tracker->track($product);
        // }
        $product = $this->catalogData->getProduct();

        if ($product && $product->getId()) {
            $this->tracker->track($product);
        }
    }
}
