<?php

namespace Aurora\ProductLabels\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Aurora\ProductLabels\Model\ProductLabel as ProductLabelModel;

class ProductLabel extends AbstractDb
{
    /**
     * @var string
     */
    protected $_idFieldName = 'label_id';

    /**
     * @var string
     */
    protected $_table = 'aurora_product_labels';

    /**
     * Construct
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ProductLabelModel::class, 'label_id');
    }
}
