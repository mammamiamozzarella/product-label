<?php

namespace Aurora\ProductLabels\Ui\DataProvider\Label\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Aurora\ProductLabels\Model\ResourceModel\Label;

class Collection extends SearchResult
{
    /**
     * Initialize select query with custom join to fetch label text.
     *
     * @return Collection
     */
    protected function _initSelect(): static
    {
        parent::_initSelect();
        $this->getSelect()->joinLeft(
            [Label::TABLE_NAME => $this->getMainTable()],
            sprintf('main_table.%s = %s.%s', Label::PRIMARY_KEY, Label::TABLE_NAME, Label::PRIMARY_KEY),
            ['label_text']
        );

        return $this;
    }
}
