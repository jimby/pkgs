
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <title>F3B.php</title>
       <link type="text/css" rel="stylesheet" href="mystyle2.css">
</head>
<body>
 <?php
    //create connection
  $con = mysql_connect("localhost", "phpuser", "!phpuser");
   if (!$con)
     die('Could not connect: ' . mysql_error());

   mysql_query("SET NAMES 'utf8'");

   //open database
   if (!mysql_select_db("ship_rcv", $con))
    showerror();

    //get selection
    $shipper = $_POST['SelectShipper'];
    $data = substr($shipper,0,strpos($shipper,",")); //extract shipno from string
	$query = "select p.pnumber,p.preceived,p.invoiced,p.order_number,p.invoice_number,s.sname,w.wname
        from packages p,shippers s,warehouses w
        where p.snumber=s.shipno and p.wid=w.wid and
        DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= preceived
        and s.shipno='$data'
        order by p.preceived";
  $result = mysql_query($query);
?>
<h3>packages received in last 60 days:</h3>
<?php echo $shipper;?>
    <div class="block">
   <table border="black">
    <tr>
        <th>Shipper</th>
        <th>Date received</th>
        <th>Package number</th>
        <th>PostagePaid</th>
        <th>Warehouse</th>
        <th>OrderNo</th>
        <th>InvoiceNo</th>
    </tr>

    <?php

        while($row = mysql_fetch_array($result)) {
        $shipper = $row["sname"];
        $dueDate = $row["preceived"];
        $phpdate=strtotime($dueDate);
        $phpdate=date("m/d/Y",$phpdate);

        $desc = $row["pnumber"];
        $ppd = $row["invoiced"];
        if ($ppd){$ppd="T";}else{$ppd="F";}
        $wname = $row["wname"];
        $porder = $row["order_number"];
        $pinvoice = $row["invoice_number"];


        echo "<tr><td>". strip_tags($shipper)."</td>";
        echo "<td>" . strip_tags($phpdate,'<br><p><h1>')."</td>";
        echo "<td>".strip_tags($desc)."</td>";

        echo "<td>". strip_tags($ppd)."</td>";
        echo "<td>". strip_tags($wname)."</td>";
        echo "<td>".strip_tags($porder)."</td>";
        echo "<td>".strip_tags($pinvoice)."</td></tr>\n";

    }
    mysql_close($con);
    ?>

</table>
</div>
</body>
</html>