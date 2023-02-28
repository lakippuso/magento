<?php

namespace Matt\TodoList\Block\Frontend;

use Matt\TodoList\Model\ResourceModel\Todo\Collection;
use Magento\Framework\View\Element\Template;

class PageData extends Template
{
    protected $_todoFactory;

    public function __construct(
        Collection $todoFactory,
        Template\Context $context
    ){
        $this->_todoFactory = $todoFactory;
        parent::__construct($context, []);
    }
    public function getAllTodos()
    {
        $todos = $this->_todoFactory;
        return $todos;
    }
    public function getTitle(){
        return "Sample Title! Matthew Daniel Gabatino";
    }
}
?>