
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
// open connection, database
  $conn = new mysqli("localhost", "phpuser", "phpuserpw","ship_rcv");
  if ($conn->error)
  {
     die('Could not connect to sql server ' . mysql_error());
  }
  
  //$sql = "SET NAMES 'utf8'";
  //$result = $conn->query($sql);
  
  // mysql_query("SET NAMES 'utf8'");
  // mysql_select_db("ship_rcv", $con);
  // date set to menu.php value

  if (isset($_POST['mdate']))
  {
    $today = mysqli_real_escape_string($conn,$_POST['mdate']);
  }

  //if date not entered, set to current date
  if (empty($today))
  {
    $today=date('Y-m-d');
  }
    $mText = filter_input(INPUT_POST,'scan2',FILTER_SANITIZE_SPECIAL_CHARS);
    $mText = trim($mText,$character_mask='\t\n\r'); 
// package number if (isset($_POST['scan2']))
  if (!isset($mText))
  {
    echo "no package numbers posted";
  }
  
  //split up scanned array into individual elements
  $rTest = explode("\n",$mText);

  $i=0;


  //loop &  test each tracking number (pkgno)
  $t=substr($rTest[$i],0,1);
  while (!empty($rTest[$i]))
  {

  //find shipno as a substring of tracking number
    if (substr($rTest[$i],1,1)== 'Z')
      {
        $mshipno = substr($rTest[$i],2,6);
      }//endif
    elseif (substr($rTest[$i],1,1)== 'z')
      {
        $mshipno = substr($rTest[$i],2,6);
      }//end elseif
    elseif (substr($rTest[$i],0,1) == '9')
      {
        $mshipno = substr($rTest[$i],7,7);
      }
    else
        $mshipno = '9999';

  //look for missing shippers.sname
    $query1 = "select shipno from shippers where shipno='$mshipno'";
    $result = $conn->query($query1);
    $row = mysql_fetch_array($result);
    
    if (empty($row))
    {
    //   $noname=$rTest[$i];             // copy this pnumber to another file
        echo "These numbers have no shipper name on file...<br>";
        echo "<br>$rTest[$i]";
    }
    
    if(isset($_COOKIE['warehouse']))
    {
        $warehouse = $_COOKIE['warehouse'];
    } else {
        $warehouse = $_SESSION['warehouse'];
    }
    
    //insert data into mysql database
    //$mvar = $rTest[$i];
    $query = "insert into packages (pnumber,snumber,preceived,wid) values ('".$rTest[$i]."','".$shipno."','".$today."','".$warehouse."')";

    $result=$conn->query($query);
    if (!$result) echo "query failed...";
    $i++;
}

$conn->close();
?>
<!--<a href="#" onClick="history.go(-1)">Back</a>-->
<input type=button value="Back" onClick="history.go(-1)">


</body>
</html>
