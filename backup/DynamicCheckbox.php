//$query="select days from plus_week where userid='smo' ";
// plus_week is table storing userid and weekdays as numbers
$query = "select invoiced from packages where preceived = $pdate

$row=mysql_fetch_object(mysql_query($query));
$days_array=split(",",$row.days);  // split = explode

//$qt=mysql_query("select * from plus_weekdays ");
// plus_weekdays is table storing weekdays as names and as numbers
$qt=mysql_query("select invoiced,pnumber from packages where preceived like $pdate ");

echo "<form method=post action=''><input type=hidden name=todo value=submit_form>";
echo "<table border='0' width='50%' cellspacing='0' cellpadding='0' align=center>";

$st="";

while($noticia=mysql_fetch_array($qt)){

	if(@$bgcolor=='#f1f1f1'){
		$bgcolor='#ffffff';
	}else{
		$bgcolor='#f1f1f1';
	}

	if(in_array($noticia['day_no'],$days_array)){
		$st="checked";
	}else{
		$st="";
	}

	echo "<tr bgcolor='$bgcolor'>
		<td class='data'><input type=checkbox name=days_array[] value='$noticia[day_no]' $st> $noticia[days]</td></tr>";

}

echo "</table>
<input type=submit value=update></form>

</center>";


