
<!--findDN_MPI.php install this Nov 1,2009 for use in term beginning Jan 1,2009
-->
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <title>findDN_MPI.php </title>
        <link type="text/css" rel="stylesheet" href="mystyle.css">
    </head>
<body onLoad="document.clearinv.pdate.focus()">


	<!-- get date received from user-->
	<form action="findDN_MPIGet.php" method=post name="FindDateOrNumber">
    <br/> Enter date
    (use date format: "YYYY-MM-DD"):
    <p>
	<input type="text" name="pdate" size="20"/>
        <br>
    <br/>Enter Number:
    <p/>
    <input type="text" name="pnumber" size="20"/>
        <br>    
	<input type="submit" value="submit"/>
    <input type="reset"  value="reset"/>
	</form>
        
</body>
</html>
