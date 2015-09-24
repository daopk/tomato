<?php

/**
*
*/
class Database_TM_Module
{
    private $config = array();
    private $db;

    function __construct()
    {
        if(file_exists(TOMATO_DIR_APP_CONFIG.'database.php'))
            $this->config = require TOMATO_DIR_APP_CONFIG.'database.php';

        if(!empty($this->config))
            $this->db = $this->Connect();
    }

    function Connect()
    {
        if(!empty($this->config['driver']))
        {
            switch ($this->config['driver']) {
                case 'mysql':
                case 'mysqli':
                    $pdo_h = $this->PDO_Mysql($this->config);
                    break;
                case 'sqlite':
                    $pdo_h = $this->PDO_Sqlite($this->config);
                    break;
            }
        }

        if(isset($pdo_h))
            return new NotORM($pdo_h ,null, new NotORM_Cache_Session());
            //return new NotORM($pdo_h ,null);
    }

    function PDO_Mysql($config)
    {
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        return new PDO('mysql:host='.$config['host'].';dbname='.$config['db_name'],
            $config['user'], $config['pass'], $options);
    }

    function PDO_Sqlite($config)
    {
        return new PDO('sqlite:'.TOMATO_DIR.$config['file']);
    }

    function GetDb(){
        return $this->db;
    }
}