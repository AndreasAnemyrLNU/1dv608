<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-09-20
 * Time: 08:40
 */
namespace model;

class DALAuthentication
{
    public function testReturnThrowDALAException(){
        throw new \ExceptionDALAuthentication('Kasta fel från DAL och fånga sedan meddelandet!');
    }
}