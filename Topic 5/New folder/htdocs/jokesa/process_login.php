<html>
<head>

</head>
<?php 
session_start();

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

include "db_connect.php";
$user_name = $_POST['username'];
$password = $_POST['password'];

echo "<h2>You attempted to login with " . $user_name . " and " . $password . "</h2>";

$stmt = $mysqli->prepare ("SELECT user_id, user_name, password FROM users WHERE user_name = ?");
$stmt->bind_param("s", $user_name);
$stmt->execute();

$stmt->store_result();
$stmt->bind_result($user_id, $fetched_name, $fetched_pass);

if ($stmt->num_rows == 1 ) {    
    echo "Found 1 person with that username<br>";    
    $stmt->fetch();    
    if (password_verify($password, $fetched_pass)) {        
        echo " pw matches<br>";        
        echo "<p>Login success</p>";         
        $_SESSION['username'] = $user_name;        
        $_SESSION['userid'] = $user_id;    
        }    
        else {       
             echo "Password does not match<br>";    
        } 

        } else {    
            echo "0 results. Not logged in<br>";    
        $_SESSION =  [];    
        session_destroy();
        }
        
        echo "Session variable = ";
        print_r($_SESSION);
        
        echo "<br>";echo "<a href='index.php'>Return to main page</a>";
        ?>
        </html>