<?php
namespace Matt\TodoList\Model;

use Matt\TodoList\Api\Data\TodoInterface;
use \Magento\Framework\Model\AbstractModel;

class Todo extends AbstractModel implements TodoInterface{    
    const ID_FIELD_NAME = 'todo_id';
    const TITLE = 'title';
    const STATUS = 'status';
    /**
     * _construct
     *
     * @return void
     */
    public function _construct()
    {
         $this->_init(\Matt\TodoList\Model\ResourceModel\Todo::class);
    }
    /**
     * getId
     *
     * @return void
     */
    public function getId(){
        return $this->getData(self::ID_FIELD_NAME);
    }    
    /**
     * setId
     *
     * @param  mixed $content
     * @return void
     */
    public function setId($content)
    {
        return $this->setData(self::ID_FIELD_NAME, $content);
    }    
    /**
     * getTitle
     *
     * @return void
     */
    public function getTitle(){
        return $this->getData(self::TITLE);
    }    
    /**
     * setTitle
     *
     * @param  mixed $content
     * @return void
     */
    public function setTitle($content)
    {
        return $this->setData(self::TITLE, $content);
    }  
    /**
     * getStatus
     *
     * @return void
     */
    public function getStatus(){
        return $this->getData(self::STATUS);
    }    
    /**
     * setStatus
     *
     * @param  mixed $content
     * @return void
     */
    public function setStatus($content)
    {
        return $this->setData(self::STATUS, $content);
    }  
}