<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-10-27
 * Time: 22:46
 */

namespace model;



class Dal
{
    private $personList;

    public function __construct()
    {
        //Test purpose...
        //$this->CreateTestData();
    }

    private function CreateTestData()
    {
            $this->personList = new PersonList();
            $this->personList->add(new Person('Andreas'   , 'Anemyr',       new ItemList(new Item("Cross", "A nice one"                )), 1  ));
            $this->personList->add(new Person('Matilda'   , 'Anemyr',       new ItemList(new Item("Ring", "A ring of gold..."          )), 2  ));
            $this->personList->add(new Person('Noa'       , 'Anemyr',       new ItemList(new Item("Floorball", "A unihoc..."           )), 3  ));
            $this->personList->add(new Person('Ellen'     , 'Anemyr',       new ItemList(new Item("Football", "Size 5..."              )), 4  ));
            $this->personList->add(new Person('Elia'      , 'Anemyr',       new ItemList(new Item("Newspaper", "Kalle or Batman..."    )), 5  ));
            $this->personList->add(new Person('Maja'      , 'Anemyr',       new ItemList(new Item("Tv", "A really big one..."          )), 6  ));
            $this->personList->add(new Person('Wilma'     , 'Anemyr',       new ItemList(new Item("X-Box", "hm. Think you know...."    )), 7  ));
    }

    public function getDalPersonList()
    {
        return  $this->personList;
    }

    public function getItemListByPersonUid($uid)
    {
        $persons = $this->personList->getPersons();

        foreach($persons as $person)
        {
            if($person->getUid() == $uid)
            {
                return $person->getItemList();
            }
        }
    }

    public function save()
    {
        try {
            $serializedPersonList = serialize($this->personList);
            file_put_contents("data.txt", $serializedPersonList);
        }catch (\Exception $e)
        {
            throw new \Exception("Saving to file failed!");
        }

    }

    public function load()
    {
        try
        {
            $this->personList = unserialize(file_get_contents("data.txt"));
        }catch (\Exception $e)
        {
            throw new \Exception("Saving to file failed!");
        }
    }
}