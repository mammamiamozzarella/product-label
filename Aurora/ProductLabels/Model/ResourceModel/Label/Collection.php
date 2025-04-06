<?php

namespace Aurora\ProductLabels\Model\ResourceModel\Label;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Aurora\ProductLabels\Model\Label;
use Aurora\ProductLabels\Model\ResourceModel\Label as LabelResourceModel;

class Collection extends AbstractCollection
{
    /**
     * Collection constructor.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(Label::class, LabelResourceModel::class);
    }
}
