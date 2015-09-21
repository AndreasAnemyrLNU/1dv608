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
    //usecase 1 (1.1 - 1.7 OK!
    public function tryAuth()
    {
        //usecase 3.3 Login by cookies
        if
        (
            $this->loginView->hasCookieName()
            && $this->loginView->hasCookiePassword()
        )
        {
            $name       = $this->loginView->getValueOfCookieUserName();
            $password   = $this->loginView->getValueOfCookiePassWord();
            $this->loginView->setValueOfPostUserName($name);
            $this->loginView->setValueOfPostPassword($password);
        }

        if
        (
            $this->smartQuestionsView->isPost()
            && $this->loginView->didClickLogin()
            || $this->loginView->hasCookieName()
            && $this->loginView->hasCookiePassword()

        )
        {
            try
            {
                //Before! __Constructor accept to create a userModel
                //validating is done in and by the __constructor.
                // Exception is thrown if data or user is === not valid!
                $user = new userModel
                                        (
                                            $this->loginView->getValueOfPostUserName(),
                                            $this->loginView->getValueOfPostPassword(),
                                            $this->loginModel
                                        );

                //No Exception thrown. Login OK!
                $this->loginModel->setIsAuthenticated(TRUE);
                //Todo ok to store in $_SESSION here?
                $_SESSION['isAuthenticated'] = TRUE;

                //Std message to be shown if regular flow without cookies etc!
                $this->loginModel->setResponseMessage("Welcome");

                //TODO part of usecase 3.3 to get proper message shown.
                //Not satisfied with this solution.
                if
                (
                    $this->loginView->hasCookieName()
                    && $this->loginView->hasCookiePassword()
                    && $this->loginModel->getIsAuthenticated()
                )
                {
                    $this->loginModel->setResponseMessage('Welcome back with cookie');
                }

                //usecase 3 3.1 - 3.2
                if
                (
                    $this->loginView->didUserMarkKeepMeLoggedIn()
                )
                {
                    echo "createSessionCookie called from " . __CLASS__ . " " . __LINE__;
                    $this->loginView->createSessionCookies();
                    $this->loginModel->setResponseMessage("Welcome and you will be remembered");

                }

            }
            catch (\Exception $e)
            {
                $this->loginModel->setResponseMessage($e->getMessage());
            }
        }
        //usecase 2.1 - 2.4 OK!
        elseif
                (
                    $this->smartQuestionsView->isPost()
                    && $this->loginView->didClickLogout()
                    && $this->loginModel->getIsAuthenticated()
                )
        {
            $this->loginModel->setIsAuthenticated(FALSE);
            $this->loginView->deactivateLogoutButton();
            $this->loginModel->setResponseMessage("Bye bye!");

            //$this->loginView->deleteSessionCookies();
        }
        else
        {

        }
    }
}