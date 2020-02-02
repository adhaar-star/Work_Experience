<?php

/**
 * Description of front_end
 *
 * @author Mohamed Mahdy
 *
 */
class MY_Controller extends CI_Controller
{
    public $selected_theme;
    public $front_end_template_path;

    function __construct()
    {
        parent::__construct();
        $this->load->language('jarvis');
        if (ENVIRONMENT == 'development') {
            //$this->output->enable_profiler(TRUE);
            $this->load->helper('my');
        }

        $this->selected_theme = $this->option->get('selected-theme');
        $this->front_end_template_path = 'user/template/' . $this->selected_theme . '/';
    }


    /**
     * present master page includes header and footer
     * @param string $main_containt
     * @param array $vars
     */
    protected function view($main_content, $vars = null)
    {
        $this->load->view('header');
        $this->load->view($main_content, $vars);
        $this->load->view('footer');
    }

    /**
     * present master page includes header and footer
     * @param string $main_containt
     * @param array $vars
     */
    protected function admin_view($main_content, $vars = null)
    {
        $this->load->view('admin/header');
        $this->load->view($main_content, $vars);
        $this->load->view('admin/footer');
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

    function check_right($right = '')
    {
        return $this->authority->check_right($right);
    }

    function _admin_check_right_redirect()
    {
        if (!$this->authority->check_right('manage-all')) {
            $this->session->set_flashdata('warning_msg', lang('no-perm'));
            redirect('users/login');
        }
    }

    protected function _check_right_redirect($right = '', $destination = 'users/login')
    {
        if (!$this->authority->check_right($right)) {
            $this->session->set_flashdata('warning_msg', lang('no-perm'));
            redirect($destination);
        }
    }

    protected function profiler()
    {
        $this->output->enable_profiler(true);
    }

    protected function alert($message = '', $redirect = '')
    {
        ?>
        <script type="text/javascript">
            alert("<?php echo  $message ?>");
            window.location = '<?php echo  base_url() . $redirect ?>';
        </script>
        <?php
    }

    /**
     * @example image_url
     * @param file $file
     * @return file_url if true otherwise return false
     */
    protected function upload($file_name = '')
    {
        if ($this->upload->do_upload($file_name)) {
            $image = $this->upload->data();

            return $image['file_name'];
        } else {
            return false;
        }
    }

    function run_cache()
    {
        if ($this->option->get('cache-state')) {
            $this->output->cache($this->option->get('cache-period'));
        }
    }

    public function demo_mode($uri)
    {
        if (ENVIRONMENT == 'DEMO') {
            flash_data_warning(lang('Feature only Available in the Premium Version'));
            redirect($uri);
        }
    }
}

