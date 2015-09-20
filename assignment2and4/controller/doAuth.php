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
    //usecase 1 (1.1 - 1.7) OK!
    public function tryAuth()
    {
        if($this->smartQuestionsView->isPost() && $this->loginView->didClickLogin())
        {
            try
            {
                //Before! __Constructor accept to create a userModel
                //validating is done in and by the __constructor.
                // Exception is thrown if data or user is === not valid!
                $user = new userModel
                                        (
                                            $this->loginView->getRequestUserName(),
                                            $this->loginView->getRequestPassword(),
                                            $this->loginModel
                                        );

                //No Exception thrown. Login OK!
                $this->loginModel->setIsAuthenticated(TRUE);
                $this->loginModel->setResponseMessage("Welcome");
                //Todo ok to store in $_SESSION here?
                $_SESSION['isAuthenticated'] = TRUE;

            }
            catch (\Exception $e)
            {
                $this->loginModel->setResponseMessage($e->getMessage());
            }
        }
        elseif($this->smartQuestionsView->isPost() && $this->loginView->didClickLogout())
        {
            $this->loginModel->setIsAuthenticated(FALSE);
            $this->loginModel->setResponseMessage("Bye Bye");
            //throw new \Exception('Implement in: ' . __CLASS__ . 'Line' . __LINE__);
        }


        //else
        //{
        //    throw new \ErrorException('Something wrong in: ' . __CLASS__);
        //}

    }
}