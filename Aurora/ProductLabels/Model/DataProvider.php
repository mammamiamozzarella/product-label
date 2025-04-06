<?php

namespace Aurora\ProductLabels\Model;


use Aurora\ProductLabels\Model\ResourceModel\Label\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected array $loadedData;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $labelCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $labelCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $labelCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        if (isset($this->loadedData)) {

            return $this->loadedData;
        }

        $this->loadedData = [];

        foreach ($this->collection as $item) {
            $this->loadedData[$item->getLabelId()] = $item->getData();
        }

        return $this->loadedData;
    }
}
