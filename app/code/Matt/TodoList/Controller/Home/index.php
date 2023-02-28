<?php
namespace Matt\TodoList\Controller\Home;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\ActionInterface;

class Index implements ActionInterface{
        
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
    public function __construct(PageFactory $factoryPage)
    {
        $this->factoryPage = $factoryPage;
        
    }    
    /**
     * Create HTML Page
     *
     * @return void
     */
    public function execute()
    {
        $resultPage = $this->factoryPage->create();
        return $resultPage;
    }
}