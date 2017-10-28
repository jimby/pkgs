<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">
<!--CommentFindPkg.php -->
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CommentFindPkg.php</title>
        <link type="text/css" rel="stylesheet" href="mystyle.css">
</head>

<body>

<?php
   $connection = mysql_connect("localhost", "phpuser", "!phpuser");
   if (!$connection)
     die('Could not connect: ' . mysql_error());

   mysql_query("SET NAMES 'utf8'");

   if (!mysql_select_db("ship_rcv", $connection))
    showerror();

//get invoice,PO numbers
   $mnumber=$_POST["mscan"];
   $ms="%";
   $mcomment=$_POST["mcom"];
   $mnumber= $ms.$mnumber.$ms;
   echo "<br/>Updating packages table";
//   echo $mnumber;
// find pkg number
       $query1 = sprintf('update packages set comments = "%s" where pnumber like "%s"',
               mysql_real_escape_string($mcomment),mysql_real_escape_string($mnumber));
       $result = mysql_query($query1);
       if (!$result)
        die('<br/> failed update packages table');
       //mysql_free_result($result);

    mysql_close($connection);
?>
</body>
</html>

