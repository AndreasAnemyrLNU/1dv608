<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-09-18
 * Time: 15:01
 */

namespace controller;
use \model\loginModel;
use \view\loginView;


class doAuth
{

    public function __construct(LoginView $loginView, LoginModel $loginModel)
    {
        if($loginView->didNotEnterName())
        {
            //This update state of loginModel. But is it a valid MVC alá D.Toll?
            $loginModel->setResponseMessage('Username is Missing');
        }
    }
}