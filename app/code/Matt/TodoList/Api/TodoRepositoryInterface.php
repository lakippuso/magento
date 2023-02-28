<?php
 
namespace Matt\TodoList\Api;
 
use Matt\TodoList\Api\Data\TodoSearchResultsInterface;
use Matt\TodoList\Api\Data\TodoInterface;
 
interface TodoRepositoryInterface
{
    public function getById($id);
 
    public function save(TodoInterface $todoInterface);
 
    public function delete(TodoInterface $todoInterface);

    public function deleteById($id);
 
    public function getList(TodoSearchResultsInterface $searchCriteria);

}
