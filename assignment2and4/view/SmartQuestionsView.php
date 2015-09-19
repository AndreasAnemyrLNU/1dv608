<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-09-18
 * Time: 21:42
 */

namespace view;
use model\SmartQuestionsModel;

class SmartQuestionsView
{
    private $smartQuestionsModel;

    public function __construct(SmartQuestionsModel $smartQuestionsModel)
    {
        $this->smartQuestionsModel = $smartQuestionsModel;
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST' ? true : false;
    }

}