<?php
namespace Matt\TodoList\Model\ResourceModel\Todo;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Matt\TodoList\Model\Todo as TodoModel;
use Matt\TodoList\Model\ResourceModel\Todo as TodoResourceModel;

class Collection extends AbstractCollection
{
    public $_idFieldName = 'todo_id';

    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            TodoModel::class,
            TodoResourceModel::class
        );
    }
}
