<?php
/**
 * Created by PhpStorm.
 * User: c73
 * Date: 15/12/15
 * Time: 5:46 PM
 */

class DB_CONNECT{
    function __construct(){
        $this->connect();
    }

    function __destruct(){
        $this->close();
    }

    function connect(){
        require_once __DIR__.'/config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());

        $db = mysql_select_db(DB_DATABASE) or die(mysql_error());
        //echo "hi";die;
        return $con;
    }

    function close()
    {
        mysql_close();
    }
}

?>