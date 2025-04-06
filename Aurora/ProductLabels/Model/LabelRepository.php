<?php

namespace Aurora\ProductLabels\Model;

use Aurora\ProductLabels\Api\LabelRepositoryInterface;
use Aurora\ProductLabels\Api\Data\LabelInterface;
use Aurora\ProductLabels\Model\ResourceModel\Label as LabelResource;
use Aurora\ProductLabels\Model\ResourceModel\Label\CollectionFactory as LabelCollectionFactory;
use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

class LabelRepository implements LabelRepositoryInterface
{
    /**
     * @param LabelResource $resource
     * @param LabelFactory $labelFactory
     * @param LabelCollectionFactory $labelCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        protected LabelResource $resource,
        protected LabelFactory $labelFactory,
        protected LabelCollectionFactory $labelCollectionFactory,
        protected CollectionProcessorInterface $collectionProcessor,
        protected SearchResultsInterfaceFactory $searchResultsFactory
    ) {
    }

    /**
     * Get label by ID
     *
     * @param int $id
     * @return LabelInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): LabelInterface
    {
        $label = $this->labelFactory->create();
        $this->resource->load($label, $id);
        if (!$label->getId()) {
            throw new NoSuchEntityException(__('Label with id "%1" does not exist.', $id));
        }
        return $label;
    }

    /**
     * Save label
     *
     * @param LabelInterface $label
     * @return LabelInterface
     * @throws AlreadyExistsException
     */
    public function save(LabelInterface $label): LabelInterface
    {
        $this->resource->save($label);
        return $label;
    }

    /**
     * Delete label
     *
     * @param LabelInterface $label
     * @return bool
     * @throws Exception
     */
    public function delete(LabelInterface $label): bool
    {
        $this->resource->delete($label);
        return true;
    }

    /**
     * Get all labels
     *
     * @return array|LabelInterface[]
     */
    public function getAllLabels(): array
    {
        $collection = $this->labelCollectionFactory->create();
        $labels = [];

        foreach ($collection as $label) {
            $labels[] = $label;
        }

        return $labels;
    }
}
