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
    public function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    /**** users start here *****/
    public function VerifyUsersCredentials($userName,$userPass) {
        $muser= $this->real_escape_string($userName);
        $mpass=$this->real_escape_string($userPass);
        $mresult = $this->query("SELECT '".$muser."','".$mpass."' FROM users");
        
        if ($mresult->num_rows > 0){
    		$row = $mresult->fetch_row();
    		return $row[0];
    	} else {
    		return null;
    	}
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
        $muserID = $this->real_escape_string($userID);
        $mresult = $this->query("SELECT * FROM users WHERE id = '".$muserID."'");
        
         if ($mresult->num_rows > 0){
    		$row = $mresult->fetch_row();
    		return $row[0];
    	} else {
    		return null;
    	}
    }

    public function CreateUser($name,$password) {
    	$mname = $this->real_escape_string($name);
    	$mpassword = $this->real_escape_string($password);
    	$this->query("INSERT INTO users (userName,userPass) VALUES ('" . $mname
    			. "', '" . $mpassword . "')");
    }
    
    
    public function GetUsers($id,$name,$password) {
        $mid = $this->real_escape_string($id);
        $mname = $this->real_escape_string($name);
    	$mpassword = $this->real_escape_string($password);
        
        $mresult = $this->query("SELECT '".$mid."','".$mname."''".$mpassword."' FROM users");
        
        if ($mresult->num_rows > 0){
    		$row = $mresult->fetch_row();
    		return $row[0];
    	} else {
    		return null;
    	}
        
    }
    
    
    public function DeleteUser($userID) {
    	$muserID = (int)($userID);
    	
        $this->query("DELETE FROM users WHERE id =$muserID");
    }
    
}
?>