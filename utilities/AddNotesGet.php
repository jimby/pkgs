<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="/pkgs/mystyle.css">
    </head>
    <body>
        <?php
          //set up database connection
        if(!$connection = mysql_connect("localhost","phpuser","!phpuser"))
            die('Could not connect: ' . mysql_error());

        // select database to use
        if (!$db_selected = mysql_select_db("ship_rcv",$connection))
            die ("Can\'t connect to database: " . mysql_error());

       if (isset($_POST['subject']))
            $msubject=$_POST['subject'];
        else
           echo "post failed";
        if (isset($_POST['note']))
            $mnote=$_POST['note'];
        else
           echo "post failed";

        // construct, make query
        $query= sprintf('insert into notes (subject,note) values ("%s","%s")', mysql_real_escape_string($msubject),mysql_real_escape_string($mnote));
        $result = mysql_query($query);
        if (!$result)
            echo "query error...";
        else
            echo "database updated...";

        ?>

    </body>
</html>
