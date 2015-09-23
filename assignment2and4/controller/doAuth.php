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

        //echo $this->loginView->getValueOfCookiePassWord();
        //var_dump($_SESSION);
        //echo $_COOKIE['LoginView::CookiePassword'];

        //usecase 3.3 Login by cookies
        if
        (
            $this->smartQuestionsView->isGet()
            && $this->loginView->hasCookieName()
            && $this->loginView->hasCookiePassword()
        )
        {



            $name       = $this->loginView->getValueOfCookieUserName();
            $password   = $this->loginView->getValueOfCookiePassWord();
            //$password   = $this->loginView->getValueOfCookiePassWord();

            $this->loginView->setValueOfPostUserName($name);
            $this->loginView->setValueOfPostPassword($password);
        }

        //Get value froom cookies if PHPSESSID ok??? TEST?
        if
        (
            $this->smartQuestionsView->isPost()
            && $this->loginView->didClickLogin()
            ||
            //Destroyed PHPSESSID but existing cookies in browser.
            $this->smartQuestionsView->isGet()
            && $this->loginView->hasCookieName()
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
                                            $this->loginModel,
                                            $this->loginView->clientHasCredentialsSaved()
                                        );

                //No Exception thrown. Login OK!
                $this->loginModel->setIsAuthenticated(TRUE);

                //Check Clients Request!
                if(isset($_COOKIE['rnd']))
                {
                    if($_COOKIE['rnd'] === $_SESSION['previousUniqueNumberBasedOnTimeOfRequestToServer']);
                }
                {
                    $this->loginModel->setIsAuthenticated(TRUE);
                }


                //echo $_COOKIE['rnd'];
                //echo $_SESSION['previousUnniqueNumberBasedOnTimeOfRequestToServer'];


                setcookie('rnd', $this->rndNumberGenerator->getuniqueNumberBasedOnTimeOfRequestToServer());

                    if
                    (
                        $this->smartQuestionsView->isPost()
                        && $this->loginModel->isNotTracked()
                    )
                    {
                        $this->loginModel->setResponseMessage("Welcome");
                        $this->loginModel->startTrackUser();
                    }
                    elseif
                    (
                        $this->smartQuestionsView->isPost()
                        && $this->loginModel->isTracked()
                    )
                    {
                        $this->loginModel->setResponseMessage("");

                    }
                    elseif
                    (
                        !isset($_COOKIE['PHPSESSID'])
                        && $this->smartQuestionsView->isGet()
                        && $this->loginModel->isNotACookieUser()
                    )
                    {
                        $this->loginModel->setResponseMessage('Welcome back with cookie');
                        $this->loginModel->startTrackUser();
                    }

                //usecase 3 3.1 - 3.2
                if
                (
                    $this->loginView->didUserMarkKeepMeLoggedIn()
                )
                {

                    if
                    (
                        $this->loginView->hasCookieName()
                        && $this->loginView->hasCookiePassword()
                    )
                    {
                        $this->loginModel->setResponseMessage("");
                    }
                    else
                    {
                        $this->loginModel->setResponseMessage("Welcome and you will be remembered");
                        $this->loginModel->startTrackThisIsACookieUser();
                    }
                    $this->loginView->createSessionCookies($this->rndNumberGenerator->getuniqueNumberBasedOnTimeOfRequestToServer());
                }

                //If Login is Ok - User is saved in loginModel.
                //User also saved in $_SESSION!! (in setters of loginModel)
                $this->loginModel->setUser      ($this->loginView->getValueOfPostUserName());
                $this->loginModel->setPassword  ($this->loginView->getValueOfPostPassword());

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
            $this->loginView->deleteSessionCookies();
        }
        else
        {
            //Empty
        }
    }
}