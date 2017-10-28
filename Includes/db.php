<?php


class WarehouseDB extends mysqli {
    // single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars
    private $user = "phpuser";
    private $pass = "phpuserpw";
    private $dbName = "ship_rcv";
    private $dbHost = "localhost";
    private $conn = null;

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

/***** BEGIN warehouse**********************************/
    public function get_warehouse_id_by_location($mlocation) {
        $mlocation = $this->real_escape_string($mlocation);
    	$query="select wid from warehouses where wlocation like "." '%$mlocation%'";	 	
        $warehouseID = $this->query($query);

            if ($warehouseID->num_rows > 0){
               $row = $warehouseID->fetch_row();
               return $row[0];
            } else{
             return null;
            }
        }
    
    public function create_warehouse($name, $location) {
        $mname = $this->real_escape_string($name);
        $mlocation = $this->real_escape_string($location);
        $this->query("INSERT INTO warehouses (wname, wlocation) VALUES ('" . $mname
                . "', '" . $mlocation . "')");
    }
    
        
    public function find_warehouses() {
        return $this->query("SELECT * FROM warehouses");
    }
    
    
    public function delete_warehouse($warehouseID) {
                $this->query("DELETE FROM warehouses WHERE id = $warehouseID");
        }
        
    public function GetWarehouseIdByName ($name) 
    {
     $mname=   $this->real_escape_string($name);
     $mwid = $this->query("SELECT wid FROM warehouses WHERE wname = $mname");
     if ($mwid->num_rows > 0){
    		$row = $mwid->fetch_row();
    		return $row[0];
    	} else {
    		return null;
    	}
    }
        
    
    
}   

class UserDB extends mysqli {

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

    /**** users start here *****/
    public function VerifyUsersCredentials() {
        $mresult = $this->query("SELECT u.userName,u.userPass FROM users u");
        return $mresult->data_seek(0);
    }
    public function GetUserIdByName($name) {
    	$mname = $this->real_escape_string($name);
    	$muser = $this->query("SELECT id FROM users WHERE name = '" . $mname . "' ");
    
    	if ($muser->num_rows > 0){
    		$row = $muser->fetch_row();
    		return $row[0];
    	} else {
    		return null;
    	}
    }  
    
    public function GetUserByUserId($userID) {
        return $this->query("SELECT * FROM users WHERE id = $userID");
    }

    public function CreateUser($name,$password) {
    	$mname = $this->real_escape_string($name);
    	$mpassword = $this->real_escape_string($password);
    	$this->query("INSERT INTO users (userName,userPass) VALUES ('" . $mname
    			. "', '" . $mpassword . "')");
    }
    
    
    public function GetUsers() {
        return $this->query("SELECT id,name,password FROM users");
    }
    public function DeleteUser($userID) {
    	$muserID = (int)($userID);
    	$this->query("DELETE FROM users WHERE id =$muserID");
    }
    
}

class PkgsDB extends mysqli {

    // single instance of self shared among all instances
    private static $instance = null;
    
    // db connection config vars
    private $user = "phpuser";
    private $pass = "phpuserpw";
    private $dbName = "ship_rcv";
    private $dbHost = "localhost";
    private $conn = null;

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

	
	/** package functions begin here *****/
    public function FindShipno($mshipno) {
        $mshipno = $this->real_escape_string($mshipno);
        
        $query1= "SELECT shipno FROM shippers WHERE shipno = '".$mshipno."'";
        $result = $this->query($query1);
        if ($result->num_rows > 0){
    	    $row = $result->fetch_row();
    	    return $row[0];
    	} else {
    	    return 0;
    	}
    	//if ($this->query($query1) !== TRUE) {
    	//	return null;
        //} else {
    	//	return 1;
    	//}
        
    }
	
    public function InsertPackageNumber($Mpnumber,$Msnumber,$Mpreceived,$Mwid) {
        $Mpnumber       = $this->real_escape_string($Mpnumber);
        $Msnumber       = $this->real_escape_string($Msnumber);
        $Mpreceived     = $this->real_escape_string($Mpreceived);   
        //$Mwid           = $this->real_escape_string($Mwid);        //int
        
        //$query1="INSERT INTO packages (pnumber,snumber,preceived,wid) VALUES ('$Mpnumber', '$Msnumber','$Mpreceived',$Mwid)";
        $query1="INSERT INTO packages (pnumber,snumber,preceived,wid) VALUES ('$Mpnumber','$Msnumber','$Mpreceived',$Mwid)";        
        if ($this->query($query1) !== TRUE) {
            return null;
        } else {
            return 1;
        }
               
    }
}
