<?php
namespace Matt\TodoList\Controller\Adminhtml\Home;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\App\Action;
use Magento\Framework\App\ActionInterface;

class Index extends Action implements ActionInterface{
        
    /**
     * context
     *
     * @var PageFactory $factoryPage
     */    
    private $factoryPage;
    
    /**
     * __construct
     *
     * @param  PageFactory $factoryPage
     * @return void
     */
    public function __construct(PageFactory $factoryPage, Context $context)
    {
        $this->factoryPage = $factoryPage;
        parent::__construct($context);
        
    }    
    /**
     * Create HTML Page
     *
     * @return void
     */
    public function execute()
    {
        $resultPage = $this->factoryPage->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Todo List'));
        return $resultPage;
    }
}