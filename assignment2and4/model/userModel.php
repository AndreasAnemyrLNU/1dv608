<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-09-20
 * Time: 09:33
 */

namespace model;


class userModel
{
    private $userName;
    private $passWord;

    /**
     * userModel constructor.
     * @param $userName
     * @param $passWord
     */
    public function __construct($userName, $passWord)
    {
        //Test for usecase 1.2
        $this->loginAttemptHasNotEmptyField($userName, $passWord);
        //Test for usecas 1.3
        $this->loginAttemptHasNotEmptyFieldForPassword($userName, $passWord);

        $this->userName = $userName;
        $this->passWord = $passWord;
    }


    /**
     * @param $userName
     * @param $passWord
     * @return bool
     * @throws \FailedLoginWithoutAnyEnteredFieldsException
     */

    private function loginAttemptHasNotEmptyField($userName, $passWord)
    {
        if($userName == "" && $passWord == "")
        {
            throw new \FailedLoginWithoutAnyEnteredFieldsException("Username is missing");
        }
        return true;
    }

    private function loginAttemptHasNotEmptyFieldForPassword($userName, $passWord )
    {
        if($userName != "" && $passWord == "")
        {
            throw new \FailedLoginWithOnlyUserNameException("Password is missing");
        }
        return true;
    }


}