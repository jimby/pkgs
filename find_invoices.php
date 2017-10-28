<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>find vendors invoices</title>
         <link type="text/css" rel="stylesheet" href="mystyle2.css">
    </head>
    <body onLoad="document.shipper.invoices.focus()">
        <form action="find_getinvoices.php" method="POST" name="shipper">

       invoice number:     <input size=40 name="invoices"/><br/>
       <INPUT type="submit" value="Send">
       <INPUT type="reset">
       </form>
    </body>
</html>
