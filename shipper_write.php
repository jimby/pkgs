<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <title>s2.php</title>
       <link type="text/css" rel="stylesheet" href="mystyle.css">
</head>

<body>

   <?php
   $servername= "localhost";
   $username  = "phpuser";
   $password  = "phpuserpw";
   $dbname    = "ship_rcv";
   
   $mnumber=$_POST["snumber"];
   $mlocation=$_POST["scity"];
   $mname =$_POST["sname"];
   $conn = new mysqli($servername, $username, $password, $dbname);
   //$connection = mysql_connect("localhost", "phpuser", "phpuserpw");
   if ($conn->connect_error)
    {
     die("Database connection failed: " . $conn->connect_error);
    }
 //  mysql_query("SET NAMES 'utf8'");

//   if (!mysql_select_db("ship_rcv", $connection))
//    showerror();

    if (substr($mnumber,1,1)== "Z")         //ups
       $mshipno = substr($mnumber,2,6);
    elseif (substr($mnumber,1,1)== "z")     //ups
        $mshipno = substr($mnumber,2,6);
    elseif (substr($mnumber,0,1)== "9")    //fedex ground
        $mshipno = substr($mnumber,7,7);
    elseif (substr($mnumber,0,1) == "3")    //Fedex air
        $mshipno = substr($mnumber,17,4);
    else
        $mshipno= "00000000";               //unknown

$sql = "INSERT INTO shippers (shipno,slocation,sname) VALUES ('".$mshipno."','".$mlocation."','".$mname."')";

if ($conn->query($sql) === TRUE)
{
    echo "new record created";
}
else
{
    echo "error: " . $sql ."<br>" . $conn->error;
}


$conn->close();

echo "<meta http-equiv=\"REFRESH\" content=\"0;url=http:shipper_get.php\">";
?>

</body>
</html>
