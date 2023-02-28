<?php

namespace Matt\TodoList\Controller\Adminhtml\Home;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Matt\TodoList\Model\TodoFactory;
class Save extends Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var TodoFactory
     */
    protected $todoFactory;
    /**
     * @var TodoRepository
     */
    protected $todoRepository;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param TodoFactory $todoFactory
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        TodoFactory $todoFactory,
        \Matt\TodoList\Model\TodoRepository $todoRepository,
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->todoFactory = $todoFactory;
        $this->todoRepository = $todoRepository;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data = $this->getRequest()->getPostValue()) {
            $model = $this->todoFactory->create();
            try {
                if ($id = (int) $this->getRequest()->getParam('todo_id')) {
                    // die("1");~
                    $model = $this->todoRepository->getById($id);
                    if ($id != $model->getId()) {
                        $this->messageManager->addErrorMessage(__('This Todo no longer exists.'));
                        return $resultRedirect->setPath('*/*/');
                    }
                }
                $model->setData($data);
                $this->todoRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved your Todo.'));
                $this->dataPersistor->clear('matt_todolist_todo');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['todo_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving your Todo.'.$e));
            }

            $this->dataPersistor->set('matt_todolist_todo', $data);
            return $resultRedirect->setPath('*/*/edit', ['todo_id' => $this->getRequest()->getParam('todo_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}