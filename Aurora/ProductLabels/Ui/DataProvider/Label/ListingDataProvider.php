<?php

namespace Aurora\ProductLabels\Ui\DataProvider\Label;

use Aurora\ProductLabels\Model\ResourceModel\Label\Collection;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Aurora\ProductLabels\Model\ResourceModel\Label\CollectionFactory;

class ListingDataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
}
