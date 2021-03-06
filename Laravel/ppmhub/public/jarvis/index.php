<?php
define('SCRIPT_VERSION', '1.0');
define('UIKIT_VERSION', 'uikit-2.20.2');
if (!file_exists('application/config/database.php')) {
    ?>
    <script>window.location = 'installer';</script><?php
}
define('ENVIRONMENT', 'production');
/*
 * ---------------------------------------------------------------
 * ERROR REPORTING
 * ---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(-1);
            break;

        case 'testing':
        case 'DEMO':
        case 'production':
            error_reporting(0);
            break;

        default:
            exit('The application environment is not set correctly.');
    }
}


$system_path = 'system';


$application_folder = 'application';


// Set the current directory correctly for CLI requests
if (defined('STDIN')) {
    chdir(dirname(__FILE__));
}

if (realpath($system_path) !== false) {
    $system_path = realpath($system_path) . '/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/') . '/';

// Is the system path correct?
if (!is_dir($system_path)) {
    exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: " . pathinfo(__FILE__,
            PATHINFO_BASENAME));
}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */

// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
// The PHP file extension
define('EXT', '.php');
// Path to the system folder
define('BASEPATH', str_replace("\\", "/", $system_path));
// Path to the front controller (this file)
define('FCPATH', str_replace(SELF, '', __FILE__));
// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));
define('PUBPATH', str_replace(SELF, '', FCPATH)); // added
// The path to the "application" folder
if (is_dir($application_folder)) {
    define('APPPATH', $application_folder . '/');
} else {
    if (!is_dir(BASEPATH . $application_folder . '/')) {
        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF);
    }

    define('APPPATH', BASEPATH . $application_folder . '/');
}

require_once BASEPATH . 'core/CodeIgniter' . EXT;

/* End of file index.php */
/* Location: ./index.php */