<html>
<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">
<!-- find packages received today-->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <title>Todays packages.php</title>
      <link type="text/css" rel="stylesheet" href="mystyle2.css">
      <script type="text/javascript" src="jquery.js"></script> 
      <script type="text/javascript">
		   $(document).ready(function(){
        $(".stripeMe tr").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});
        $(".stripeMe tr:nth-child(even)").addClass("alt");
     });
     </script>

      
    </head>
    <body>
   <?php
   $con = mysql_connect("localhost", "phpuser", "!phpuser");
   if (!$con)
     die('Could not connect: ' . mysql_error());

   mysql_query("SET NAMES 'utf8'");
   mysql_select_db("ship_rcv", $con);
//   $day=date('d');
//   $month=date('m');
//   $year=date('Y');
   echo "packages received today-";
   
  //$newQuery = "select s.sname, p.pnumber,p.preceived,p.invoiced,w.wname
  // from packages p,shippers s,warehouses w
  // where p.wid=w.wid and p.snumber=s.shipno and month(preceived)=month(now())
  // and year(preceived)=year(now()) and dayofmonth(preceived)=day(now())";
  //
  // edited new query 02/12/10
$newQuery="select shippers.sname, packages.pnumber,packages.preceived,packages.invoiced,warehouses.wname,orders.onumber,invoices.inumber
   from packages
   left outer join shippers on packages.snumber=shippers.shipno
   left outer join warehouses on packages.wid=warehouses.wid
   left outer join pkgpo on packages.pid=pkgpo.pid
   left outer join orders on pkgpo.oid=orders.oid
   left outer join pkginv on packages.pid = pkginv.pid
   left outer join invoices on pkginv.iid=invoices.iid
   where month(packages.preceived)=month(now()) and year(packages.preceived)=year(now()) and dayofmonth(packages.preceived)=day(now())";
   $result = mysql_query($newQuery);
   if (!$result)
    echo "database query failed..";
   
    ?>
   <div class="block">
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
    mysql_close($con);
    ?>

</table>
</div>
</body>
</html>



