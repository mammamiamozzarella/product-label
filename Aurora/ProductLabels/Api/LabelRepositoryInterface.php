<?php

namespace Aurora\ProductLabels\Api;


use Aurora\ProductLabels\Api\Data\LabelInterface;

interface LabelRepositoryInterface
{
    /**
     * @param int $id
     * @return LabelInterface
     */
    public function getById(int $id): LabelInterface;

    /**
     * @param LabelInterface $label
     * @return LabelInterface
     */
    public function save(LabelInterface $label): LabelInterface;

    /**
     * @param LabelInterface $label
     * @return bool
     */
    public function delete(LabelInterface $label): bool;

    /**
     * @return array
     */
    public function getAllLabels(): array;
}
