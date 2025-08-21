<?php
namespace Tychons\Personalization\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Tychons\Personalization\Model\ViewTracker;

class TrackProductView implements ObserverInterface
{
    protected $tracker;

    public function __construct(ViewTracker $tracker)
    {
        $this->tracker = $tracker;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        if ($product) {
            $this->tracker->track($product);
        }
    }
}
