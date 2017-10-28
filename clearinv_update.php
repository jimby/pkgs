
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Update</title>
        <link type="text/css" rel="stylesheet" href="mystyle.css">
    </head>
    <body>
        <?php
        if (!$connection = mysql_connect("localhost","phpuser","!phpuser"))
            die('Could not connect: ' . mysql_error());

        if (!$db_selected= mysql_select_db("ship_rcv",$connection))
            die ("Can\t connect to shipping-receiving database: " . mysql_error());

        
        // construct working arry
        $boxes = array();
        if (isset($_POST['boxes']))
            {
                $moxes = $_POST['boxes'];
            }else {
                echo "value not posted";
            }
//update
        echo "Updating database<br>";
        foreach($moxes as $mox)
        {
         $query="update packages set invoiced = 1 where pid=$mox";
                if (!$result=mysql_query($query))
                    echo "<br> update failed";
        }
        mysql_close($connection);
        ?>
        <input type=button value="Back" onClick="history.go(-2)">
    </body>
</html>
