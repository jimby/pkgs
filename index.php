<?php
session_start;
require_once "Includes/db.php";
//require_once "Includes/testDB.php";
//check for cookies
if (isset($_SESSION["warehouse"])) {
    if (isset($_SESSION["wid"])) {
        header ('location:menu.php');
    }
    else {
        header ('location:warehouse/ware_find.php');
    }
}
else {
    header ('location:warehouse/ware_find.php');
}




// pass word
//$servername= "localhost";
//$username  = "phpuser";
//$password  = "phpuserpw";
//$dbname    = "ship_rcv";
$realm = 'Restricted area';
$message= "$realm...Password required";


//new connection
//$conn = new mysqli($servername, $username, $password,$dbname);
//   if ($conn->connect_error)
//   {
//     die("Could not connect: " . $conn->connect_error);
//    }
//    $sql = "SET NAMES 'utf8'";
//    $result = $conn->query($sql);
   
//    $query = "select u.userName,u.userPass from users u";
//    $result = $conn->query($sql);
    $result=UserDB::getInstance()->VerifyUsersCredentials();
    
    if (!$result)
        die('query failed<br>');
    
    $users=array();
     if ($result->num_rows) 
        while($row = fetch_assoc())
        {          
            $uid = $row["userName"];
            $pw  = $row["userPass"];
            $users[$uid]= $pw;
        }


if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$realm.
           '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');
    die($message);
}


// analyze the PHP_AUTH_DIGEST variable
if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) || !isset($users[$data['username']]))
    {
        die('wrong credentials...');
    }

// generate the valid response
$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

if ($data['response'] != $valid_response)
{
    die('Wrong Credentials!');
}
function http_digest_parse($txt)
{
    // protect against missing data
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
} 