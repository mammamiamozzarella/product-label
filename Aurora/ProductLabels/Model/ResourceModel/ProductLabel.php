<?php

namespace Aurora\ProductLabels\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

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
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('Aurora\ProductLabels\Model\ProductLabel', 'label_id');
    }
}
