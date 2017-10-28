<!--findDN_MPIGet.php install this Nov 1,2009 for use in term beginning Jan 1,2009
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>findDN_MPIGet.php</title>
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
        //get date

        //set up database connection
        if(!$connection = mysql_connect("localhost","phpuser","!phpuser"))
            die('Could not connect: ' . mysql_error());

        // select database to use
        if (!$db_selected = mysql_select_db("ship_rcv",$connection))
            die ("Can\'t connect to the shippping-receiving database: " . mysql_error());
        
        if (!empty($_POST['pdate'])){
            $mdate=$_POST['pdate'];
            //New query follows
            $Query= "select s.sname,p.pnumber,p.preceived,p.invoiced, i.inumber,o.onumber,w.wname
 				from shippers s,packages p,invoices i, orders o,pkgpo po,pkginv pi,warehouses w
 				where p.wid=w.wid and p.pid=po.pid and po.oid = o.oid and p.pid = pi.pid and  pi.iid = i.iid 
    			and p.snumber=s.shipno
    			and p.preceived like '%mdate%'
    			order by p.preceived desc,s.sname";
    // new query ends
    
	// old date query starts here
            $query = "select p.pnumber,p.preceived,p.invoiced,p.order_number,p.invoice_number,s.sname,w.wname
                from packages p,shippers s,warehouses w
                where p.snumber=s.shipno and p.wid=w.wid and p.preceived like '%$mdate%'
                order by p.preceived desc,s.sname";
    // old date query ends here             
        }
        if (!empty($_POST['pnumber'])){
            $mnumber=$_POST['pnumber'];
    //New number query follows
            $Query= "select s.sname,p.pnumber,p.preceived,p.invoiced, i.inumber,o.onumber,w.wname
 				from shippers s,packages p,invoices i, orders o,pkgpo po,pkginv pi,warehouses w
 				where p.wid=w.wid and p.pid=po.pid and po.oid = o.oid and p.pid = pi.pid and  pi.iid = i.iid 
    			and p.snumber=s.shipno
    			and p.pnumber like '%mnumber%'
    			order by p.preceived desc,s.sname";
    // new number query ends here
    // old number query starts here
                    $query = "select p.pnumber,p.preceived,p.invoiced,p.order_number,p.invoice_number,s.sname,w.wname
                from packages p,shippers s,warehouses w
                where p.snumber=s.shipno and p.wid=w.wid and p.pnumber like '%$mnumber%'
                order by p.preceived desc,s.sname";
    // old number query ends here
        }
        //else return
            
   $result = mysql_query($query);
    if (!$result)
        echo "query failed<br>";
    ?>

    Packages received to date:
    <div class="block">
    <br>
    <table class="stripeMe">
    <tr>

        <th>Date received</th>
        <th>Shipper</th>
        <th>Package number</th>
        <th>PostagePaid</th>
        <th>Warehouse</th>
        <th>OrderNo</th>
        <th>InvoiceNo</th>
    </tr>

    <?php
        //$result = mysql_query("SELECT * FROM wishes WHERE wisher_id=". $wisherID);
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

        echo "<tr><td>".strip_tags($phpdate,'<br><p><h1>') ."</td>";
        echo "<td>" .strip_tags($shipper)."</td>";
        echo "<td>".strip_tags($desc)."</td>";

        echo "<td>". strip_tags($ppd)."</td>";
        echo "<td>". strip_tags($wname)."</td>";
        echo "<td>".strip_tags($porder)."</td>";
        echo "<td>".strip_tags($pinvoice)."</td></tr>\n";

    }
    mysql_close($connection);
    ?>

</table>
</div>
</body>
</html>