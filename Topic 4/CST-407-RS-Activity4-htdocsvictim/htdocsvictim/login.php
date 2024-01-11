<?php
session_start(); 
 
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

    
 ?>
 <p>Go to the input form if victor is logged in. <a href="index.php">click here</a></p>
</body>
</html>
