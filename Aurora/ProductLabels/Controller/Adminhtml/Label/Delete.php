<?php

namespace Aurora\ProductLabels\Controller\Adminhtml\Label;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Aurora\ProductLabels\Model\LabelFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;


class Delete extends Action
{
    const ADMIN_RESOURCE = 'Aurora_ProductLabels::label';

    /**
     * @var LabelFactory
     */
    protected LabelFactory $labelFactory;

    /**
     * @param Context $context
     * @param LabelFactory $labelFactory
     */
    public function __construct(
        Context $context,
        LabelFactory $labelFactory
    ) {
        $this->labelFactory = $labelFactory;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface|ResponseInterface|Redirect
     */
    public function execute(): ResultInterface|ResponseInterface|Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('label_id');

        if ($id) {
            try {
                $label = $this->labelFactory->create()->load($id);
                if (!$label->getId()) {
                    throw new LocalizedException(__('This label no longer exists.'));
                }

                $label->delete();
                $this->messageManager->addSuccessMessage(__('Label was successfully deleted.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while deleting the label.'));
            }
        } else {
            $this->messageManager->addErrorMessage(__('Label ID is missing.'));
        }

        return $resultRedirect->setPath('*/*/index');
    }
}
