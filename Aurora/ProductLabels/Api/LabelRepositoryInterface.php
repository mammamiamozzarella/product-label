<?php

namespace Aurora\ProductLabels\Api;

use Aurora\ProductLabels\Api\Data\LabelInterface;

interface LabelRepositoryInterface
{
    /**
     * Get label by ID
     *
     * @param int $id
     * @return LabelInterface
     */
    public function getById(int $id): LabelInterface;

    /**
     * Save label
     *
     * @param LabelInterface $label
     * @return LabelInterface
     */
    public function save(LabelInterface $label): LabelInterface;

    /**
     * Delete label
     *
     * @param LabelInterface $label
     * @return bool
     */
    public function delete(LabelInterface $label): bool;

    /**
     * Get all labels
     *
     * @return array
     */
    public function getAllLabels(): array;

    /**
     * Delete label by ID
     *
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $id): bool;
}
