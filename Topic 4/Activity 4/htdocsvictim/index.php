<?php
session_start();
if ($_SESSION['token'] == null){
    $_SESSION['token'] = bin2hex(random_bytes(20));
}
$token = $_SESSION['token'];
echo "Session variable set to this:";
echo "<pre>";
print_r($_SESSION);
echo "</pre>"
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="site.css">
    </head>
<body>

<h1>Post a comment</h1>
<form action="index.php" method="post">
    <input type="hidden" name="hashedtoken" value="<?php echo password_hash($token, PASSWORD_DEFAULT); ?>">
    <label for="comment_title">Comment Title</label>
    <input type="text" name="comment_title"><br/>
    <label for="comment_text">Text</label>
    <textarea   name="comment_text" rows="10" cols="100" ></textarea>
    <br/>
    <input type="submit" name="submit"> 
</form>
<br>
<hr>

<?php
echo "Session: ";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "$_POST<br>";
echo "<pre>";
##print_r($_SESSION);
echo "</pre>";

if ($_SESSION['username'] == "victor") {    
    if (!password_verify($_COOKIE['logintoken'], $_SESSION['hashedlogintoken'])) {        
        echo "<div class='tokennotaccepted'>";        
        echo "<p></p>It appears that you logged in from another browser. Did you 
        steal a session id??? Go away.</p>";        
        echo "</div>";        
        exit;    
    } 
    else {        
        echo "Thank you <b>" . $_SESSION['username'] . "</br> using the program.  
        New posted comments appear below.";    
    }
}
else {    
    die ("Sorry. It appears that there is no user logged in.  Cannot save your post.
    ");
}
if (!$_POST['comment_title']) {     
    die("Nothing posted");
}
?>

 
<h2>New comments</h2>

<div id="newcomment">
    <?php
    echo htmlspecialchars(strip_tags($_POST['comment_title']));
    echo "<br>";
    echo htmlspecialchars(strip_tags($_POST['comment_text']));
        ?> 
    </div>
</body>

</html>