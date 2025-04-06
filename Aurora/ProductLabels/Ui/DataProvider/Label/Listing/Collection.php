<?php

namespace Aurora\ProductLabels\Ui\DataProvider\Label\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

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
            ['aurora_labels' => $this->getMainTable()],
            'main_table.label_id = aurora_labels.label_id',
            ['label_text']
        );

        return $this;
    }
}
