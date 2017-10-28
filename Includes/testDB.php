<?php
class UserDB extends mysqli {

    // single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars
    private $user = "phpuser";
    private $pass = "phpuserpw";
    private $dbName = "ship_rcv";
    private $dbHost = "localhost";
    private $con = null;
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }
    
    function __construct() {
        //parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        //if (mysqli_connect_error()) {
        //    exit('Connect Error (' . mysqli_connect_errno() . ') '
        //            . mysqli_connect_error());
        //}
        //parent::set_charset('utf-8');
    }
    
}
?>