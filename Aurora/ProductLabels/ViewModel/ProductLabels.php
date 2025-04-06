<?php

namespace Aurora\ProductLabels\ViewModel;


use Aurora\ProductLabels\Api\Data\ProductLabelInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Aurora\ProductLabels\Api\ProductLabelRepositoryInterface;

class ProductLabels implements ArgumentInterface
{
    /**
     * @var ProductLabelRepositoryInterface
     */
    protected ProductLabelRepositoryInterface $labelRepository;

    /**
     * @param ProductLabelRepositoryInterface $labelRepository
     */
    public function __construct(
        ProductLabelRepositoryInterface $labelRepository
    ) {
        $this->labelRepository = $labelRepository;
    }

    /**
     * @param $productId
     * @return ProductLabelInterface[]
     */
    public function getLabelsForProduct($productId): array
    {
        return $this->labelRepository->getLabelsByProductId($productId);
    }
}
