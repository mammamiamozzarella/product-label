<?php

namespace Aurora\ProductLabels\Observer;

use Magento\Catalog\Model\Product;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Aurora\ProductLabels\Api\ProductLabelRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\ManagerInterface;

class SaveProductLabelsObserver implements ObserverInterface
{
    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @var ProductLabelRepositoryInterface
     */
    protected ProductLabelRepositoryInterface $labelRepository;

    /**
     * @var ManagerInterface
     */
    protected ManagerInterface $messageManager;

    /**
     * @param RequestInterface $request
     * @param ProductLabelRepositoryInterface $labelRepository
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        RequestInterface $request,
        ProductLabelRepositoryInterface $labelRepository,
        ManagerInterface $messageManager
    ) {
        $this->request = $request;
        $this->labelRepository = $labelRepository;
        $this->messageManager = $messageManager;
    }

    /**
     * Execute method to save product labels
     *
     * @param Observer $observer
     * @return static
     */
    public function execute(Observer $observer): static
    {
        /** @var Product $product */
        $product = $observer->getEvent()->getProduct();

        $labelIds = $this->request->getParam('product')['label_ids'] ?? null;
        if (is_array($labelIds)) {
            try {
                $this->labelRepository->assignLabelsToProduct((int)$product->getId(), $labelIds);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(__('Failed to save labels: %1', $e->getMessage()));
            }
        }

        return $this;
    }
}
