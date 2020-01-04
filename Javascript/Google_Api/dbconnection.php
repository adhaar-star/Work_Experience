<?php
$c=mysql_connect('192.168.2.23','AstroAdmin','Astro-Cooler');
if (!$c) {
    die("Connection failed: " . mysql_error());
}
$d=mysql_select_db('intermodal');
if (!$d) {
    die("Connection failed: " . mysql_error());
echo "hi";
}
?>
