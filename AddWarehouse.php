<?php
require_once("Includes/db.php");
/**other variables */
$warehouseNameIsUnique = true;
$warehouseNameIsEmpty = false;
//$userEmailaddressIsUnique = true;
/*$passwordIsValid = true;*/
$locationIsEmpty = false;
/*$password2IsEmpty = false;*/
/** Check that the page was requested from itself via the POST method. */
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    /** Check whether the user has filled in the wisher's name in the text field "user" */
//$wname=filter_input(INPUT_POST,'wname',FILTER_SANITIZE_SPECIAL_CHARS);    
    if ($_POST['name']==""){
        $warehouseNameIsEmpty = true;
    }
    /** Create database connection */
    $mname=filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
    $mlocation=filter_input(INPUT_POST,'location',FILTER_SANITIZE_SPECIAL_CHARS);
    $wid = WarehouseDB::getInstance()->GetWarehouseIdByName($mname);
    if ($wid) {
        $warehouseNameIsUnique = false;
    }
    if (!$warehouseNameIsEmpty && $warehouseNameIsUnique && !$locationIsEmpty) {
        warehouseDB::getInstance()->create_warehouse($mname,$mlocation);
        session_start();
        $_SESSION['wname'] = $mname;
        header('Location:menu.php' );
	    exit;
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>AddAWarehouse.php</title>
        <!--<link href="wishlist.css" type="text/css" rel="stylesheet" media="all" />-->
    </head>
    <body>
        <!--<h1>Welcome!</h1>-->
        
        <form action="AddAWarehouse.php" method="POST" id="NewWarehouseName">
            <label>new warehouse:</label>
            <input type="text" name="name"/><br/>
            <?php
            /** Display error messages if "name" field is empty or there is already a warehouse with that name*/
            if ($warehouseNameIsEmpty) {
                echo ('<div class="error">Enter a new warehouse name.</div>');
            }
            if (!$warehouseNameIsUnique) {
                echo ('<div class="error">The name already exists. Please check the spelling and try again</div>');
            }
    
            ?>
            <label>location:</label>
            <input type="text" name="location"/><br/>
            <?php
             /** Display error messages if the "location" field is empty */
            if ($locationIsEmpty) {
                echo ('<div class="error">Enter the a new location</div>');
            }
            ?>
            <!--<label>Password (Again):</label>-->
            <!--<input type="password" name="password2"/><br/>*-->
            <?php
            /**
             * Display error messages if the "password2" field is empty
             * or its contents do not match the "password" field
             */
            /*if ($password2IsEmpty) {*/
            /*    echo ('<div class="error">Confirm your password, please</div>');*/
            /*}*/
            /*If (!$password2IsEmpty && !$passwordIsValid) {*/
            /*    echo ('<div class="error">Your passwords do not match.</div>');*/
            /*}*/
            ?>
            <br />
            <input type="submit" value="New Warehouse"/>

        </form>
        <input type=button value="Back" onClick="history.go(-3)">
        <INPUT type="reset">
    </body>
</html>