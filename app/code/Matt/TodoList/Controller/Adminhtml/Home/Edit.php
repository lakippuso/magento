<?php
namespace Matt\TodoList\Controller\Adminhtml\Home;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Matt\TodoList\Model\TodoRepository;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var TodoRepository
     */
    protected $todoRepository;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param TodoFactory $todoFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        TodoRepository $todoRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->todoRepository = $todoRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Matt_TodoList::todolist');
        if ($todoId = (int) $this->getRequest()->getParam('id')) {
            try {
                $todo = $this->todoRepository->getById($todoId);
                $resultPage->getConfig()->getTitle()->prepend(__($todo->getTitle()));
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This Todo no longer exists.'));

                return $this->_redirect('*/*/index');
            }
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New Todo'));
        }

        return $resultPage;
    }
}
