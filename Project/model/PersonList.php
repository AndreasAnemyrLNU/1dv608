<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-10-27
 * Time: 03:41
 */

namespace model;


class PersonList
{
    private $persons;

    /**
     * PersonList constructor.
     */
    public function __construct()
    {
        $this->createPersonList();
    }


    /**
     * @return mixed
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * @param mixed $items
     */
    public function add(Person $person)
    {
        $this->persons[] = $person;
    }

    //CRUD
    // Create
    public function createPersonList()
    {
        $this->persons = Array();
    }
}