<!--clearinv.php-->
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <title>ClearInv.php </title>
        <link type="text/css" rel="stylesheet" href="mystyle.css">
    </head>
<body onLoad="document.clearinv.pdate.focus()">


	<!-- get date received from user-->
	<form action="findByMonthAndYearGet.php" method=post name="FindMonthAndYear">
    <br/> Enter month
    (use Month format: "99"):
    <p>
	<input type="text" name="month" size="20"/>
        <br>
    <br/>Enter year:
    (use format: "9999"):
    <p/>
    <input type="text" name="year" size="20"/>
        <br>    
	<input type="submit" value="submit"/>
	<br>
    <input type="reset"  value="reset"/>
	</form>
        
</body>
</html>
