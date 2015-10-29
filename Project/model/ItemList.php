<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-10-27
 * Time: 09:12
 */

namespace model;


class ItemList
{

    private $items;

    /**
     * ItemList constructor.
     * @param $items
     */
    public function __construct()
    {
        $this->createItemList();
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function add(Item $item)
    {
        $this->items[] = $item;
    }

    //CRUD
    // Create
    public function createItemList()
    {
        $items = Array();
    }

}