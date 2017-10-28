<?php
require_once "Includes/UsersDB.php";
//require_once "Includes/db.php";
    
    $Mpnumber   = "1ZT9759T0341373903";
    $Msnumber   = "T9759T";
    $Mpreceived = "2016-04-06";
    $Mwid = 9;
    $result=PkgsDB::getInstance()->InsertPackageNumber($Mpnumber,$Msnumber,$Mpreceived,$Mwid);
    


    //$num = $mysqli->affected_rows;    
    //if ($num)
    //{
    //    return true;
    //}
    //else {
    //    return false;    
    //}
    ?>