<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-09-18
 * Time: 15:01
 */

namespace controller;
use \model\loginModel;
use model\SmartQuestionsModel;
use \view\loginView;
use view\SmartQuestionsView;


class doAuth
{
    private $loginView;
    private $loginModel;
    private $smartQuestionsView;
    private $smartQuestionsModel;
    public function __construct
                                (
                                    LoginView $loginView,
                                    LoginModel $loginModel,
                                    SmartQuestionsView $smartQuestionsView,
                                    SmartQuestionsModel $smartQuestionsModel
                                )
    {
        $this->loginView = $loginView;
        $this->loginModel = $loginModel;
        $this->smartQuestionsView = $smartQuestionsView;
        $this->smartQuestionsModel = $smartQuestionsModel;
    }
    //Call this public method from index to rund doAuth!
    public function tryAuth()
    {
        //Executing Usecase 1.2 and update $message in loginModel if support test returns TRUE!
        if(($this->didPostRequestAndWithEmptyInputsForUsernameAndWithEmptyInputForPassword()))
        {
            $this->loginModel->setResponseMessage('Username is missing');
        };
        //Executing Usecase 1.3 and update $message in loginModel if support test returns TRUE!
        if($this->didPostAndWithInputForUserNameAndWithEmptyForPassword())
        {
            $this->loginModel->setResponseMessage('Password is missing');
        }
        //Executing Usecase 1.4 and update $message in loginModel if support test returns TRUE!
        if($this->didPostAndWithEmptyInputForUserNameAndWithInputForPassword())
        {
            $this->loginModel->setResponseMessage('Username is missing');
        }
        //Executing Usecase 1.5 and update $message in loginModel if support test returns TRUE!
        if($this->didPostAndWithValueAdminForUserNameAndWithValuePasswordWithSmallPForPassword())
        {
            $this->loginModel->setResponseMessage('Wrong name or password');
        }
        //Executing Usecase 1.6 and update $message in loginModel if support test returns TRUE!
        if($this->didPostAndWithValueAdminWithSmallAForUserNameAndWithValuePasswordForPassword())
        {
            $this->loginModel->setResponseMessage('Wrong name or password');
        }
    }

    //Supports UC 1.2 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
    private function didPostRequestAndWithEmptyInputsForUsernameAndWithEmptyInputForPassword()
    {
        if($this->smartQuestionsView->isPost())
        {
            if($this->loginView->didNotEnterUserName())
            {
                if($this->loginView->didNotEnterPassword())
                {
                    return true;
                }
            }
        }
    }
    //Supports UC 1.3 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
    private function didPostAndWithInputForUserNameAndWithEmptyForPassword()
    {
        if($this->smartQuestionsView->isPost())
        {
            if($this->loginView->didEnterUserName())
            {
                if($this->loginView->didNotEnterPassword())
                {
                    return true;
                }
            }
        }
    }
    //Supports UC 1.4 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
    private function didPostAndWithEmptyInputForUserNameAndWithInputForPassword()
    {
        if($this->smartQuestionsView->isPost())
        {
            if($this->loginView->didNotEnterUserName())
            {
                if($this->loginView->didEnterPassword())
                {
                    return true;
                }
            }
        }
    }
    //Supports UC 1.5 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
    private function didPostAndWithValueAdminForUserNameAndWithValuePasswordWithSmallPForPassword()
    {
        if($this->smartQuestionsView->isPost()) {
            if ($this->loginView->didEnterUserName()) {
                if ($this->loginView->getRequestUserName() === 'Admin') {
                    if ($this->loginView->didEnterPassword()) {
                        if ($this->loginView->getRequestPassword() === 'password') ;
                        {
                            return true;
                        }
                    }
                }
            }
        }
    }
    //Supports UC 1.6 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
    public function didPostAndWithValueAdminWithSmallAForUserNameAndWithValuePasswordForPassword()
    {
        if($this->smartQuestionsView->isPost()) {
            if ($this->loginView->didEnterUserName()) {
                if ($this->loginView->getRequestUserName() === 'admin') {
                    if ($this->loginView->didEnterPassword()) {
                        if ($this->loginView->getRequestPassword() === 'Password') ;
                        {
                            return true;
                        }
                    }
                }
            }
        }
    }
}