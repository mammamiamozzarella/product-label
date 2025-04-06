<?php

namespace Aurora\ProductLabels\Plugin;


use Magento\Catalog\Ui\DataProvider\Product\Form\ProductDataProvider;
use Aurora\ProductLabels\Api\ProductLabelRepositoryInterface;
use Magento\Framework\App\RequestInterface;

class AddLabelsToProductDataProvider
{
    /**
     * @var ProductLabelRepositoryInterface
     */
    protected ProductLabelRepositoryInterface $labelRepository;

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @param ProductLabelRepositoryInterface $labelRepository
     * @param RequestInterface $request
     */
    public function __construct(
        ProductLabelRepositoryInterface $labelRepository,
        RequestInterface $request
    ) {
        $this->labelRepository = $labelRepository;
        $this->request = $request;
    }

    /**
     * @param ProductDataProvider $subject
     * @param $result
     * @return array
     */
    public function afterGetData(ProductDataProvider $subject, $result): array
    {
        $productId = $this->request->getParam('id');

        if ($productId) {
            $labels = $this->labelRepository->getLabelsByProductId($productId);
            $result[$productId]['product']['label_ids'] = $labels;
        }

        return $result;
    }
}
