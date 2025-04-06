<?php

namespace Aurora\ProductLabels\Ui\DataProvider\Label\Listing;


use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * @var string
     */
    protected function _initSelect()
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
