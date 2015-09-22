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
    private $loginModel;

    private $clientHasCredentialsSaved;

    /**
     * userModel constructor.
     * @param $userName
     * @param $passWord
     */
    public function __construct(
                                    $userName,
                                    $passWord,
                                    LoginModel $loginModel,
                                    $clientHasCredentialsSaved)
    {

        $this->loginModel = $loginModel;
        $this->clientHasCredentialsSaved = $clientHasCredentialsSaved;

        //Test for usecase 1.2
        $this->loginAttemptHasNotEmptyField($userName, $passWord);
        //Test for usecase 1.3
        $this->loginAttemptHasNotEmptyFieldForPassword($userName, $passWord);
        //Test for usecase 1.4
        $this->loginAttemptHasOnlyValueForPassword($userName, $passWord);
        //Test for usecase 1.5 , 1.6 , 1.7
        $this->loginAttemptAgainstExistingUser($userName, $passWord);

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

    private function loginAttemptHasOnlyValueForPassword($userName, $passWord)
    {
        if($userName == "" && $passWord != "")
        {
            throw new \FailedLoginWithOnlyPasswordException("Username is missing");
        }
        return true;
    }

    private function loginAttemptAgainstExistingUser($userName, $passWord)
    {

        //Impl. query against a dal something.... Hardcoded for test!

        if($this->clientHasCredentialsSaved)
        {
            if (strcmp($userName, 'Admin') !== 0)
            {
                throw new \FaildeloginWithWrongPassWordButExistingUserName("Wrong information in cookies");
            }

            if (strcmp($passWord, 'Password') !== 0)
            {
                throw new \FaildeloginWithWrongPassWordButExistingUserName("Wrong information in cookies");
            }
        }
        else
        {
            if (strcmp($userName, 'Admin') !== 0)
            {
                throw new \FaildeloginWithWrongPassWordButExistingUserName("Wrong name or password");
            }

            if (strcmp($passWord, 'Password') !== 0)
            {
                throw new \FaildeloginWithWrongPassWordButExistingUserName("Wrong name or password");
            }
        }
        return true;
    }
}