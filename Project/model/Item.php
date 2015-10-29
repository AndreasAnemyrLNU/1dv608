<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-10-27
 * Time: 03:41
 */

namespace model;


class Item
{
    private $description;
    private $name;

    /**
     * Item constructor.
     * @param $description
     * @param $name
     */
    public function __construct($name, $description)
    {
        $this->description = $description;
        $this->name = $name;
    }

    /**
     * @return mixed
     */

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }



}