<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-09-23
 * Time: 16:12
 */

namespace model;


class RndNumberGenerator
{
    private $uniqueNumberBasedOnTimeOfRequestToServer;

    public function __construct()
    {
        $this->uniqueNumberBasedOnTimeOfRequestToServer = base64_encode((string)$_SERVER['REQUEST_TIME']);
        $this->saveInSession();
    }

    //Client have to match this nr next request.
    //If Mismatch Client must be logged out abrupt!
    private function saveInSession()
    {
        $_SESSION['previousUnniqueNumberBasedOnTimeOfRequestToServer'] = $_SESSION['uniqueNumberBasedOnTimeOfRequestToServer'];

        $_SESSION['uniqueNumberBasedOnTimeOfRequestToServer'] = $this->uniqueNumberBasedOnTimeOfRequestToServer;
    }

    public function getuniqueNumberBasedOnTimeOfRequestToServer()
    {
        return $this->uniqueNumberBasedOnTimeOfRequestToServer;
    }



}