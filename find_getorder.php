<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>find_getorder.php</title>
        <link type="text/css" rel="stylesheet" href="mystyle2.css">
        <script src="jquery.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
        $(".stripeMe tr").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});
        $(".stripeMe tr:nth-child(even)").addClass("alt");
     });
 </script>
</head>

<body>

<?php
   $connection = mysql_connect("localhost", "phpuser", "!phpuser");
   if (!$connection)
     die('Could not connect: ' . mysql_error());

   mysql_query("SET NAMES 'utf8'");

// use sr database
   if (!mysql_select_db("ship_rcv", $connection))
     echo "Could not find database";

//getPO numbers
   $morders =$_POST["order"];
   echo "<br>order:$morders";
//construct,execute query
   $morders = mysql_real_escape_string($morders);
   $morders = "%".$morders."%";
   echo "<br>orders:$morders";
$query= sprintf('select shippers.sname, packages.pnumber,packages.preceived,packages.invoiced,warehouses.wname,orders.onumber,invoices.inumber
   from packages
   left outer join shippers on packages.snumber=shippers.shipno
   left outer join warehouses on packages.wid=warehouses.wid
   left outer join pkgpo on packages.pid=pkgpo.pid
   left outer join orders on pkgpo.oid=orders.oid
   left outer join pkginv on packages.pid = pkginv.pid
   left outer join invoices on pkginv.iid=invoices.iid
   where orders.onumber like "%s"',$morders);
   $result= mysql_query($query);
   if (!$result)
        echo "query failed<br>";
?>
   <div class="block"/>
   <br>
   <table class="stripeMe">
    <tr>
        <th>Shipper</th>
        <th>Date received</th>
        <th>Package number</th>
        <th>PostagePaid</th>
        <th>Warehouse</th>
        <th>Order#</th>
        <th>Invoice#</th>
        
    </tr>
        
    <?php

        while($row = mysql_fetch_array($result)) {
        $shipper = $row["sname"];
        $dueDate = $row["preceived"];
        $phpdate=strtotime($dueDate);
        $phpdate=date("m/d/Y",$phpdate);
        $morder=$row["onumber"];
        $minvoice=$row["inumber"];

        $desc = $row["pnumber"];
        $ppd = $row["invoiced"];
        $mwarehouse = $row["wname"];
        if ($ppd){$ppd="T";}else{$ppd="F";}


        echo "<tr><td>". strip_tags($shipper)."</td>";
        echo "<td>" . strip_tags($phpdate,'<br><p><h1>')."</td>";
        echo "<td>".strip_tags($desc)."</td>";
        
        echo "<td>". strip_tags($ppd)."</td>";
        echo "<td>".strip_tags($mwarehouse)."</td>";
        echo "<td>".strip_tags($morder)."</td>";
        echo "<td>".strip_tags($minvoice)."</td>";
        echo"</tr>";

    }


    mysql_close($connection);
?>
</table>
</body>
</html>

