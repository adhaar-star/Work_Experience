<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * NETBEANS - Code Completion Keys
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property authority $authority
 * @property CI_Email $email
 * @property CI_Session $session
 * @property CI_DB_active_record $db
 * @property Admin_model $admin
 */
class install extends front_end
{

    function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->form_validation->set_error_delimiters('<span class="uk-alert-danger uk-align-left">', '</span>');
    }

    function index()
    {
        $this->install();
    }

    function install()
    {
        $this->load->helper('file_helper');
        $this->form_validation->set_rules('hostname', "Host Name", 'trim|required|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('database_name', "Database Name", 'trim|required|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('database_user', "Database User", 'trim|required|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('database_password', "Database Password", 'trim|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('admin_username', "Admin username", 'trim|required|xss_clean');
        $this->form_validation->set_rules('admin_email', "Admin Email", 'trim|required|xss_clean');
        $this->form_validation->set_rules('admin_password', "Admin password", 'trim|required|md5|xss_clean');
        // validation website logo
        if ($this->form_validation->run() == true) {
            $this->generate_tables();
        } else {
            $this->view('index');
        }

    }

    private function generate_tables()
    {
        $database_mysql_url = PUBPATH . 'assets/db_name.sql';
        $database_conf_path = PUBPATH . 'assets/database.php';
        $tables = '';
        try {
            if (read_file($database_mysql_url)) {
                $tables = read_file($database_mysql_url);
                $hostname = $this->input->post('hostname');
                $database_name = $this->input->post('database_name');
                $database_user = $this->input->post('database_user');
                $database_password = $this->input->post('database_password');
                $admin_username = $this->input->post('admin_username');
                $admin_email = $this->input->post('admin_email');
                $admin_password = $this->input->post('admin_password');
                $conn = mysql_connect($hostname, $database_user,
                    $database_password) or die("could not connect to database");
                mysql_select_db($database_name, $conn) or die("could not select " . $database_name);

                // Temporary variable, used to store current query
                $templine = '';
// Read in entire file
                $lines = file($database_mysql_url);

                $real_url = str_replace('installer/', '', base_url());

// Loop through each line
                foreach ($lines as $line) {
// Skip it if it's a comment
                    if (substr($line, 0, 2) == '--' || $line == '') {
                        continue;
                    }

                    $line = str_replace('http://localhost/spider-wikihow-portal-script/', $real_url, $line);
// Add this line to the current segment
                    $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
                    if (substr(trim($line), -1, 1) == ';') {
                        // Perform the query
                        /*mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');*/
                        mysql_query($templine);
                        // Reset temp variable to empty
                        $templine = '';
                    }
                }
                mysql_query("UPDATE users SET user_username = '" . $admin_username . "' ,
                                              user_email = '" . $admin_email . "' ,
                                              user_password = '" . $admin_password . "'
                             WHERE `user_id` = '1'
                            ") or die(mysql_error());
                $this->_write_database_file($database_conf_path);
                //echo "Tables imported successfully";
                redirect('install/success');

            } else {
                throw new Exception("cannot read database file: " . $database_mysql_url);
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            return false;
        }
    }

    private function _write_database_file($file = '')
    {
        if (read_file($file)) {
            $code = read_file($file);
            $code = str_replace('%%hostname%%', $this->input->post('hostname'), $code);
            $code = str_replace('%%database%%', $this->input->post('database_name'), $code);
            $code = str_replace('%%username%%', $this->input->post('database_user'), $code);
            $code = str_replace('%%password%%', $this->input->post('database_password'), $code);
            write_file('../application/config/database.php', $code);
        }
    }

    function success()
    {
        $this->view('success');
    }

    function SplitSQL($file, $delimiter = ';')
    {
        set_time_limit(0);

        if (is_file($file) === true) {
            $file = fopen($file, 'r');

            if (is_resource($file) === true) {
                $query = array();

                while (feof($file) === false) {
                    $query[] = fgets($file);

                    if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1) {
                        $query = trim(implode('', $query));

                        if (mysql_query($query) === false) {
                            echo '<h3>ERROR: ' . $query . '</h3>' . "\n";
                        } else {
                            echo '<h3>SUCCESS: ' . $query . '</h3>' . "\n";
                        }

                        while (ob_get_level() > 0) {
                            ob_end_flush();
                        }

                        flush();
                    }

                    if (is_string($query) === true) {
                        $query = array();
                    }
                }

                return fclose($file);
            }
        }

        return false;
    }
}