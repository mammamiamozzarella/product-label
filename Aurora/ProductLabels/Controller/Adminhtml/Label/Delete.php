<?php

namespace Aurora\ProductLabels\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Aurora\ProductLabels\Api\LabelRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class Delete extends Action
{
    public const ADMIN_RESOURCE = 'Aurora_ProductLabels::labels';

    /**
     * @param Context $context
     * @param LabelRepositoryInterface $labelRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        private readonly LabelRepositoryInterface $labelRepository,
        private readonly LoggerInterface $logger
    ) {
        parent::__construct($context);
    }

    /**
     * Execute the action
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $labelId = (int) $this->getRequest()->getParam('label_id');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');

        if (!$labelId) {
            $this->messageManager->addErrorMessage(__('We can\'t find a label to delete.'));
            return $resultRedirect;
        }

        try {
            $this->labelRepository->deleteById($labelId);
            $this->messageManager->addSuccessMessage(__('Label deleter.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while deleting the label.'));
            $this->logger->error($e->getMessage());
        }

        return $resultRedirect;
    }
}
