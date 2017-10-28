<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="/pkgs/mystyle.css">

    </head>
    <body>
<?php

// check submitted values
        $hostname = "localhost";
        $username = "phpuser";
        $password = "!phpuser";
        $databasename="ship_rcv";
        $tablename="notes";
        $columnName1="nid";
        $columnName2="date";
        $columnName3="subject";
        $columnName4="note";


   if (!$connection = @mysql_connect($hostname,$username,$password))
    {
    echo "<br>not connected database server!";
    }

    if (!mysql_select_db($databasename,$connection))
     echo "<br> can't find database";

    if (isset($_POST['msid'])) {
   
      $Newmsid = $_POST['msid'];
     }
    else {echo "no $Newmsid";}

    if (isset($_POST['comments'])){
      $Newmcomments=trim($_POST['comments']);
      }

$query= sprintf("update notes set note='%s' where nid ='%s'",mysql_real_escape_string($Newmcomments),mysql_real_escape_string($Newmsid));

//echo $query;
    $result= mysql_query($query);
    if (!$result)
        echo "<br> query failed";
    else
        echo "<br> table updated...";
     mysql_close($connection);
echo "<p><input type=\"button\" name=\"B2\" value=\"Return\" onclick=\"history.go(-2)\">";
?>
   </body>
</html>
