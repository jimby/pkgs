<?php
class PkgsDB extends mysqli {

    // single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars
    private $user = "phpuser";
    private $pass = "phpuserpw";
    private $dbName = "ship_rcv";
    private $dbHost = "localhost";
    private $con = null;

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    // private constructor
    function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    /**** BEGIN pks functions *****/
    /** package functions begin here *****/
    public function FindShipno($mshipno) {
        $mshipno = $this->real_escape_string($mshipno);
        
        $query= "SELECT shipno FROM shippers WHERE shipno = '".$mshipno."'";
        $result = $this->query($query);
        if ($result->num_rows > 0){ 
            $row = $result->fetch_row();
            return $row[0];
        } else {
            return null;
        }
        //if ($this->query($query1) !== TRUE) {
        //  return null;
        //} else {
        //  return 1;
        //}
        
    }
    
    public function InsertPackageNumber($Mpnumber,$Msnumber,$Mpreceived,$Mwid) {
        $Mpnumber       = $this->real_escape_string($Mpnumber);
        $Msnumber       = $this->real_escape_string($Msnumber);
        $Mpreceived     = $this->real_escape_string($Mpreceived);   
        $Mwid           = (int)$Mwid;                         //integer!!!
        
        $query1="INSERT INTO packages (pnumber,snumber,preceived,wid) VALUES ('$Mpnumber', '$Msnumber','$Mpreceived',$Mwid)";
                
        if ($this->query($query1) !== TRUE) {
            return null;
        } else {
            return 1;
        }
               
    }
    
}             
   
