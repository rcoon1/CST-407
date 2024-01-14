<?php
session_start(); 
$params = session_get_cookie_params();
setcookie("PHPSESSID", session_id(), 0, $params["path"], $params["domain"],
false,
true 
);
 
?>
<html>

<body>
    <h1>Login</h1>
    <p>Use victor as a login name</p>
    <form action="login.php" method="post">
        <label for="usernmae">Username</label>
        <input type="text" name="username">
    <br>
        <label for="password">Pass</label>
        <input type="password" name="password">
        <br>
        <input type="submit" name="submit"> 
    </form>
    <br>
<?php
    // form handlers is on the same page as the form.
    $_SESSION = null;
    $_SESSION['username'] = $_POST['username']; 
    echo $_SESSION['username'] . " is logged in<br>";
    
    // remember this login. Later someone will steal our session id and we need to verify this number.    
    $logintoken = bin2hex(random_bytes(20)); // generates a random string     
    $cookie_options = array('httponly' => true);    
    setcookie('logintoken', $logintoken, $cookie_options);    
    $_SESSION['hashedlogintoken'] = password_hash($logintoken,PASSWORD_DEFAULT);     
    echo "session:";    
    echo "<pre>";    
    print_r($_SESSION);    
    echo "</pre>";  

    echo "cookies:<br>";    
    echo "<pre>";    
    print_r($_COOKIE);    
    echo "</pre>";

    
 ?>
 <p>Go to the input form if victor is logged in. <a href="index.php">click here</a></p>
</body>
</html>
