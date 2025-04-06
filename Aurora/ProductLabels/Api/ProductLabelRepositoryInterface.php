<?php

namespace Aurora\ProductLabels\Api;

use Aurora\ProductLabels\Api\Data\ProductLabelInterface;

interface ProductLabelRepositoryInterface
{
    /**
     * @param int $productId
     * @param array $labelIds
     * @return void
     */
    public function assignLabelsToProduct(int $productId, array $labelIds): void;

    /**
     * @param int $productId
     * @return ProductLabelInterface[]
     */
    public function getLabelsByProductId(int $productId): array;
}
