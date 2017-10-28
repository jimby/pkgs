<?php
if(isset($_COOKIE['warehouse']))
{
//echo "Your location ".$_COOKIE['warehouse'];
}
else
{
include 'ware_find.php';
if (isset($warehouse))  // $warehouse is mvar from ware_find.php
    {
    setcookie("warehouse",$warehouse,time()+(60*60*24*365*10));
   // echo "cookie set";
    }
    else
    {
     // echo "cookie not set";
    }
    
}
?>
