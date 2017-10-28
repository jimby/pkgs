<!--clearinv.php-->
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <title>ClearInv.php </title>
        <link type="text/css" rel="stylesheet" href="mystyle.css">
    </head>
<body onLoad="document.clearinv.pdate.focus()">


	<!-- get date received from user-->
	<form action="clearinv_find.php" method=post name="clearinv">
	Type date received of package
    <br>
    (use date format: "YYYY-MM-DD"):
    <p>
	<input type="text" name="pdate" size="20"/>
        <br>
	<input type="submit" value="submit"/>
    <input type="reset"  value="reset"/>
	</form>
        
</body>
</html>
