<?php

echo $_SERVER['HTTP_HOST'];
echo (preg_match('/www/',$_SERVER['HTTP_HOST'])==1)?$_SERVER['HTTP_HOST']:'www.'.$_SERVER['HTTP_HOST'] ;

phpinfo();

?>
