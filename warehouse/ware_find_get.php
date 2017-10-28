<?php
    session_start();
    
    if (isset($_POST['SelectWarehouse'])) {
        $result  =  explode(",",$_POST['SelectWarehouse']);		//get wid (warehouse I.D.)
        //$location = $result[0];
        $location= $result[0];						//save wid
        $wid = $result[1];
        }
        
    if (isset($location)) {
        // If everything okay
      //setcookie('warehouse',$location,time()+31536000,'/'); //set cookie
      //setcookie('wid',$wid,time()+3600,'/');    
      $_SESSION["warehouse"]=$location;
      $_SESSION["wid"]=$wid;
    }
//echo $_SESSION['warehouse'];	
   header ('location: ../menu.php');							// go to main menu
?>
