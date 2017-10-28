<?php session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">
<!--ScanPkg.php -->
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <title>Scan Packages</title>
         <link type="text/css" rel="stylesheet" href="mystyle.css">
    </head>
<body>


<?php
// open connection, database !phpuser
$servername = "localhost";
$username = "phpuser";
$password = "phpuserpw";
$dbname = "ship_rcv";

$conn = new mysqli($servername,$username,$password,$dbname);
   if ($conn->connect_error)
   {
     die("Database connection failed: " . $conn->connect_error);
   }

// get package number

//$mText=filter_input(INPUT_POST,'scan2', FILTER_SANITIZE_SPECIAL_CHARS);
$mText=rtrim(mysqli_real_escape_string($conn, $_POST['scan2']),"\r\n");

if (empty($mText))
{ 
  echo "no package numbers posted";
}

// get shipper's number from package number
switch ($mtext)
{
  case (substr($mText,1,1=='Z')) :
    $mshipno = substr($mText,2,6);        // UPS
    break;
  case (substr($mText,1,1=='z')) :
    $mshipno = substr($mText,2,6);        // UPS
    break;
  case (substr($mText,0,1) == '9') :
    $mshipno = substr($mText,7,7);        // FedEx    
  default :
    $mshipno = '00000';  
}


//get date package received
//$mdate = filter_input(INPUT_POST,'mdate', FILTER_SANITIZE_SPECIAL_CHARS);   
$mdate=mysqli_real_escape_string($conn, $_POST['mdate']);

if (empty($mdate))
    {$mdate = date('Y-m-d');}


//verify shipno on file
$query= "select shipno from shippers where shipno= '$mshipno'";
$result = $conn->query($query);

//package numbers:
//$mpnumber="1ZT9759T0341373903";
if (isset($_SESSION['wid']))
  {$wid     =  $_SESSION['wid'];}


if ($result) 
{
        //insert into packages
    $query= "insert into packages (pnumber,snumber,preceived,wid) values ('$mText','$mshipno','$mdate','$wid')";
        

    $result=mysqli_query($conn,$query);

    if (!$result)
    {
        echo "no shipper on file";
        $i++;
    }
    
}

mysqli_close($con);
?>
<!--<a href="#" onClick="history.go(-1)">Back</a>-->
<input type=button value="Back" onClick="history.go(-1)">


</body>
</html>
