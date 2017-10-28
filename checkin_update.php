<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">
<!--checkin_update.php -->
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>checkin_update.php</title>
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
   $minvoice=$_POST["invoice"];
   $morder =$_POST["order"];

//get pnumbers entered in checkin_get.php
   //$pnumber =$_POST["pkgno"];

// an array of package numbers
   //$EPnumber=explode("\n",$pnumber);
// try this
    $EPnumber=explode("\n",$_POST["pkgno"]);

   $i=0;
   while (!empty($EPnumber[$i]))
    {
        $query  = sprintf('select pid FROM packages WHERE pnumber LIKE "%s"', mysql_real_escape_string($EPnumber[$i]));
        $result = mysql_query($query);

        if (!$result)
            die ('<br />First  query failed ' . mysql_error());
        else
         $row=mysql_fetch_array($result);

        $mpid=$row[0];
        if (!empty($mpid))
            echo "pid $mpid <br />";
        else
            echo "$EPnumber[$i] package not found <br />";
         mysql_free_result($result);
        $query2 = sprintf('update packages set order_number="%s",invoice_number="%s" where pid= "%s"',mysql_real_escape_string($morder),mysql_real_escape_string($minvoice),mysql_real_escape_string($mpid));
        $result=mysql_query($query2);
        if (! $result)
            echo "Second query failed<br />";
        $i++;
    }

    mysql_close($connection);
?>
</body>
</html>

