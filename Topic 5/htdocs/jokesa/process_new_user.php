<?php
// add a new user to the database. requires input from register_new_user.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db_connect.php";
$new_username = $_GET['username'];
$new_password1 = $_GET['password'];
$new_password2 = $_GET['password-confirm']; 

echo "<h2>Trying to add a new user " . $new_username . " pw =  " . $new_password1 . " and " . $new_password2 . "</h2>";

// check to see if this username has already been registered.
$sql = "SELECT * FROM users WHERE username = '$new_username'";
$result = $mysqli->query($sql) or die (mysqli_error($mysqli));

if ($result->num_rows > 0) {    
    echo "The username " . $new_username . " is already in use.  Try another.";
    exit;
} 
// check to see if the password fields match
else if ($new_password1 != $new_password2) {    
    echo "The passwords do not match. Please try again.";    
    exit;
} 
else {

    // add the new user    
    $sql = "INSERT INTO users (id, username, password) VALUES (null, '$new_username', '$new_password')";
    $result = $mysqli->query($sql) or die (mysqli_error($mysqli));    
    if ($result) {
        echo "Registration success!";    
    }    
    else {        
        echo "Something went wrong.  Not registered.";    
    }

}

echo "<a href = 'index.php'>Return to main</a>";