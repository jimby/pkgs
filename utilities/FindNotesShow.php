<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
                <link type="text/css" rel="stylesheet" href="/pkgs/mystyle2.css">

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
    if (isset($_POST['SelectNote'])){
    $note = $_POST['SelectNote'];
    $mdata = substr($note,0,strpos($note,",")); //extract nid from string
    }
        $query = sprintf('select n.date,n.subject,n.note
        from notes n
        where n.nid=%s',mysql_real_escape_string($mdata));
    $result = mysql_query($query);
    //display result

   



        while($row = mysql_fetch_array($result)) {
        $mdate    = $row["date"];
        $msubject = $row["subject"];
        $mnote    = $row["note"];?>

        <p><h2> Edit notes </h2>
    
        <?php echo "<br>Date/time: $mdate";
        echo "<br>Subject:  $msubject<br>";?>

        <form action="/pkgs/utilities/FindNotesShowPut.php" name="notes" method="post">
            <?php echo "<input type=\"hidden\" name=\"msid\" value= $mdata  />";?>
            <TEXTAREA NAME="comments" COLS=110 ROWS=20><?php echo $mnote;?></TEXTAREA>
            <P><input type = 'submit' value="Update">
        </form>
    <!--<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">-->
<?php } mysql_close($con); ?>
   
   </body>
</html>
