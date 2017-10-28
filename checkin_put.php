<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">
<!--checkin_put.php modification of checkin_update to accomodate many to many-->
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>checkin_update.php</title>
        <link type="text/css" rel="stylesheet" href="mystyle.css">
</head>

<body>

<?php

    $servername="localhost";
    $username  ="phpuser";
    $password  ="phpuserpw";
    $dbname    = "ship_rcv";
   $connection = mysql_connect("localhost", "phpuser", "!phpuser");
   if (!$connection)
     die('Could not connect: ' . mysql_error());

   mysql_query("SET NAMES 'utf8'");

   if (!mysql_select_db("ship_rcv", $connection))
    showerror();

//get invoice,PO numbers
   $EPminvoice=explode("\n",$_POST["invoice"]);
   $EPmorder =explode("\n",$_POST["order"]);
   $EPmnumber=explode("\n",$_POST["pkgno"]);

// insert invoices
   $i=0;
   while (!empty($EPminvoice[$i]))
       {
       $query1 = sprintf('insert ignore into invoices (inumber) values ("%s")',
               mysql_real_escape_string($EPminvoice[$i]));
       $result = mysql_query($query1);
       if (!$result)
        die('<br/> failed to insert invoices');
       //mysql_free_result($result);
       $i++;
       }
//insert orders
   $i=0;
   while (!empty($EPmorder[$i]))
       {
       $query2 = sprintf('insert ignore into orders (onumber) values ("%s")',
               mysql_real_escape_string($EPmorder[$i]));
       $result = mysql_query($query2);
       if (!$result)
        die('<br/> failed to insert orders');
       //mysql_free_result($result);
       $i++;

       }

$i=0;$j=0;
//insert into pkginv
    while (!empty($EPmnumber[$i])){
        while (!empty($EPminvoice[$j])){
            $query = sprintf("insert into pkginv (pid,iid) select p.pid,i.iid 
                from packages p, invoices i where p.pnumber='%s' and
                i.inumber='%s'",mysql_real_escape_string($EPmnumber[$i]),
                mysql_real_escape_string($EPminvoice[$j]));
            $result = mysql_query($query);
            $j++;
         }
     $i++;$j=0;
     }

$i=0;$j=0;
//insert into pkgpo
    while (!empty($EPmnumber[$i])){
        while (!empty($EPmorder[$j])){
            $query = sprintf("insert into pkgpo (pid,oid) select p.pid,o.oid
                from packages p, orders o where p.pnumber='%s' and
                o.onumber='%s'",mysql_real_escape_string($EPmnumber[$i]),
                mysql_real_escape_string($EPmorder[$j]));
            $result = mysql_query($query);
            $j++;
         }
     $i++;$j=0;
     }

    mysql_close($connection);
?>
</body>
</html>

