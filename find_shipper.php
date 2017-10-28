<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Find_shipper.php</title>
	  <SCRIPT language="JavaScript">
        function submitform()
        {
             document.myform.submit();
        }
    </SCRIPT>
       <link type="text/css" rel="stylesheet" href="mystyle.css">
</head>
<body>
    <h3> Find packages by shipper</h3>
<?php
function selectDistinct ($connection,$tableName,$columnName1,$columnName2,$columnName3,$pulldownName,$additionalOption,$defaultValue)
{
	$defaultWithinResultSet = FALSE;


	if (!($result = mysql_query ("select sname,slocation,shipno from shippers order by sname")))
		echo "<p> ...$resultID...query didn't execute";


	$i=0;

        while($row = mysql_fetch_array($result))
        {
		$resultBuffer[$i++]=$row[$columnName1].",".$row[$columnName2].",     ".$row[$columnName3];
        }


        echo "<br><select size='25' name=\"$pulldownName\" onchange='this.form.submit()'>";


	if (isset ($additionalOption))
        {	if ($defaultValue == $additionalOption)
			echo "<p><option selected>$additionalOption";
		else
			echo "<p><option>$additionalOption";
        }
	if (isset($defaultValue))
	{
		foreach ($resultBuffer as $result)
			if ($result == $defaultValue)
				echo "<br><option selected>$result";
			else
				echo "<br><option>$result";
	}
	else
	{
		foreach ($resultBuffer as $result)
			echo "<br><option>$result";
	}
	echo '</select>';
}// end function
$hostname = "localhost";
$username = "phpuser";
$password = "!phpuser";
$databasename="ship_rcv";
$tablename="shippers";
$columnName1="shipno";
$columnName2="sname";
$columnName3="slocation";
$pulldownName= "SelectShipper";
$Query = "SELECT DISTINCT $columnName1 FROM $tablename";
if (!($connection = @mysql_connect($hostname,$username,$password)))
    {
    echo "<br>not connected to database server!";
    }
if (!(mysql_select_db($databasename,$connection)))
    echo "<br> can't find database";

?>
<FORM action="find_shipper_show.php" method="post">
<?php
selectDistinct($connection,$tablename,$columnName1,$columnName2,$columnName3,$pulldownName,'All','All');
?>
 <input type = 'submit'>
 </FORM>

</body></html>

