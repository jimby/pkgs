<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">

<? $realm = 'Restricted area';?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <title>index</title>
      <link type="text/css" rel="stylesheet" href="mystyle.css">
      <!-- <link rel="stylesheet" href="mystyle.css">-->
      </head>
    <body onload="document.scan1.scan2.focus()">
        
    <h2>Package tracking</h2>
	<ul class="navbar">
        <li><a href="FindPackages.php/">Reports </a>
        <li><a href="shipper_get.php">Add Shippers</a>
        <li><a href="checkin_get.php/">Check in shipments</a>
        <li><a href="clearinv.php/">Clear shipping invoices</a>
        <!--<li><a href="phpinfo.php/">phpinfo</a>-->
    </ul>
    <DIV class="block">
       <FORM action="scanpkg.php" method="post" name="scan1">
                  Scan Packages:
                   <br>
                   <TEXTAREA name="scan2" rows="25" cols="40"></TEXTAREA>
                   <br>
                   <INPUT type="submit" value="Send">
                   <INPUT type="reset">
       </FORM>
    </DIV>

    </body>
</html>

