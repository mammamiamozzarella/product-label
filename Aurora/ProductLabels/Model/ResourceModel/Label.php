<?php

namespace Aurora\ProductLabels\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Label extends AbstractDb
{
    public const TABLE_NAME = 'aurora_labels';
    public const PRIMARY_KEY = 'label_id';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_KEY);
    }
}
