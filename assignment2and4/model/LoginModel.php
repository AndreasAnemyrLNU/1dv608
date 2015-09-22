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
    private static $sessionID;

    private $responseMessage;

    private $isAuthenticated;

    private $user;

    private $password;

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
     * @return mixed
     */
    public static function getSessionID()
    {
        return self::$sessionID;
    }

    /**
     * @param mixed $sessionID
     */
    public static function setSessionID($sessionID)
    {
        self::$sessionID = $sessionID;
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

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        $_SESSION['user'] = $user;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        $_SESSION['password'] = $password;
    }
}