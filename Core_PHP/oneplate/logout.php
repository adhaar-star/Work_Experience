<?php

/**
 * Login section
 */
require 'config/config.php';

$config['title'] = 'Logout | One-Plate-CA';

$url = 'login.php';

$alerts = get_alerts();

if (!is_loggedin()) {
    $_SESSION['alerts']['danger'][] = array('head' => 'Forbidden Access!',
        'body' => 'Please Login to access this area or ' .
        anchor(['href' => 'login.php', 'text' => 'Sign-up', 'attr' => ['class' => 'alert-link']], $return = TRUE));
} else {
    session_destroy();
    session_start();
    if ($alerts) {
        set_alerts(['alerts' => $alerts]);
    }
    set_alerts(['success' => ['Logged-out successfully']]);
}

redirect($url);
