<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">
<!--get checkin information -->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>checkin_get.php</title>
        <link type="text/css" rel="stylesheet" href="mystyle2.css">
    </head>
    <body onLoad="document.shipper.invoice.focus()">
    <form action="checkin_update.php" method="POST" name="shipper">
        <p> Check in packages
        <table>
       <tr>
            <td>invoice number:</td>
            <td><input size=40 name="invoice"/></td>
        </tr>
        <tr>
            <td>order number:</td>
            <td><input size=40 name="order"/></td>
        </tr>
        </table>
        <p>
       Scan up to (20) Packages. Reset to enter more
       <br><br>
       <TEXTAREA name="pkgno" rows="20" cols="30" ></TEXTAREA>
       <br>
       <INPUT type="submit" value="Send">
       <INPUT type="reset">
    </form>


</body>
</html>