<?php

namespace Aurora\ProductLabels\Model\ResourceModel\ProductLabel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Aurora\ProductLabels\Model\ProductLabel;
use Aurora\ProductLabels\Model\ResourceModel\ProductLabel as ProductLabelResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'label_id';

    /**
     * @var string
     */
    protected $_itemObjectClass = ProductLabel::class;

    /**
     * @var string
     */
    protected $_resourceModel = ProductLabelResourceModel::class;

    /**
     * Construct
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ProductLabel::class, ProductLabelResourceModel::class);
    }
}
