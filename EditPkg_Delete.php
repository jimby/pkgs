<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EditPackageDelete</title>
        <link type="text/css" rel="stylesheet" href="mystyle2.css">
    </head>
    <body>
        <?php
        //get date

        //set up database connection
        if(!$connection = mysql_connect("localhost","phpuser","phpuserpw"))
            die('Could not connect: ' . mysql_error());

        // select database to use
        if (!$db_selected = mysql_select_db("ship_rcv",$connection))
            die ("Can\'t connect to the shippping-receiving database: " . mysql_error());

        //perform query
        $query="select p.pid,p.pnumber,p.preceived,s.sname from packages p, shippers s where p.snumber=s.shipno order by p.preceived desc,s.sname ";
        $result = mysql_query($query);
        if (!$result) echo "query error...";

        // build array
        $boxes = array();        //create blank array
        $i=0;
        while($row = mysql_fetch_row($result))
        {
      
            $boxes[$i]   = strip_tags($row[0]); // $pid
            $boxes[$i+1] = strip_tags($row[1]); // $pnumber
            $boxes[$i+2] = strip_tags($row[2]); // $preceived
            $boxes[$i+3] = strip_tags($row[3]); // $sname
            $i=$i+4;
        }
        $end = $i;
      
        //build form
        echo "<form action=\"editpkg_delete_go.php\" method=\"post\">\n";

        //build checkboxes
        $i=0;
        $checked = "";
        echo "<p>Packages to delete.<p>";
        echo "<table>";
        while ($i < $end) {
        
            //if ($boxes[$i+2]) {$checked="checked";} else {$checked = "";}
            echo "<tr>";
            echo "<td> <input type='checkbox' value=$boxes[$i] name=boxes[$i+1] $checked \>";
            echo "<td>{$boxes[$i+3]}<td>{$boxes[$i+1]}<td>{$boxes[$i+2]}";
            echo "<td></input></br>\n";
            echo "</tr>";
            $i += 4;
            } ;
         echo "</tr>";
        //get submit
        echo "<tr><td><input type=\"submit\" value=\"submit\" name=\"submit\" />";
        echo "</form>\n";
        
        
        // close connection
        mysql_close($connection);

        ?>
    </body>
</html>

