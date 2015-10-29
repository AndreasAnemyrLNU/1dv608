<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-10-27
 * Time: 18:28
 */

namespace view;


class PersonWishList extends Index
{
    public function getContent(\model\Dal $dal)
    {
        $itemList = $dal->getItemListByPersonUid($_GET[self::$uid]);
        $items = $itemList->getItems();
        return
        "
        <div class=\"panel panel-default\">
            <table class=\"table table-hover\">
        " .
            $this->RenderTableRows($items)
        . "
        </table>
        </div>
        ";
    }

    public function RenderTableRows($items)
    {
        $tableRows = "<tr><th>Name</th><th>Description</th>";

        foreach ($items as $item)
        {
            $tableRows .=   "
                            <tr>
                                <td>" . $item->getName() . "</td>
                                <td>" . $item->getDescription()  . "</td>
                            </tr>
                            ";
        }
        return $tableRows;
    }

}