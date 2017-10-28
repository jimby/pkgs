<!--ware_find.php-->
<?php
session_start();
 require_once "../Includes/db.php";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
<?php
 function selectDistinct ($conn,$tableName,$columnName1,$columnName2,$pulldownName)
{
	$defaultWithinResultSet = FALSE;
        $sql="select $columnName1,$columnName2 from $tableName order by $columnName1";
	if (!($result = $conn->query ($sql)))
        {
		echo "<p> query didn't execute,got dim it";
        }

	$i=0;

    while($row = $result->fetch_assoc())
        {
		$resultBuffer[$i++]=$row[$columnName1].",".$row[$columnName2];
        }


       echo " <br><select name='$pulldownName'>";


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
$password = "phpuserpw";
$dbname="ship_rcv";
$tablename="warehouses";
$columnName2="wid";
/*$columnName2="wlocation";*/
$columnName1="wname";
$pulldownName= "SelectWarehouse";
$Query = "SELECT DISTINCT $columnName1 FROM $tablename";
if (!($conn = new mysqli($hostname,$username,$password,$dbname)))
	{
    echo "<br>not connected to database server!";
	}
//if (!(mysql_select_db($databasename,$conn)))    //<<---update this
//    echo "<br> can't find database";
?>
 <FORM action="ware_find_get.php"  method="post">
    Choose warehouse
<?php
selectDistinct($conn,$tablename,$columnName1,$columnName2,$pulldownName,'All','All');
?>
    <input type = 'submit'><br>
<input type=button value="Back" onClick="history.go(-1)">
</FORM>
</body>
</html>
