<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-10-27
 * Time: 03:38
 */

namespace model;


class Person
{
    private $uid;
    private $firstname;
    private $lastname;
    private $itemList;

    public function __construct($firstname, $lastname, $itemList, $uid)
    {
        $this->uid = $uid;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->itemList = $itemList;
    }

    public function getItemList()
    {
        return $this->itemList;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getUid()
    {
        return $this->uid;
    }
}