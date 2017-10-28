<?PHP

function displayLogin() {
header("WWW-Authenticate: Basic realm=\"packages\"");
header("HTTP/1.0 401 Unauthorized");
echo "<h2>Authentication Failure</h2>";
echo "The username and pissword provided did not work. Please reload this page and try again.";
exit;
}


if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']))
{
// If username or password hasn't been set, display the login request.
displayLogin();
}
else 
{
// Escape both the password and username string to prevent users from inserting bogus data.
$PUSER=($_SERVER['PHP_AUTH_USER']);
$PPW=($_SERVER['PHP_AUTH_PW']);
$PPW = MD5($PPW);
$db = mysql_connect('localhost','phpuser','!phpuser') or die("Couldn't connect to the database.");
mysql_select_db('sr') or die("Couldn't select the database");

$query = sprintf("SELECT count(id) FROM users WHERE userName='%s' AND userPass='%s'",
            mysql_real_escape_string($PUSER),
            mysql_real_escape_string($PPW));
// Check username and password agains the database.
$result = mysql_query($query);
if (!$result){
    echo "$PPW,$PUSER<br>";
    die("stop here Couldn't query the user-database.");
}
$num = mysql_result($result, 0);

if (!$num)
{
// If there were no matching users, show the login
echo "crap";
echo "<br>$PHP_AUTH_PW";
//displayLogin();
}
}

// All code/html below will only be displayed to authenticated users.

echo "Congratulations! You're now authenticated.";

?> 
