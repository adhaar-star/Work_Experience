<?php

/**
 * Description of front_end
 *
 * @author Mohamed Mahdy
 *
 */
class front_end extends main
{
    public $selected_theme;
    public $front_end_template_path;

    function __construct()
    {
        $this->selected_theme = 'default';
        parent::__construct();
    }

    function set_flashdata_page_not_found()
    {
        $this->session->set_flashdata('warning_msg', 'Sorry this page is not found');
        redirect('jarvis');
    }

    /**
     * print last mysql query or log it to log error
     */
    public function db_last_query($log = false)
    {
        if ($log) {
            log_message('error', $this->db->last_query());
        } else {
            echo $this->db->last_query();
        }
    }


    /**
     * return module language file
     * @param String $moduleName
     */
    protected function load_lang($moduleName = '')
    {
        if ($this->session->userdata('lang') == "ar") {
            $lang = "arabic";
        } else {
            $lang = "english";
        }
        $this->lang->load($moduleName, $lang);
    }

    /**
     * present master page includes header and footer
     * @param string $main_containt
     * @param array $data
     */
    protected function view($main_content, $data = null)
    {
        $this->load->view('header');
        $this->load->view($main_content, $data);
        $this->load->view('footer');
    }

    protected function is_logged()
    {
        if (!$this->authority->is_logged()) {
            redirect('users/login');
        }
    }

    protected function set_last_url($last_url = '')
    {
        $this->session->set_userdata('last_url', $last_url);
    }

    protected function get_last_url()
    {
        return $this->session->userdata('last_url');
    }
}

