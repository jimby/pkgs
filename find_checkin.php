<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">
<!-- find checked in shipments-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <title>FindCheckedInThisMonth.php</title>
       <link type="text/css" rel="stylesheet" href="mystyle2.css">
    </head>
    <body>
   <?php
   $con = mysql_connect("localhost", "phpuser", "!phpuser");
   if (!$con)
     die('Could not connect: ' . mysql_error());

   mysql_query("SET NAMES 'utf8'");
   mysql_select_db("ship_rcv", $con);
   $month=date('m');
   $year=date('Y');
   $query2="select s.sname,p.pnumber,p.preceived,p.order_number,p.invoice_number from packages p,shippers s where p.snumber=s.shipno order by s.sname,p.preceived";
   
   $result = mysql_query($query2);
   if (!$result)
    echo "<br>query failed";

    ?>
   <br>shipments checked in this month-
   <br>
   <table border="1">
    <tr>
        <th>Shipper</th>
        <th>Date received</th>
        <th>Package number</th>
        <th>Invoice    </th>
        <th>order#     </th>
    </tr>
    <?php

        while($row = mysql_fetch_array($result)) {
        $shipper = $row["sname"];
        $desc = $row["pnumber"];
        $dueDate = $row["preceived"];
        $phpdate=strtotime($dueDate);
        $phpdate=date("m/d/Y",$phpdate);
        $invoice = $row["invoice_number"];
        $porder = $row["order_number"];
        echo "<tr><td>". strip_tags($shipper)."</td>";
        echo "<td>" . strip_tags($phpdate)."</td>";
        echo "<td>". strip_tags($desc)."</td>";
        echo "<td>". strip_tags($invoice)."</td>";
        echo "<td>". strip_tags($porder)."</td></tr>\n";
    }
    mysql_close($con);
    ?>

</table>

</body>
</html>



