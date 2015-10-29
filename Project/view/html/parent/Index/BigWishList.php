<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-10-27
 * Time: 18:28
 */

namespace view;


class BigWishList extends Index
{
    public function getContent(\model\Dal $dal)
    {
        $persons = $dal->getDalPersonList()->getPersons();

        return
        "
        <div class=\"panel panel-default\">
            <table class=\"table table-hover\">
        " .
            $this->RenderTableRows($persons)
        . "
        </table>
        </div>
        ";
    }

    public function RenderTableRows($persons)
    {
        $tableRows = "<tr><th>Firstname</th><th>Lastname</th>";

        foreach ($persons as $person)
        {
            $tableRows .=   "
                            <tr>
                                <td>" . $person->getFirstname() . "</td>
                                <td>" . $person->getLastname()  . "</td>
                                <td><a class=\"btn btn-default pull-right\" href=\"?page=" . self::$PersonWishList ."&" . self::$uid . "={$person->getUid()}" . "\" role=\"button\">View</a></td>
                            </tr>
                            ";
        }
        return $tableRows;
    }

}