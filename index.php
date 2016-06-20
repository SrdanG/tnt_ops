<?php

session_start();

$content_rotation_list = array(
    "main.php",
	"vreme.php",
    "ucinkovitost.php"
);

if (($_SESSION['counter']) == 2)
    $_SESSION['counter'] = 0 ;
else 
    $_SESSION['counter']++;

include ($content_rotation_list[$_SESSION['counter']]);

?>


<html>
    <head>
       <meta http-equiv="refresh" CONTENT="20; URL=http://merdenoms.eu/tnt/";>
    </head>
</html>





