<?php

namespace Aurora\ProductLabels\Controller\Adminhtml\Label;


use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Aurora\ProductLabels\Api\LabelRepositoryInterface;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Exception\LocalizedException;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Aurora_ProductLabels::labels';

    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;

    /**
     * @var LabelRepositoryInterface
     */
    protected LabelRepositoryInterface $labelRepository;

    /**
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param LabelRepositoryInterface $labelRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        LabelRepositoryInterface $labelRepository,
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->labelRepository = $labelRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('label_id');
        $model = null;

        try {
            if ($id) {
                $model = $this->labelRepository->getById($id);
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->_redirect('*/*/');
        }

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Aurora_ProductLabels::labels');
        $resultPage->getConfig()->getTitle()->prepend($id ? __('Edit Label') : __('New Label'));

        return $resultPage;
    }
}
