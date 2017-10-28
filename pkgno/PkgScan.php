<!--PkgScan.php -->
<?php
session_start();
require_once "../Includes/db.php";

?>
<!DOCTYPE HTML>

<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <title>Scan Packages</title>
         <link type="text/css" rel="stylesheet" href="mystyle.css">
    </head>
             <style>
	.modalDialog {
		position: fixed;
		font-family: Arial, Helvetica, sans-serif;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0,0,0,0.7);
		z-index: 99999;
		opacity:0;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		pointer-events: none;
	}

	.modalDialog:target {
		opacity:1;
		pointer-events: auto;
	}

	.modalDialog > div {
		width: 400px;
		position: relative;
		margin: 10% auto;
		padding: 5px 20px 13px 20px;
		border-radius: 10px;
		background: #fff;
		background: -moz-linear-gradient(#fff, #999);
		background: -webkit-linear-gradient(#fff, #999);
		background: -o-linear-gradient(#fff, #999);
	}

	.close {
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		position: absolute;
		right: -12px;
		text-align: center;
		top: -10px;
		width: 24px;
		text-decoration: none;
		font-weight: bold;
		-webkit-border-radius: 12px;
		-moz-border-radius: 12px;
		border-radius: 12px;
		-moz-box-shadow: 1px 1px 3px #000;
		-webkit-box-shadow: 1px 1px 3px #000;
		box-shadow: 1px 1px 3px #000;
	}

	.close:hover { background: #00d9ff; }
	</style>

<body>


<?php

    // date set to menu.php value
    $today = filter_input(INPUT_POST,'mdate', FILTER_SANITIZE_SPECIAL_CHARS);   
    if (empty($today))
    {
    $today = date('Y-m-d');                                // <-- filter this
    }

    $mText=filter_input(INPUT_POST,'scan2', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($mText))
    { 
    echo "no package numbers posted";
    }
//split up scanned array into individual elements

    $rTest = explode("&#13;&#10;",$mText); //<< try this instead
    $i=0;


//loop
    $t=substr($rTest[$i],0,1);
    while (!empty($rTest[$i]))
    {
        if(isset($_SESSION['warehouse']))
        {
            $warehouse = $_SESSION['warehouse'];
        }
        
        if(isset($_SESSION['wid']))
        {
            $wid = $_SESSION['wid'];
        }

        $pnumber = $rTest[$i];      //package number
        $preceived   = $today;      // received date
        $wid     = intval($wid);
 
//find shipper's number as a substring of tracking number
        if (substr($rTest[$i],1,1)== 'Z')
        {
            $shipno = substr($rTest[$i],2,6);
        }//endif
        
        if (substr($rTest[$i],1,1)== 'z')
        {
            $shipno = substr($rTest[$i],2,6);
        }//end elseif
        
        substr($rTest[$i],0,1) == '9' ?  $shipno = substr($rTest[$i],7,7): $shipno = "0" ;
        
        
       
    
//look for missing shippers.sname
        $result1=PkgsDB::getInstance()->FindShipno($shipno);
   
        if (!$result1)              // no shipno
        {
?>  
<!--<a href="#openModal">Open el turdo Modal</a>-->


        <div id="openModal" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h2>Info box</h2>
            <p>This package's number has no shipper number code.</p>
            <p> Please provide shipper name and shipper address.</p>
            <form method="post"">
                    Shipper's name: <br>
                    <input type="text" "' name="sname"><br>
                    Shipper's location: <br>
                    <input type="text"" name="slocation""><br><br>
                    <input type="submit"" value="submit"">
            </form>
        
            </div>
    </div>
<?php
    }
    
    $result2 = PkgsDB::getInstance()->InsertPackageNumber($pnumber,$snumber,$preceived,$wid);
       
    if (!$result2)
        {
        echo "unable to add shipper number to database...";
        $i++;
        }
    
$i=$i+1;

}
mysqli_close($con);
?>
<!--<a href="#" onClick="history.go(-1)">Back</a>-->
<input type=button value="Back" onClick="history.go(-1)">


</body>
</html>
