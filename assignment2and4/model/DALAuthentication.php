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
        throw new \ExceptionDALAuthentication('Kasta fel fr�n DAL och f�nga sedan meddelandet!');
    }
}