<?php

class Conf
{
    const HOST = '';
    const DB_NAME = '';
    const DB_USER = '';
    const DB_PASS = '';

    public function getHostName(){
        return self::HOST;
    }

    public function getDBName(){
        return self::DB_NAME;
    }

    public function getDBUser(){
        return self::DB_USER;
    }

    public function getDBPass(){
        return self::DB_PASS;
    }
}