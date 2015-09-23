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
use model\RndNumberGenerator;
use model\SmartQuestionsModel;
use model\userModel;
use \view\loginView;
use view\SmartQuestionsView;


class doAuth
{
    private $loginView;
    private $loginModel;
    private $smartQuestionsView;
    private $smartQuestionsModel;
    private $dalauthenticationModel;
    private $rndNumberGenerator;
    private $userModel;


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
        $this->smartQuestionsView = $smartQuestionsView;
        $this->smartQuestionsModel = $smartQuestionsModel;
        $this->dalauthenticationModel = $dalauthenticationModel;
        $this->rndNumberGenerator = new RndNumberGenerator();
    }
    //usecase 1 (1.1 - 1.7 OK!
    public function tryAuth()
    {
        //Usecase 1.1
        //Solution -> $loginModel->$isAuthenticated = TRUE in __Constructor
        try
        {
                //Usecase 1.2 - 1.6 (Method createUserModel checks if Sessions exists,
                // usecase 1.8, 1.8.1, 1.9)
            if
            (
                //Fix for problem with reloading post when logout...
                $this->smartQuestionsView->isPost()
                && $this->loginView->didNotClickLogout()
                //A session i valid for create a UserModel
                || $this->loginModel->getIsAuthenticated()

            )
            {

                //START FLOW SAVED CREDENTIALS VIEW
                if($this->loginView->clientHasCredentialsSaved())
                {
                    $this->userModel = $this->createUserModelFromClientCredentials();

                    //Fix for reloading submitted form twice or more...
                    if
                    (
                        $this->loginModel->isACookieUser() === FALSE
                    )
                    {
                        $this->loginModel->setResponseMessage('');
                    }
                }
                //END FLOW SAVED CREDENTIALS VIEW
                //START FLOW SESSION USER
                else
                {
                    $this->userModel = $this->createUserModel();

                    //Usecase 1.7
                    if ($this->loginModel->getIsAuthenticated() === FALSE) {
                        $this->loginModel->setResponseMessage('Welcome');
                    }
                    //Usecase 1.8
                    if ($this->loginModel->getIsAuthenticated() === TRUE) {
                        $this->loginModel->setResponseMessage('');
                    }

                    //If user logged in by POST or SESSION it's tracked now by/in session!
                    $this->loginModel->startSessionTrackUser();
                    $this->loginModel->setIsAuthenticated(TRUE);
                    //END FLOW SESSION USER
                }

                //Usecase 3.1 Keep Me...
                $this->loginView->didUserMarkKeepMeLoggedIn()
                    ? $this->loginView->createSessionCookies(new RndNumberGenerator()) : NULL;
                //$this->loginModel->setResponseMessage('Welcome and you will be remembered');
                $this->loginModel->startTrackAsCookieUser();

                //Usecase 2.1 Logout
                if ($this->loginView->didClickLogout())
                {
                    $this->loginModel->setResponseMessage('Bye bye!');
                    //Prevents View from authenticated stuff...
                    $this->loginModel->setIsAuthenticated(FALSE);
                    //Delete all session vars
                    //session_destroy();
                }
            }
            else
            {
                //Client tried a GET...
                $this->loginModel->setIsAuthenticated(FALSE);
            }
        }
        catch (\Exception $e)
        {
            $this->loginModel->setResponseMessage($e->getMessage());
        }




//        //usecase 3.3 Login by cookies
//        if
//        (
//            $this->smartQuestionsView->isGet()
//            && $this->loginView->hasCookieName()
//            && $this->loginView->hasCookiePassword()
//        )
//        {
//
//            $name       = $this->loginView->getValueOfCookieUserName();
//            $password   = $this->loginView->getValueOfCookiePassWord();
//            //$password   = $this->loginView->getValueOfCookiePassWord();
//
//            $this->loginView->setValueOfPostUserName($name);
//            $this->loginView->setValueOfPostPassword($password);
//        }
//
//        //Get value froom cookies if PHPSESSID ok??? TEST?
//        if
//        (
//            $this->smartQuestionsView->isPost()
//            && $this->loginView->didClickLogin()
//            ||
//            //Destroyed PHPSESSID but existing cookies in browser.
//            $this->smartQuestionsView->isGet()
//            && $this->loginView->hasCookieName()
//            && $this->loginView->hasCookiePassword()
//        )
//        {
//            try
//            {
//                //Before! __Constructor accept to create a userModel
//                //validating is done in and by the __constructor.
//                // Exception is thrown if data or user is === not valid!
//                $user = new userModel
//                                        (
//                                            $this->loginView->getValueOfPostUserName(),
//                                            $this->loginView->getValueOfPostPassword(),
//                                            $this->loginModel,
//                                            $this->loginView->clientHasCredentialsSaved()
//                                        );
//
//                //No Exception thrown. Login OK!
//                $this->loginModel->setIsAuthenticated(TRUE);
//
//                //Check Clients Request!
//                if($this->loginModel->isNotTracked())
//                {
//                    if($_COOKIE['LoginView::rnd'] == $_SESSION['previousUniqueNumberBasedOnTimeOfRequestToServer'])
//                    {
//                        $this->loginModel->setIsAuthenticated(TRUE);
//                    }
//                    else
//                    {
//                        $this->loginModel->setIsAuthenticated(FALSE);
//                    }
//                }
//                setcookie('LoginView::rnd', $this->rndNumberGenerator->getuniqueNumberBasedOnTimeOfRequestToServer());
//
//                    if
//                    (
//                        $this->smartQuestionsView->isPost()
//                        && $this->loginModel->isNotTracked()
//                    )
//                    {
//                        $this->loginModel->setResponseMessage("Welcome");
//                        $this->loginModel->startTrackUser();
//                    }
//                    elseif
//                    (
//                        !isset($_COOKIE['PHPSESSID'])
//                        && $this->smartQuestionsView->isGet()
//                        && $this->loginModel->isNotACookieUser()
//                    )
//                    {
//                        $this->loginModel->setResponseMessage('Welcome back with cookie');
//                        $this->loginModel->startTrackUser();
//                        $this->loginModel->setIsAuthenticated(TRUE);
//                    }
//                    elseif
//                    (
//                        $this->smartQuestionsView->isPost()
//                        && $this->loginModel->isTracked()
//                    )
//                    {
//                        $this->loginModel->setResponseMessage("");
//
//                    }
//
//                //usecase 3 3.1 - 3.2
//                if
//                (
//                    $this->loginView->didUserMarkKeepMeLoggedIn()
//                )
//                {
//
//                    if
//                    (
//                        $this->loginView->hasCookieName()
//                        && $this->loginView->hasCookiePassword()
//                    )
//                    {
//                        $this->loginModel->setResponseMessage("");
//                    }
//                    else
//                    {
//                        $this->loginModel->setResponseMessage("Welcome and you will be remembered");
//                        $this->loginModel->startTrackThisIsACookieUser();
//                    }
//                    $this->loginView->createSessionCookies($this->rndNumberGenerator->getuniqueNumberBasedOnTimeOfRequestToServer());
//                }
//
//                //If Login is Ok - User is saved in loginModel.
//                //User also saved in $_SESSION!! (in setters of loginModel)
//                $this->loginModel->setUser      ($this->loginView->getValueOfPostUserName());
//                $this->loginModel->setPassword  ($this->loginView->getValueOfPostPassword());
//
//            }
//            catch (\Exception $e)
//            {
//                $this->loginModel->setResponseMessage($e->getMessage());
//            }
//        }
//        //usecase 2.1 - 2.4 OK!
//        elseif
//                (
//                    $this->smartQuestionsView->isPost()
//                    && $this->loginView->didClickLogout()
//                    && $this->loginModel->getIsAuthenticated()
//                )
//        {
//            $this->loginModel->setIsAuthenticated(FALSE);
//            $this->loginView->deactivateLogoutButton();
//            $this->loginModel->setResponseMessage("Bye bye!");
//            $this->loginView->deleteSessionCookies();
//        }
//        else
//        {
//            //Empty
//        }
    }

    private function createUserModel()
    {
        //Before returning new object!
        //Validation by the __constructor.
        // Exception is thrown if data or user is === not valid!


    if($this->loginModel->getIsAuthenticated())
    {
        $username = userModel::getSessionUserName();
        $password = userModel::getSessionPassword();
    }
    else
    {
        $username = $this->loginView->getValueOfPostUserName();
        $password =  $this->loginView->getValueOfPostPassword();
    }

    return new userModel
                        (
                            $username,
                            $password,
                            $this->loginModel,
                            $this->loginView->clientHasCredentialsSaved()
                        );
    }

    private function createUserModelFromClientCredentials()
    {
        //Before returning new object!
        //Validation by the __constructor.
        // Exception is thrown if data or user is === not valid!

            $username = $this->loginView->getValueOfCookieUserName();
            $password = $this->loginView->getValueOfCookiePassWord();

        return new userModel
        (
            $username,
            $password,
            $this->loginModel,
            $this->loginView->clientHasCredentialsSaved()
        );
    }
}
