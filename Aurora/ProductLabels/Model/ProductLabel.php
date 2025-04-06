<?php

namespace Aurora\ProductLabels\Model;

use Aurora\ProductLabels\Api\Data\ProductLabelInterface;
use Magento\Framework\Model\AbstractModel;

class ProductLabel extends AbstractModel implements ProductLabelInterface
{
    /**
     * @var string
     */
    protected $_idFieldName = 'label_id';

    /**
     * @var string
     */
    protected $_primaryKey = 'label_id';

    /**
     * Construct
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\ProductLabel::class);
    }

    /**
     * Get label ID
     *
     * @return mixed
     */
    public function getLabelId(): mixed
    {
        return $this->_getData('label_id');
    }

    /**
     * Set label ID
     *
     * @param int $labelId
     * @return void
     */
    public function setLabelId(int $labelId): void
    {
        $this->setData('label_id', $labelId);
    }

    /**
     * Get product ID
     *
     * @return mixed
     */
    public function getProductId(): mixed
    {
        return $this->_getData('product_id');
    }

    /**
     * Set product ID
     *
     * @param int $productId
     * @return void
     */
    public function setProductId(int $productId): void
    {
        $this->setData('product_id', $productId);
    }
}
