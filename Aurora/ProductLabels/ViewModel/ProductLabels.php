<?php

namespace Aurora\ProductLabels\ViewModel;

use Aurora\ProductLabels\Api\Data\ProductLabelInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Aurora\ProductLabels\Api\ProductLabelRepositoryInterface;

class ProductLabels implements ArgumentInterface
{
    /**
     * @param ProductLabelRepositoryInterface $labelRepository
     */
    public function __construct(
        private readonly ProductLabelRepositoryInterface $labelRepository
    ) {
    }

    /**
     * Get labels for a specific product
     *
     * @param int $productId
     * @return ProductLabelInterface[]
     */
    public function getLabelsForProduct(int $productId): array
    {
        return $this->labelRepository->getLabelsByProductId($productId);
    }
}
