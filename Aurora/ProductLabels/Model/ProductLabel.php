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
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\ProductLabel::class);
    }

    /**
     * @return int
     */
    public function getLabelId(): mixed
    {
        return $this->_getData('label_id');
    }

    /**
     * @param int $labelId
     * @return void
     */
    public function setLabelId(int $labelId): void
    {
        $this->setData('label_id', $labelId);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->_getData('name');
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->setData('name', $name);
    }

    /**
     * @return mixed
     */
    public function getProductId(): mixed
    {
        return $this->_getData('product_id');
    }

    /**
     * @param $productId
     * @return void
     */
    public function setProductId($productId): void
    {
        $this->setData('product_id', $productId);
    }
}
