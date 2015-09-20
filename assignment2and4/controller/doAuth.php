<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-09-18
 * Time: 15:01
 */

namespace controller;
use model\DALAuthentication;
use \model\loginModel;
use model\SmartQuestionsModel;
use model\userModel;
use \view\loginView;
use view\SmartQuestionsView;


class doAuth
{
    private $loginView;
    private $loginModel;
    private $loginModelCopy;
    private $smartQuestionsView;
    private $smartQuestionsModel;
    private $dalauthenticationModel;

    public function __construct
                                (
                                    LoginView $loginView,
                                    LoginModel $loginModel,
                                    SmartQuestionsView $smartQuestionsView,
                                    SmartQuestionsModel $smartQuestionsModel,
                                    DALAuthentication $dalauthenticationModel
                                )
    {
        $this->loginView = $loginView;
        $this->loginModel = $loginModel;
        $this->loginModelCopy = clone $this->loginModel;
        $this->smartQuestionsView = $smartQuestionsView;
        $this->smartQuestionsModel = $smartQuestionsModel;
        $this->dalauthenticationModel = $dalauthenticationModel;
    }
    //usecase 1
    public function tryAuth()
    {
        if($this->smartQuestionsView->isPost())
        {
            try
            {
                $user = new userModel
                (
                    $this->loginView->getRequestUserName(),
                    $this->loginView->getRequestPassword(),
                    $this->loginModel
                );
            }
            catch (\Exception $e)
            {
                $this->loginModel->setResponseMessage($e->getMessage());
            }
        }


        //try
        //{
        //    $this->dalauthenticationModel->testReturnThrowDALAException();
        //}
        //catch(\Exception $e)
        //{
        //    var_dump($e);
        //}
    }


//    //Call this public method from index to rund doAuth!
//    public function tryAuth()
//    {
//        //Executing Usecase 1.2 and update $message in loginModel if support test returns TRUE!
//        if(($this->didPostRequestAndWithEmptyInputsForUsernameAndWithEmptyInputForPassword()))
//        {
//            $this->loginModel->setResponseMessage('Username is missing');
//            var_dump($this->loginModel);
//            var_dump($this->loginModelCopy);
//            return;
//        }
//        //Executing Usecase 1.3 and update $message in loginModel if support test returns TRUE!
//        if($this->didPostAndWithInputForUserNameAndWithEmptyForPassword())
//        {
//            $this->loginModel = clone $this->loginModelCopy;
//            $this->loginModel->setResponseMessage('Password is missing');
//            return;
//        }
//        //Executing Usecase 1.4 and update $message in loginModel if support test returns TRUE!
//        if($this->didPostAndWithEmptyInputForUserNameAndWithInputForPassword())
//        {
//            $this->loginModel = clone $this->loginModelCopy;
//            $this->loginModel->setResponseMessage('Username is missing');
//            return;
//        }
//        //Executing Usecase 1.5 and update $message in loginModel if support test returns TRUE!
//        if($this->didPostAndWithValueAdminForUserNameAndWithValuePasswordWithSmallPForPassword())
//        {
//            $this->loginModel = clone $this->loginModelCopy;
//            $this->loginModel->setResponseMessage('Wrong name or password');
//            return;
//        }
//        //Executing Usecase 1.6 and update $message in loginModel if support test returns TRUE!
//        if($this->didPostAndWithValueAdminWithSmallAForUserNameAndWithValuePasswordForPassword())
//        {
//            $this->loginModel = clone $this->loginModelCopy;
//            $this->loginModel->setResponseMessage('Wrong name or password');
//            return;
//        }
//        //Executing Usecase 1.7 and update $message in loginModel if support test returns TRUE!
//        if($this->didPostAndWithCorrectValueAdminForUserNameAndCorrectWithValuePasswordWithCapitalPForPassword())
//        {
//            $this->loginModel = clone $this->loginModelCopy;
//            $this->loginModel->setIsAuthenticated(true);
//            return;
//        }
//
//    }
//
//    //Supports UC 1.2 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
//    private function didPostRequestAndWithEmptyInputsForUsernameAndWithEmptyInputForPassword()
//    {
//        if($this->smartQuestionsView->isPost())
//        {
//            if($this->loginView->didNotEnterUserName())
//            {
//                if($this->loginView->didNotEnterPassword())
//                {
//                    return true;
//                }
//            }
//        }
//    }
//    //Supports UC 1.3 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
//    private function didPostAndWithInputForUserNameAndWithEmptyForPassword()
//    {
//        if($this->smartQuestionsView->isPost())
//        {
//            if($this->loginView->didEnterUserName())
//            {
//                if($this->loginView->didNotEnterPassword())
//                {
//                    return true;
//                }
//            }
//        }
//    }
//    //Supports UC 1.4 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
//    private function didPostAndWithEmptyInputForUserNameAndWithInputForPassword()
//    {
//        if($this->smartQuestionsView->isPost())
//        {
//            if($this->loginView->didNotEnterUserName())
//            {
//                if($this->loginView->didEnterPassword())
//                {
//                    return true;
//                }
//            }
//        }
//    }
//    //Supports UC 1.5 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
//    private function didPostAndWithValueAdminForUserNameAndWithValuePasswordWithSmallPForPassword()
//    {
//        if($this->smartQuestionsView->isPost()) {
//            if ($this->loginView->didEnterUserName()) {
//                if (strcmp((string)$this->loginView->getRequestUserName(),"Admin") === 0) {
//                    if ($this->loginView->didEnterPassword()) {
//                        if (strcmp((string)$this->loginView->getRequestPassword(),"password") === 0) ;
//                        {
//                            return true;
//                        }
//                    }
//                }
//            }
//        }
//    }
//    //Supports UC 1.6 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
//    public function didPostAndWithValueAdminWithSmallAForUserNameAndWithValuePasswordForPassword()
//    {
//        if($this->smartQuestionsView->isPost()) {
//            if ($this->loginView->didEnterUserName()) {
//                if(strcmp((string)$this->loginView->getRequestUserName(), "admin") === 0) {
//                    if ($this->loginView->didEnterPassword()) {
//                        if(strcmp((string)$this->loginView->getRequestPassword(), "Password") === 0)
//                        {
//                            return true;
//                        }
//                    }
//                }
//            }
//        }
//    }
//    //Supports UC 1.7 -> returns bool value TRUE if ALL test params for UC returns/validates to TRUE!
//    public function didPostAndWithCorrectValueAdminForUserNameAndCorrectWithValuePasswordWithCapitalPForPassword()
//    {
//        if($this->smartQuestionsView->isPost()) {
//            if($this->loginView->didEnterUserName()) {
//                if(strcmp((string)$this->loginView->getRequestUserName(), 'Admin' === 0))
//                {
//                    if($this->loginView->didEnterPassword()) {
//                        if(strcmp((string)$this->loginView->getRequestPassword(), 'Password' === 0))
//                        {
//                            return true;
//                        }
//                    }
//                }
//            }
//        }
//    }
}