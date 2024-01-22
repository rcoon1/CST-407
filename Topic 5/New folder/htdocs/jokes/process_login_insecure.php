<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

include "db_connect.php";


$username = $_POST['username'];
$password = $_POST['password'];

echo "You attempted to login with " . $username . " and " . $password . "<br>";

// $sql = "SELECT id, username, password FROM users WHERE username = '$username' AND password = '$password'";

$stmt = $mysqli->prepare ("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$stmt->store_result();
$stmt->bind_result($userid, $fetched_name, $fetched_pass);

echo "SQL = " . $sql . "<br>";

$result = $mysqli->query($sql);

echo "<pre>";
print_r($result);
echo "</pre>";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userid = $row['id'];
    echo "Login successful<br>";
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $userid;
} else {
    echo "0 results. Nobody with that username and password";
    $_SESSION = [];
    session_destroy();
    echo "<br><a href='index.php'>return to main page</a>";
}

echo "SESSION Variable <br>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
