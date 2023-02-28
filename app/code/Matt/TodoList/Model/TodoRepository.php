<?php
namespace Matt\TodoList\Model;

use Matt\TodoList\Api\TodoRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Matt\TodoList\Api\Data\TodoSearchResultsInterfaceFactory;
use Matt\TodoList\Api\Data\TodoSearchResultsInterface;
use Matt\TodoList\Model\TodoFactory;
use Matt\TodoList\Model\ResourceModel\Todo as ResourceTodo;
use Matt\TodoList\Model\ResourceModel\Todo\CollectionFactory;

class TodoRepository implements TodoRepositoryInterface{

    
    /**
     * @var $resourceModel
     */
    protected $resourceModel;
    
    /**
     * @var $todoFactory
     */
    protected $todoFactory;
    
    /**
     * @var $todoCollectionFactory
     */
    protected $todoCollectionFactory;
    
    /**
     * @var $todoSearchResultInterface
     */
    protected $todoSearchResultInterface;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        ResourceTodo $resourceModel,
        TodoFactory $todoFactory,
        CollectionFactory $todoCollectionFactory,
        TodoSearchResultsInterfaceFactory $todoSearchResultInterface
    ){
        $this->resourceModel = $resourceModel;
        $this->todoFactory = $todoFactory;
        $this->todoCollectionFactory = $todoCollectionFactory;
        $this->todoSearchResultInterface = $todoSearchResultInterface;
    }    
    /**
     * getById
     *
     * @param  $id
     * @return $todo
     */
    public function getById($id)
    {
        $todo = $this->todoFactory->create();
        $todo->getResource()->load($todo, $id);
        if (! $todo->getId()) {
        throw new NoSuchEntityException(__('Unable to find Todo with ID "%1"', $id));
        }
        return $todo;
    }
        
    /**
     * save
     *
     * @param  \Matt\TodoList\Api\Data\TodoInterface
     * @return $todo
     */
    public function save(\Matt\TodoList\Api\Data\TodoInterface $todo)
    {
        try {
            $this->resourceModel->save($todo);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the favorite: %1',
                $exception->getMessage()
            ));
        }
        return $todo;
    }
        
    /**
     * delete
     *
     * @param  \Matt\TodoList\Api\Data\TodoInterface
     * @return $todo
     */
    public function delete(\Matt\TodoList\Api\Data\TodoInterface $todo)
    {
        try {
            $this->resourceModel->delete($todo);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Faq: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
    public function getList(TodoSearchResultsInterface $searchCriteria)
    {
       $collection = $this->todoCollectionFactory->create();
       $this->collectionProcessor->process($searchCriteria,$collection);
       $searchResults = $this->todoSearchResultInterface->create();
 
       $searchResults->setSearchCriteria($searchCriteria);
       $searchResults->setItems($collection->getItems());
 
       return $searchResults;
    } 
}