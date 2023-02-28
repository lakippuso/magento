<?php
 
namespace Matt\TodoList\Api\Data;
 
use Magento\Framework\Api\ExtensibleDataInterface;
 
interface TodoInterface extends ExtensibleDataInterface
{
    
    const TITLE = 'title';
    const ID_FIELD_NAME = 'todo_id';
    const DESCRIPTION = "description";
    const STATUS = "status";
    /**
     * @return int
     */
    public function getId();
    /**
     * @param int $id
     * @return void
     */
    public function setId($id);
 
    /**
     * @return string
     */
    public function getTitle();
 
    /**
    * @param string $title
    * @return void
    */
    public function setTitle($title);
 
    /**
     * @return int
     */
    public function getStatus();
 
    /**
    * @param int $status
    * @return void
    */
    public function setStatus($status);
}