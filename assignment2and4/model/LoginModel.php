<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-09-18
 * Time: 16:26
 */

namespace model;


class LoginModel
{
    private $responseMessage;

    private $isAuthenticated;

    public function __construct()
    {
        $this->responseMessage = "";

        if(isset($_SESSION['isAuthenticated']))
        {
            $this->setIsAuthenticated($_SESSION['isAuthenticated']);
        }
        else
        {
            $this->setIsAuthenticated(FALSE);
        }

    }


    /**
     * @return string
     */
    public function getResponseMessage()
    {
        return $this->responseMessage;
    }

    /**
     * @param mixed $responseMessage
     */
    public function setResponseMessage($responseMessage)
    {
        $this->responseMessage = $responseMessage;
    }

    /**
     * @return mixed
     */
    public function getIsAuthenticated()
    {
        return $this->isAuthenticated;
    }

    /**
     * @param mixed $isAuthenticated
     */
    public function setIsAuthenticated($isAuthenticated)
    {
        //TODO Another solution for $_SESSION['isAuthenticated'],
        //maybe string should be private static? :)
        $_SESSION['isAuthenticated'] = $isAuthenticated;
        $this->isAuthenticated = $isAuthenticated;
    }
}