<?php
namespace Tychons\ProductInquiry\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Catalog\Model\ProductRepository;

class Send extends Action
{
    protected $resultJsonFactory;
    protected $customerSession;
    protected $transportBuilder;
    protected $inlineTranslation;
    protected $storeManager;
    protected $scopeConfig;
    protected $productRepository;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        CustomerSession $customerSession,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        ProductRepository $productRepository
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customerSession = $customerSession;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        
        if (!$this->customerSession->isLoggedIn()) {
            return $result->setData([
                'success' => false,
                'message' => 'Please log in to continue.'
            ]);
        }

        try {
            $productId = $this->getRequest()->getParam('product_id');
            $customer = $this->customerSession->getCustomer();
            $customerEmail = $customer->getEmail();
            $customerName = $customer->getName();
            
            // Get product information
            $product = $this->productRepository->getById($productId);
            $productName = $product->getName();
            $productUrl = $product->getProductUrl();

            $this->inlineTranslation->suspend();

            $templateVars = [
                'customer_name' => $customerName,
                'product_name' => $productName,
                'product_url' => $productUrl,
                'store' => $this->storeManager->getStore()
            ];

            $transport = $this->transportBuilder
                ->setTemplateIdentifier('product_inquiry_email_template')
                ->setTemplateOptions([
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => $this->storeManager->getStore()->getId(),
                ])
                ->setTemplateVars($templateVars)
                ->setFromByScope([
                    'name' => $this->scopeConfig->getValue(
                        'trans_email/ident_general/name',
                        \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                    ),
                    'email' => $this->scopeConfig->getValue(
                        'trans_email/ident_general/email',
                        \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                    )
                ])
                ->addTo($customerEmail, $customerName)
                ->getTransport();

            $transport->sendMessage();

            $this->inlineTranslation->resume();

            return $result->setData([
                'success' => true,
                'message' => 'Thank you! Email sent successfully.'
            ]);

        } catch (\Exception $e) {
            return $result->setData([
                'success' => false,
                'message' => 'Error sending email: ' . $e->getMessage()
            ]);
        }
    }
}