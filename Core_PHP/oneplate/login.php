<?php

/**
 * Login section
 */
require_once 'config/config.php';

$config['title'] = 'Login | One-Plate-CA';

if(is_loggedin()) {
    redirect('my-meal.php');
}

if (isset($_POST['action']) && $_POST['action'] == 'login') {

    $username = $_POST['email'];
    $passwd = $_POST['password'];
    if (empty($username) || !valid_email($username)) {
        set_alerts(['danger' => array('Invalid username . Try again!')]);
    } else if (!$db->is_valid_user($username)) {
        set_alerts(['danger' => array('Invalid username 2. Try again!')]);
    } else if (!$db->is_valid_password($passwd)) {
        set_alerts(['danger' => array('Invalid password 3. Try again!')]);
    } else {
        set_alerts(['success' => array('Logged-in successfully')]);
        $_SESSION['id'] = $db->user_id;
        $_SESSION['user_details'] = ['username' => $db->username,'password' => $db->passwd, 'profile' => $db->get_user_profile()];
        if($db->user_id == 1) {
            $_SESSION['user_type'] = 1;     // admin
            include 'expire.php';           // run check for expire records
        } else {
            $_SESSION['user_type'] = 2;     // other user
        }
        redirect('my-meal.php');
    }
}


//include('views/header.php');
include('views/login.php');
//include('views/footer.php');

/**
 * Close database connection
 */
//include_once 'config/db-conn-close.php';
