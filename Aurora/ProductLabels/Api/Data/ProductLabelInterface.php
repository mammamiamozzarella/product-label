<?php

namespace Aurora\ProductLabels\Api\Data;

interface ProductLabelInterface
{
    /**
     * Get the product ID
     *
     * @return mixed
     */
    public function getProductId(): mixed;

    /**
     * Set the product ID
     *
     * @param int $productId
     * @return void
     */
    public function setProductId(int $productId): void;

    /**
     * Get the label ID
     *
     * @return mixed
     */
    public function getLabelId(): mixed;

    /**
     * Set the label ID
     *
     * @param int $labelId
     * @return void
     */
    public function setLabelId(int $labelId): void;
}
