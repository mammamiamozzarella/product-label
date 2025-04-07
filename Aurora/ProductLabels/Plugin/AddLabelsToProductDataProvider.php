<?php

namespace Aurora\ProductLabels\Plugin;

use Magento\Catalog\Ui\DataProvider\Product\Form\ProductDataProvider;
use Aurora\ProductLabels\Api\ProductLabelRepositoryInterface;
use Magento\Framework\App\RequestInterface;

class AddLabelsToProductDataProvider
{
    /**
     * @param ProductLabelRepositoryInterface $labelRepository
     * @param RequestInterface $request
     */
    public function __construct(
        private readonly ProductLabelRepositoryInterface $labelRepository,
        private readonly RequestInterface $request
    ) {
    }

    /**
     * Add labels to product data provider
     *
     * @param ProductDataProvider $subject
     * @param array $result
     * @return array
     */
    public function afterGetData(ProductDataProvider $subject, array $result): array
    {
        $productId = $this->request->getParam('id');

        if ($productId) {
            $labels = $this->labelRepository->getLabelsIdsByProductId($productId);
            $result[$productId]['product']['label_ids'] = $labels;
        }
        return $result;
    }
}
