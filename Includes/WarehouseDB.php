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

