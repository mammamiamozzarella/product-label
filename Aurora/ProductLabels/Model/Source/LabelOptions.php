<?php

namespace Aurora\ProductLabels\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Aurora\ProductLabels\Api\LabelRepositoryInterface;

class LabelOptions extends AbstractSource
{

    /**
     * @param LabelRepositoryInterface $labelRepository
     */
    public function __construct(
        private readonly LabelRepositoryInterface $labelRepository
    ) {
    }

    /**
     * Get all label options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        $labels = $this->labelRepository->getAllLabels();
        $options = [];

        foreach ($labels as $label) {
            $options[] = [
                'value' => $label->getLabelId(),
                'label' => $label->getLabelText()
            ];
        }

        return $options;
    }
}
