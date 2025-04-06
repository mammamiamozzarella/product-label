<?php

namespace Aurora\ProductLabels\Block\Adminhtml\Label\Edit;


use Aurora\ProductLabels\Api\LabelRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    /**
     * @var Context
     */
    protected Context $context;

    /**
     * @var LabelRepositoryInterface
     */
    protected LabelRepositoryInterface $labelRepository;

    /**
     * @param Context $context
     * @param LabelRepositoryInterface $labelRepository
     */
    public function __construct(
        Context $context,
        LabelRepositoryInterface $labelRepository
    ) {
        $this->context = $context;
        $this->labelRepository = $labelRepository;
    }

    /**
     * @return mixed|null
     */
    public function getLabelId(): mixed
    {
        try {
            return $this->labelRepository->getById(
                $this->context->getRequest()->getParam('label_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
