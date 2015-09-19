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


        //Usecase 1.2
        if(($this->didPostRequestAndWithEmptyInputsForUsernameAndWithEmptyInputForPassword()))
        {
            //If did not fill in input update state (message for feedback in this case)
            //This update state of loginModel. But is it a valid MVC alá D.Toll?
            $this->loginModel->setResponseMessage('Username is missing');
        };

        //Usecase 1.3
        if($this->didPostAndWithInputForUserNameAndWithEmptyForPassword())
        {
            $this->loginModel->setResponseMessage('Password is missing');
        }

        //Usecase 1.4
        if($this->didPostAndWithEmptyInputForUserNameAndWithInputForPassword())
        {
            $this->loginModel->setResponseMessage('Username is missing');
        }
    }

    //Supports UC 1.2 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
    private function didPostRequestAndWithEmptyInputsForUsernameAndWithEmptyInputForPassword()
    {

        if($this->smartQuestionsView->isPost())
        {
            //echo "is Post är TRUE!";
            if($this->loginView->didNotEnterUserName())
            {
                //echo "didNotEneterUserName är TRUE!";
                if($this->loginView->didNotEnterPassword())
                {
                    //echo "didNotEnterPassword är TRUE";
                    return true;
                }
                return false;
            }
        }
        return false;
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
                return false;
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
                return false;
            }
        }
    }
}