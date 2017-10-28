<?php
require_once("Includes/db.php");
/**other variables */
$userNameIsUnique = true;
$userIsEmpty = false;
//$userEmailaddressIsUnique = true;
$passwordIsValid = true;

$passwordIsEmpty = false;
$password2IsEmpty = false;
            
/** Check that the page was requested from itself via the POST method. */
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    /** Check whether the user has filled in the wisher's name in the text field "user" */
    $user=filter_input(INPUT_POST,"user",FILTER_SANITIZE_SPECIAL_CHARS);
	if ($user==""){
        $userIsEmpty = true;
    }

    /** Create database connection */
	$name=filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
    $userID = UserDB::getInstance()->GetUserIdByName($name);
    if ($userID) {
        $userNameIsUnique = false;
    }
    $password  =filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
	$password2=filter_input(INPUT_POST,"password2",FILTER_SANITIZE_SPECIAL_CHARS);
    /** Check whether a password was entered and confirmed correctly */
    if ($password=="")
    $passwordIsEmpty = true;
    if ($password2=="")
    $password2IsEmpty = true;
    if ($password!=$password2) {
        $passwordIsValid = false;
    }

    /** Check whether the boolean values show that the input data was validated successfully.
     * If the data was validated successfully, add it as a new entry in the "wishers" database.
     * After adding the new entry, close the connection and redirect the application to editWishList.php.
     */
    if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid) {
        UserDB::getInstance()->CreateUser($user, $password);
        session_start();
        $_SESSION['user'] = $user;
        header("location:menu.php");
	exit;
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>registerUser.php</title>
        <!--<link href="wishlist.css" type="text/css" rel="stylesheet" media="all" />-->
    </head>
    <body>
        <h1>Add a new user</h1>
        
        <form action="AddUser.php" method="POST" id="AddUser">
            <label>Your name:</label>
            <input type="text" name="user"/><br/>
            <?php
            /** Display error messages if "user" field is empty or there is already a user with that name*/
            if ($userIsEmpty) {
                echo ('<div class="error">Enter your name.</div>');
            }
            if (!$userNameIsUnique) {
                echo ('<div class="error">The person already exists. Please check the spelling and try again</div>');
            }
    
            ?>
            <label>Password:</label>
            <input type="password" name="password"/><br/>
            <?php
             /** Display error messages if the "password" field is empty */
            if ($passwordIsEmpty) {
                echo ('<div class="error">Enter the password</div>');
            }
            ?>
            <label>Password (Again):</label>
            <input type="password" name="password2"/><br/>
            <?php
            /**
             * Display error messages if the "password2" field is empty
             * or its contents do not match the "password" field
             */
            if ($password2IsEmpty) {
                echo ('<div class="error">Confirm your password, please</div>');
            }
            if (!$password2IsEmpty && !$passwordIsValid) {
                echo ('<div class="error">Your passwords do not match.</div>');
            }
            ?>
            <br />
            <input type="submit" value="Add User"/>

        </form>
        <input type=button value="Back" onClick="history.go(-3)">
        <INPUT type="reset">
    </body>
</html>
