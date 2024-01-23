<html>
<head>

</head>
 <?php
 session_start();
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 
include "db_connect.php";

$username = $_POST['username'];
$password = $_POST['password'];

echo "<h2>You attempted to login with " . $username . " and " . $password . "</h2>";

$stmt = $mysqli->prepare ("SELECT userid, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$stmt->store_result();
$stmt->bind_result($userid, $fetched_name, $fetched_pass);
// if ($stmt->error) {
//     echo "Error binding result: " . $stmt->error;
// }

// Shows the vals returned from database
while($stmt->fetch()) {
    echo "Fetched Data: UserID - $userid, Username - $fetched_name, Password - $fetched_pass<br>";
}

if ($stmt->num_rows == 1 ) {
    echo "Found 1 person with that username<br>";

    

} else {
    echo "0 results. Not logged in<br>";
    $_SESSION =  [];
    session_destroy();
}

echo "Session variable = ";
print_r($_SESSION);

echo "<br>";

echo "<a href='index.php'>Return to main page</a>";
?>

</html>