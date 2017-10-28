<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">
<!--get shipper information -->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <title>shipper_get.php</title>
       <link type="text/css" rel="stylesheet" href="mystyle.css">
    </head>

    <body onLoad="document.shipper.sname.focus()">
    <form action="shipper_write.php" method="POST" name="shipper">
        <table>
            <tr>
                <td>shipper name:</td>
                <td><input type="text" size=40 name="sname" /></td>
            </tr>
            <tr>
                <td>shipper location:</td>
                <td><input type="text" size=40 name="scity" /></td>
            </tr>
            <tr>
                <td>scan package:</td>
                <td><input type="text" size=30 name="snumber" /></td>
            </tr>
        </table>
        <p>
       <input type = "submit"/>
       <input type="reset"  value="reset"/>
     
    </form>


</body>
</html>