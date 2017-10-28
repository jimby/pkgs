<!DOCTYPE HTML PUBLIC "-//W3C/n/DTD HTML 4.01 Transitional//EN">
<!--checkin_enter.php modified checkin_get to accomodate many to many -->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>checkin_enter.php</title>
        <link type="text/css" rel="stylesheet" href="mystyle2.css">
    </head>
    <body onLoad="document.shipper.invoice.focus()">
        <div class="block">
            Checkin
        </div>
        <div class="block_center">
    <form action="checkin_put.php" method="POST" name="shipper">
        Enter invoices(s)
        <br/>
        <TEXTAREA name="invoice" rows="5" cols="30"></TEXTAREA>
       <br/>
        Enter orders
        <br/>
        <TEXTAREA name="order" rows="5" cols="30"></TEXTAREA>
        <br/>
        Scan up to (20) Packages. Reset to enter more
       <br/>
       <TEXTAREA name="pkgno" rows="12" cols="30" ></TEXTAREA>
       <br>
       <INPUT type="submit" value="Send">
       <INPUT type="reset">
    </form>
        </div>


</body>
</html>