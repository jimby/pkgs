
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Package Tracking</title>
<script type="text/javascript" src="dropdowntabs.js">

/***********************************************
* Drop Down Tabs Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>
 
<!-- CSS for Drop Down Tabs Menu #1 -->
<link rel="stylesheet" type="text/css" href="ddcolortabs.css" />
</head>
<body onload="document.scan1.scan2.focus()">

<div id="colortab" class="ddcolortabs">
<ul>
<li><a href="shipper_get.php"  title="Shippers"  rel="dropmenu5_a"><span>Add Shippers</span></a></li>
<li><a href="checkin_enter.php"  title="Check-in"  rel="dropmenu3_a"><span>Checkin</span></a></li>
<li><a href="FindPackages.php" title="Reports"   rel="dropmenu1_a"><span>Reports</span></a></li>
<li><a href="clearinv.php"     title="Invoices"  rel="dropmenu2_a"><span>Clear invoices</span></a></li>
<li><a href="utilities.php"    title="Utilities" rel="dropmenu4_a"><span>Utilities</span></a></li>
</ul>
</div>

<div class="ddcolortabsline">&nbsp;</div>
<!--5th drop down menu -->
<div id="dropmenu5_a" class="dropmenudiv_a" style="width: 100px;">
<!--<a href="http://www.dynamicdrive.com/style/csslibrary/category/C1/">Horizontal CSS Menus</a>
<a href="http://www.dynamicdrive.com/style/csslibrary/category/C2/">Vertical CSS Menus</a>
<a href="http://www.dynamicdrive.com/style/csslibrary/category/C4/">Image CSS</a>-->
<a href="shipper_get.php">Add Shippers</a>
</div>

<!--4th drop down menu -->
<div id="dropmenu4_a" class="dropmenudiv_a" style="width: 100px;">
<!--<a href="http://www.dynamicdrive.com/style/csslibrary/category/C1/">Horizontal CSS Menus</a>
<a href="http://www.dynamicdrive.com/style/csslibrary/category/C2/">Vertical CSS Menus</a>
<a href="http://www.dynamicdrive.com/style/csslibrary/category/C4/">Image CSS</a>-->
<a href="utilities.php">Utilities menu</a>
</div>

<!--1st drop down menu -->
<div id="dropmenu1_a" class="dropmenudiv_a" style="width: 225px;">
<!--<a href="http://www.dynamicdrive.com/style/csslibrary/category/C1/">Horizontal CSS Menus</a>
<a href="http://www.dynamicdrive.com/style/csslibrary/category/C2/">Vertical CSS Menus</a>
<a href="http://www.dynamicdrive.com/style/csslibrary/category/C4/">Image CSS</a>-->
<a href="find_invoices.php">Find invoices</a>
<a href="find_order.php">Find orders</a>
<a href="find_30days.php">Find packages in past 30 days</a>
<a href="find_today.php">Find packages today</a>
<a href="find_shipper.php">Find packages by shipper</a>
<a href="findByMonthAndYear.php"> Find by Month,Year</a>
<a href="findDN_MPI.php"> Find by date or number</a>
</div>


<!--2nd drop down menu -->
<div id="dropmenu2_a" class="dropmenudiv_a" style="width: 150px;">
<a href="clearinv.php">clear shipping invoices</a>
<!--<a href="http://www.javascriptkit.com">JavaScript Kit</a>
<a href="http://www.codingforums.com">Coding Forums</a>
<a href="http://www.javascriptkit.com/jsref/">JavaScript Reference</a>-->
</div>

<!--3d drop down menu -->
<div id="dropmenu3_a" class="dropmenudiv_a" style="width: 125px;">
<a href="checkin_enter.php">check in shipments</a>
<!--<a href="http://www.javascriptkit.com">JavaScript Kit</a>
<a href="http://www.codingforums.com">Coding Forums</a>
<a href="http://www.javascriptkit.com/jsref/">JavaScript Reference</a>-->
</div>

<script type="text/javascript">
//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
tabdropdown.init("colortab", 2)
</script>
<div id="scan">
       <form action="pkgno/PkgScan.php" method="post" name="scan1">
                   <br></br>
                    <?php
                    echo 'Date received (YYYY-MM-DD): <input type ="text" name= "mdate" value=""';
                    ?>
<br></br>
                   Scan Packages:
                   <br></br>
                   <textarea name="scan2" rows="20" cols="40"></textarea>
                   <br></br>
                   <input type="submit" value="Send"/>
                   <button type="reset" value="reset">Clear </button>
                   <input type=button value="Back" onClick="history.go(-1)">
       </form>
    </div>
</body>

</html>



