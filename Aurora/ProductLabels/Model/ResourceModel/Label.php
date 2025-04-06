<?php

namespace Aurora\ProductLabels\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Label extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('aurora_labels', 'label_id');
    }
}
