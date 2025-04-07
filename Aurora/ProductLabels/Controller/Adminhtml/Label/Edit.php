<?php

namespace Aurora\ProductLabels\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Aurora\ProductLabels\Api\LabelRepositoryInterface;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Exception\LocalizedException;

class Edit extends Action
{
    public const ADMIN_RESOURCE = 'Aurora_ProductLabels::labels';

    /**
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param LabelRepositoryInterface $labelRepository
     */
    public function __construct(
        readonly Action\Context $context,
        private readonly PageFactory $resultPageFactory,
        private readonly LabelRepositoryInterface $labelRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Execute the action
     *
     * @return \Magento\Framework\View\Result\Page|ResponseInterface
     */
    public function execute(): \Magento\Framework\View\Result\Page|ResponseInterface
    {
        $id = $this->getRequest()->getParam('label_id');

        try {
            if ($id) {
                $this->labelRepository->getById($id);
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->_redirect('*/*/');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE);
        $resultPage->getConfig()->getTitle()->prepend($id ? __('Edit Label') : __('New Label'));

        return $resultPage;
    }
}
