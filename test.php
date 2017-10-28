<?php
require_once "Includes/testDB.php";
    
    $mshipno = "T9759T";
       
    $result=PkgsDB::getInstance()->FindShipno($mshipno);
        
    if (!$result)
    {
        echo "query failed<br>";
    }
    else {
    echo "Alls okay";    
    }