<?php

namespace Aurora\ProductLabels\Api;

use Aurora\ProductLabels\Api\Data\ProductLabelInterface;

interface ProductLabelRepositoryInterface
{
    /**
     * Assign labels to a product
     *
     * @param int $productId
     * @param array $labelIds
     * @return void
     */
    public function assignLabelsToProduct(int $productId, array $labelIds): void;

    /**
     * Get labels from a product
     *
     * @param int $productId
     * @return ProductLabelInterface[]
     */
    public function getLabelsByProductId(int $productId): array;

    /**
     * Get label IDs by product ID
     *
     * @param int $productId
     * @return array
     */
    public function getLabelsIdsByProductId(int $productId): array;
}
