<?php
namespace Matt\TodoList\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;


interface TodoSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get Todo list.
     * @return \Matt\TodoList\Api\Data\TodoInterface[]
     */
    public function getItems();

    /**
     * Set Todo list.
     * @param \Matt\TodoList\Api\Data\TodoInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
