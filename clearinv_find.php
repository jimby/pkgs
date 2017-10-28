<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Find</title>
        <link type="text/css" rel="stylesheet" href="mystyle.css">
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
        if (isset($_POST['pdate']))
            $mdate=$_POST['pdate'];
        else
           echo "date not posted";

        //perform query
        $query1="select p.pid,p.pnumber,p.invoiced,s.sname from packages p, shippers s where p.snumber=s.shipno and p.preceived like '%$mdate%'";
        $query= "SELECT p.pid,p.pnumber,p.invoiced FROM packages p where p.preceived like '%$mdate%'";
        $result = mysql_query($query);
        if (!$result) echo "query error...";

        // build array
        $boxes = array();        //create blank array
        $i=0;
        while($row = mysql_fetch_row($result))
        {
      
            $boxes[$i]   = strip_tags($row[0]); // $pid
            $boxes[$i+1] = strip_tags($row[1]); // $pnumber
            $boxes[$i+2] = strip_tags($row[2]); // $pinvoiced
            $boxes[$i+3] = strip_tags($row[3]);
            $i=$i+4;
        }
        $end = $i;
      

        //build form
        echo "<form action=\"clearinv_update.php\" method=\"post\">\n";

        //build checkboxes
        $i=0;
        $checked = "";
        echo "<p>Packages were received $mdate.<p>";
        while ($i < $end) {
        
            if ($boxes[$i+2]) {$checked="checked";} else {$checked = "";}
            echo " <input type='checkbox' value=$boxes[$i] name=boxes[$i+1] $checked \>   {$boxes[$i+1]} <!--*{$boxes[$i+3]}*/-->   </input></br>\n";
            $i += 4;
            } ;
        //get submit
        echo "<input type=\"submit\" value=\"submit\" name=\"submit\" />\n";
        echo "</form>\n";
        
        
        // close connection
        mysql_close($connection);

        ?>
    </body>
</html>
