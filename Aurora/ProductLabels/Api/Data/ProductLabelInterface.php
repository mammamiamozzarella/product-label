<?php

namespace Aurora\ProductLabels\Api\Data;

interface ProductLabelInterface
{
    /**
     * @return mixed
     */
    public function getProductId(): mixed;

    /**
     * @param int $productId
     * @return void
     */
    public function setProductId(int $productId): void;

    /**
     * @return mixed
     */
    public function getLabelId(): mixed;

    /**
     * @param int $labelId
     * @return void
     */
    public function setLabelId(int $labelId): void;
}
