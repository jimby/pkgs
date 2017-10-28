<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">
<!-- find packages received in lst 30d-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <title>packages received in last 30 days </title>
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
    $user = "phpuser";
    $pass = "phpuserpw";
    $dbName = "ship_rcv";
    $dbHost = "localhost";
    $conn = null;

    $conn = new mysqli($dbHost, $user, $pass, $dbName);
    
    if (!$conn)
        die('Could not connect: ' . mysql_error());

    //mysql_query("SET NAMES 'utf8'");
   //mysql_select_db("ship_rcv", $con);
    
    $month=date('m');
    $year=date('Y');

    /**$query="select shippers.sname, packages.pnumber,packages.preceived,packages.invoiced,warehouses.wname,orders.onumber,invoices.inumber
    from packages
    left outer join shippers on packages.snumber=shippers.shipno
    left outer join warehouses on packages.wid=warehouses.wid
    left outer join pkgpo on packages.pid=pkgpo.pid
    left outer join orders on pkgpo.oid=orders.oid
    left outer join pkginv on packages.pid = pkginv.pid
    left outer join invoices on pkginv.iid=invoices.iid
    where DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= packages.preceived
    order by packages.preceived";
    **/
    $query="select s.sname, s.slocation, p.pnumber, p.preceived from packages p, shippers s where DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= p.preceived and p.snumber=s.shipno";
    
    $result = $conn->query($query);
    
    if (!$result)
    {
        echo "query failed<br>";
    }
?>

    <div class="block">
    <br>
    <table class="stripeMe">
    <tr>
        <th>Received</th>
        <th>Shipper</th>
        <th>Location</th>
        <th>Package#</th>
        
    </tr>
        
    <?php
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
        
            $shipper = $row["sname"];
            $slocation= $row["slocation"];
            $desc=$row["pnumber"];
            $dueDate = $row["preceived"];
            $phpdate=strtotime($dueDate);
            $phpdate=date("m/d/Y",$phpdate);
            //$desc = $row["pnumber"];
            $ppd = $row["invoiced"];
        
            //if ($ppd)
            //{
            //    $ppd="T";
            //}
            //else
            //{
            //    $ppd="F";   
            //}
            
            //$wname = $row["wname"];
            //$morder=$row["onumber"];
            //$minvoice=$row["inumber"];
        
            echo "<tr>";
            echo "<td>" .strip_tags($phpdate,'<br><p><h1>')."</td>";
            echo "<td>".strip_tags($shipper)."</td>";
            echo "<td>".strip_tags($slocation)."</td>";
            echo "<td>".strip_tags($desc)."</td>";
            
            
            //echo "<td>".strip_tags($ppd)."</td>";
            //echo "<td>".strip_tags($wname)."</td>";
            //echo "<td>".strip_tags($morder)."</td>";
            //echo "<td>".strip_tags($minvoice)."</td>";        
            echo "</tr>";
        }

    }
    mysql_close($con);
    ?>

</table>
</div>
</body>
</html>


