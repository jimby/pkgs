<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
		<SCRIPT language="JavaScript">
        function submitform()
        {
             document.myform.submit();
        }
    </SCRIPT>
        <link type="text/css" rel="stylesheet" href="/pkgs/mystyle.css">

    </head>
    <body>
        <?php
        $hostname = "localhost";
        $username = "phpuser";
        $password = "!phpuser";
        $databasename="ship_rcv";
        $tablename="notes";
        $columnName1="nid";
        $columnName2="date";
        $columnName3="subject";
        $columnName4="note";
        $pulldownName= "SelectNote";

    function selectDistinct ($connection,$tableName,$columnName1,$columnName2,$columnName3,$pulldownName)
        {
        $defaultWithinResultSet = FALSE;
        $query= sprintf('select %s,%s,%s from %s order by %s', mysql_real_escape_string($columnName1),mysql_real_escape_string($columnName2),
            mysql_real_escape_string($columnName3),mysql_real_escape_string($tableName),mysql_real_escape_string($columnName3));
           
        $result = mysql_query($query);
        if (!($result))
        	echo "<p> query didn't execute";

    	$i=0;

        while($row = mysql_fetch_array($result))
        {
		$resultBuffer[$i++]=$row[$columnName1].",".$row[$columnName2].",".$row[$columnName3];
        }


        echo "<br><select size=\"5\" name=\"$pulldownName\" onchange='this.form.submit()'>";


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
        }


//$Query = "SELECT DISTINCT $columnName1,$columnName3 FROM $tablename";
if (!($connection = @mysql_connect($hostname,$username,$password)))
    {
    echo "<br>not connected database server!";
    }

if (!mysql_select_db($databasename,$connection))
    echo "<br> can't find database";
    echo "<br> select a note to edit";
?>
<FORM action="/pkgs/utilities/FindNotesShow.php" method="post">
<?php
selectDistinct($connection,$tablename,$columnName1,$columnName2,$columnName3,$pulldownName);
?>
    <p><input type = 'submit' value="Select" >
    <input type="button" name="B2" value="Return" onclick="history.go -1">
 </FORM>
    </body>
</html>
