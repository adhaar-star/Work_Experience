<?php session_start();

class Users extends MY_Controller
{
    public $user = "";

    function __construct()
    {
        parent::__construct();
        $this->load->model("users_model", "users");
        $this->load->library('upload');
        $config['upload_path'] = 'assets/uploads/';
        $config['encrypt_name'] = false;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->upload->initialize($config);
    }

    function index()
    {
    }

    function login()
    {
        if ($this->authority->is_logged()) {
            redirect('admin/setting');
        }


        $this->_load_form_validation();
        $this->form_validation->set_rules('email', 'Email',
            'required|max_length[100]|xss_clean|htmlspecialchars|valid_email');
        $this->form_validation->set_rules('password', 'Password',
            'required|min_length[6]|max_length[30]|md5|xss_clean');
        if ($this->form_validation->run() == true) {
            $this->_do_login();
        } else {
            $this->view('users/login');
        }
    }

    private function google()
    {
        // Include google-php-client library in controller
        include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
        include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";

        // Store values in variables from project created in Google Developer Console
        $client_id = $this->option->get('google-client-id');
        $client_secret = $this->option->get('google-client-secret');
        $redirect_uri = base_url() . 'users/login/';
        $simple_api_key = $this->option->get('google-api-key');

        // Create Client Request to access Google API
        $client = new Google_Client();
        $client->setApplicationName("PHP Google OAuth Login Example");
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->setDeveloperKey($simple_api_key);
        $client->addScope("https://www.googleapis.com/auth/userinfo.email");

        // Send Client Request
        $objOAuthService = new Google_Service_Oauth2($client);

        // Add Access Token to Session
        $this->config->set_item('allow_get_array', true);
        $this->config->set_item('uri_protocol', 'PATH_INFO');


        $segs = parse_str(array_pop(explode('?', $_SERVER['REQUEST_URI'], 2)), $_GET);
        //echo $_GET['code'];
        //exit;
        if (uri_segment(3) != 2) {
            if (isset($_GET['code'])) {
                $client->authenticate($_GET['code']);
                $_SESSION['access_token'] = $client->getAccessToken();
                header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
            }
        }

        // Set Access Token to make Request
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
        }

        // Get User Data from Google and store them in $data
        //echo $client->getAccessToken(); exit;
        if ($client->getAccessToken() and uri_segment(3) != 2) {
            $userData = $objOAuthService->userinfo->get();
            $data['userData'] = $userData;
            $this->db->where('user_email', $userData->email);
            //$this->db->where('user_active',1);
            $this->db->where('user_state', 1);
            $user = $this->db->get('users')->row();
            if (is_object($user)) {
                $this->authority->set_user_data($user);
                redirect('site');
            } else {
                $userObj = new stdClass();
                $userObj->user_photo = $userData->picture;
                $userObj->user_username = url_title($userData->name);
                $userObj->user_email = $userData->email;
                $userObj->user_created_date = time();
                $this->db->insert('users', $userObj);
                $this->db->where('user_email', $userData->email);
                $user = $this->db->get('users')->row();
                $this->authority->set_user_data($user);
            }

            $_SESSION['access_token'] = $client->getAccessToken();
            redirect('site');
        } else {
            $authUrl = $client->createAuthUrl();
            $data['authUrl'] = $authUrl;
        }
        $this->load->vars($data);
    }

    private function facebook()
    {
        $this->load->library('facebook');

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $user_profile = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
        }

        if ($user) {

            $data['logout_url'] = site_url('users/logout'); // Logs off application
            // OR
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();
            $this->db->where('user_email', $user_profile['email']);
            //$this->db->where('user_active',1);
            $this->db->where('user_state', 1);
            $user = $this->db->get('users')->row();
            if (is_object($user)) {
                $this->authority->set_user_data($user);
                redirect('site');
            } else {
                $userObj = new stdClass();
                $userObj->user_photo = "https://graph.facebook.com/" . $user_profile['id'] . "/picture?type=large";
                $userObj->user_username = $user_profile['name'];
                $userObj->user_email = $user_profile['email'];
                $userObj->user_created_date = time();
                $this->db->insert('users', $userObj);
                $this->db->where('user_email', $user_profile['email']);
                $user = $this->db->get('users')->row();
                $this->authority->set_user_data($user);
            }

            redirect('site');

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('users/login/2'),
                'scope' => array("email") // permissions here
            ));
        }
        $this->load->vars($data);
    }

    /**
     * @param string $username user_username
     */
    function profile($username = '')
    {
        $vars['user'] = $this->db->get_where('users', array('user_username' => $username))->row();
        if (!is_object($vars['user'])) {
            $this->set_flashdata_page_not_found();
        }

        if (@$vars['user']->user_id == @$this->authority->user->user_id) {
            $vars['not_the_author'] = false;
        } else {
            $vars['not_the_author'] = true;
        }
        $this->_load_form_validation();
        $this->form_validation->set_rules('username', 'Username',
            'required|xss_clean|htmlspecialchars|min_length[3]|max_length[17]');
        $this->form_validation->set_rules('email', 'Email address ', 'required|valid_email|max_length[150]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'min_length[6]|max_length[30]|md5|xss_clean');

        if ($this->form_validation->run() == true) {
            $this->demo_mode('user/profile/'.$username);
            if (is_object($this->authority->user)) {
                if ($vars['not_the_author'] === false) {
                    $this->db->set('user_username', url_title($this->input->post('username')));
                    $this->db->set('user_email', $this->input->post('email'));
                    if ($this->input->post('password')) {
                        $this->db->set('user_password', $this->input->post('password'));
                    }
                    if (@$_FILES["user_photo"]['name']) {
                        $user_photo = $this->upload('user_photo');
                        $user_photo = base_url() . 'assets/uploads/' . $user_photo;
                        $this->db->set('user_photo', $user_photo);
                    }
                    $this->db->where('user_id', $this->authority->user->user_id);
                    $this->db->update('users');
                } else {
                    $this->session->set_flashdata('error_msg', 'It`s not allowed to access this account');
                    redirect('users/login');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'You have to login to do this action');
                redirect('users/login');
            }
            // update the login information
            $new_data = $this->db->get_where('users', array('user_id' => @$this->authority->user->user_id))->row();
            $this->session->set_userdata('user_data', $new_data);

            $this->session->set_flashdata('success_msg', 'Congratulations! You have successfully update your data');
            redirect('users/profile/' . $this->input->post('username'));
        }

        $vars['site'] = $this;
        $this->admin_view('users/profile', $vars);
    }

    private function sign_up()
    {
        $this->_load_form_validation();
        $this->session->unset_userdata('user');
        $this->form_validation->set_rules('username', 'Username',
            'required|max_length[100]|xss_clean|htmlspecialchars|is_unique[users.user_username]|min_length[3]|max_length[17]');
        $this->form_validation->set_rules('password', 'Password',
            'required|min_length[6]|max_length[30]|matches[confirmPassword]|md5');
        $this->form_validation->set_rules('confirmPassword', 'Confirm password',
            'required|min_length[6]|max_length[30]|md5');
        $this->form_validation->set_rules('email', 'Email address ',
            'required|valid_email|max_length[150]|is_unique[users.user_email]');
        $this->form_validation->set_message('is_unique', 'Already registered');

        if ($this->form_validation->run() == true) {
            $this->db->set('user_username', url_title($this->input->post('username')));
            $this->db->set('user_email', $this->input->post('email'));
            $this->db->set('user_password', $this->input->post('password'));
            $this->db->set('user_state', 1);
            $this->db->set('user_created_date', time());
            $this->db->set('user_group_id', 3);  // members group
            $this->db->insert('users');
            $this->session->set_flashdata('success_msg', 'Congratulations! You have successfully registered');
            $this->_do_login(true);
            redirect('site');
        } else {
            $this->view('users/sign_up');
        }
    }

    function sign_out()
    {
        //Logout Process Succeed
        if (isset($_SESSION['access_token'])) {
            unset($_SESSION['access_token']);
            $this->session->sess_destroy();
            session_destroy();
            $this->load->view('redirect');
        } else {
            //unset($_SESSION['access_token']);
            $this->session->sess_destroy();
            session_destroy();
            redirect('users/login');
        }


    }

    private function _do_login($first_register = false)
    {
        $login = $this->authority->check_user($this->input->post('email'), $this->input->post('password'));
        if ($login) {
            $this->db->where('user_email', $this->input->post('email'));
            $this->db->where('user_password', $this->input->post('password'));
            $result = $this->db->get('users')->row();
            if ($first_register) {
                $this->session->set_flashdata('success_msg', 'You have Earned ' . $this->option->get('register-points') . ' Point cause you register at ' . $this->option->get('website-name'));
            }

            if ($this->get_last_url()) {
                redirect($this->get_last_url());
            } else {
                redirect('admin/setting');
            }

        } else {
            $this->session->set_flashdata('error_msg', 'Wrong email or password!');
            redirect('users/login');
        }
    }

    private function _load_form_validation()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_error_delimiters("<span class='uk-alert-danger'>", "</span>");
    }


}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */