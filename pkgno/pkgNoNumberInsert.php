<?php
session_start;
require_once "Includes/db.php";

$sname= $_POST["sname"];
$scity=$_POST["scity"];
$snumber= $_POST["snumber"];
if (isset($_SESSION["wid"]))
    {
    $wid = $_SESSION["WID"];
    }
if (isset($_SESSION["pnumber"]))
    {
    $pnumber = $_SESSION["pnumber"];
    }
if (isset($_SESSION["preceived"]))
    {
    $preceived = $_SESSION["preceived"];
    }
?>

