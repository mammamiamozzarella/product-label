<?php

namespace Aurora\ProductLabels\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Aurora\ProductLabels\Api\LabelRepositoryInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Aurora\ProductLabels\Model\LabelFactory;

class Save extends Action
{
    public const ADMIN_RESOURCE = 'Aurora_ProductLabels::labels';

    /**
     * @param Action\Context $context
     * @param LabelRepositoryInterface $labelRepository
     * @param LabelFactory $labelFactory
     */
    public function __construct(
        Action\Context $context,
        private readonly LabelRepositoryInterface $labelRepository,
        private readonly LabelFactory $labelFactory,
    ) {
        parent::__construct($context);
    }

    /**
     * Execute method to save label
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute(): ResultInterface|ResponseInterface
    {
        $data = $this->getRequest()->getPostValue();
        $id = $data['label_id'] ?? null;
        try {
            if ($id) {
                $label = $this->labelRepository->getById($id);
            } else {
                $label = $this->labelFactory->create();
            }

            $label->setLabelText($data['label_text']);
            $label->setOptions($data['options'] ?? '');

            $this->labelRepository->save($label);

            $this->messageManager->addSuccessMessage(__('Label saved successfully.'));

            return $this->_redirect('*/*/');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());

            return $this->_redirect('*/*/');
        }
    }
}
