<?php

namespace Aurora\ProductLabels\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class LabelActions extends Column
{
    public const EDIT_URL = 'aurora/label/edit';

    public const DELETE_URL = 'aurora/label/delete';

    /**
     * @param UrlInterface $urlBuilder
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        private readonly UrlInterface $urlBuilder,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare data source for the grid
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['label_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(self::EDIT_URL, ['label_id' => $item['label_id']]),
                            'label' => __('Edit'),
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(self::DELETE_URL, ['label_id' => $item['label_id']]),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete label'),
                                'message' => __('Are you sure you want to delete this label?'),
                            ],
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }
}
