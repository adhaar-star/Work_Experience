<?php

/**
 *
 * @property CI_DB_active_record $db
 * @property CI_Input $input
 * @property CI_Pagination $pagination
 * @author Mohamed Mahdy <eng.mohamed.php@gmail.com>
 * @copyright Copyright (c) 2011, Web Developer <Mohamed Mahdy>
 */
class users_model extends MY_Model
{

    protected $table = "users";
    protected $parentTable = false;
    protected $prefix = "user_";
    public $belongs_to = array('messages');
    public $has_many = array('messages');
    public $user_username;
    public $user_password;
    public $user_full_name;
    public $user_email;
    public $user_address;
    public $user_phone;
    public $user_state;
    public $user_created_date;
    public $user_group_id;
    private $static_id = '3'; // static id cannot be deleted

    function __construct(){
        parent::__construct();
    }

    private function fill_data()
    {
        if ($this->user_password) {
            $this->db->set("user_password", $this->user_password);
        }
        $this->db->set("user_full_name", $this->user_full_name);
        $this->db->set("user_address", $this->user_address);
        $this->db->set("user_phone", $this->user_phone);
        $this->db->set("user_group_id", $this->user_group_id);
    }

    function get_groups()
    {
        return $this->db->get('groups')->result_array();
    }

    /**
     * check if (email-username etc) exist or not
     * @param string $field search in this field
     * @param string $value the cecked value needed to check
     * @return true if it already exist otherwise return false
     */
    function already_exist($field, $value)
    {
        $data = $this->db->query("SELECT {$field} FROM {$this->table} WHERE {$field} = '{$value}'");
        if ($data->num_rows) {
            return true; // means this email address not available to used cause we found another person used it
        } else {
            return false;
        }
    }

    function get_next_ord()
    {
        $this->db->select_max($this->prefix . "ord", "next_ord");
        $max_ord = $this->db->get($this->table);
        $next_ord = $max_ord->row();

        return $next_ord->next_ord + 1;
    }

    function create_new()
    {
        $this->db->set("user_state", $this->user_state);
        $this->db->set("user_created_date", @date('Y-m-d'));
        $this->db->set("user_username", $this->user_username);
        $this->db->set("user_email", $this->user_email);
        $this->fill_data();
        $this->db->set($this->prefix . "ord", $this->get_next_ord());
        $this->db->insert($this->table);

        $this->db->set('uresum_user_id', mysql_insert_id());
        $this->db->insert('users_resume');

        return $this->db->elapsed_time();
    }

    /**
     * @param integer $id
     * @return timestamp with query elapsed time
     */
    function update_data($id)
    {
        $this->fill_data();
        $this->db->where($this->prefix . "id", $id);
        $this->db->update($this->table);

        return $this->db->elapsed_time();
    }

    /**
     *
     * @param integer $id
     * @param string $field_name the name of the field
     * @param string $value the modified value
     */
    public function update_one_field($id, $field_name, $value)
    {
        $this->db->set($field_name, $value);
        $this->db->where($this->prefix . "id", $id);
        $this->db->update($this->table);
    }

    /**
     * @param integer $id
     * @return timestamp with query elapsed time
     */
    function approve($id)
    {
        $this->db->set($this->prefix . "state", 1);
        $this->db->where($this->prefix . "id", $id);
        $this->db->update($this->table);

        return $this->db->elapsed_time();
    }

    /**
     * @param integer $id
     * @return timestamp with query elapsed time
     */
    function unapprove($id)
    {
        $this->db->set($this->prefix . "state", 0);
        $this->db->where($this->prefix . "id", $id);
        $this->db->update($this->table);

        return $this->db->elapsed_time();
    }

    /**
     *
     * @param Integer $id
     * @return Object
     */
    function find_by_id($id)
    {
        return $this->db->get_where($this->table, $this->prefix . "id = '" . $id . "'")->row();
    }

    /**
     * @param integer $limit
     * @return array
     */
    function find_all($limit)
    {
        $this->db->order_by($this->prefix . "ord", "asc");
        $this->db->limit($this->pagination->per_page, $limit);
        $this->db->select('users.*,groups.gr_name');
        $this->db->from('users');
        $this->db->join('groups', 'users.user_group_id = groups.gr_id', 'left');

        return $this->db->get()->result_array();
    }

    /**
     * @return integer (count of all the table rows)
     */
    function get_total_rows()
    {
        return $this->db->count_all_results($this->table);
    }

    /**
     * @param $id
     * @return integer (count rows with specific id)
     */
    function count_rows_where($id)
    {
        $this->db->where($this->prefix . "id", $id);

        return $this->db->get($this->table)->num_rows();
    }

    /**
     * @param integer $id
     * @return timestamp with query elapsed time
     */
    function delete($id)
    {
        if ($this->static_id != $id) {
            $this->db->delete($this->table, $this->prefix . "id = $id");

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $action
     * @param array $ids
     * @return void
     */
    function bulk_action_data($action, $ids)
    {
        switch ($action) {
            case "approved":
                for ($i = 0; $i < count($ids); $i++) {
                    $this->approve($ids[$i]);
                }
                break;

            case "unapproved":
                for ($i = 0; $i < count($ids); $i++) {
                    $this->unapprove($ids[$i]);
                }
                break;

            case "delete":
                for ($i = 0; $i < count($ids); $i++) {
                    $this->delete($ids[$i]);
                }
                break;
        }
    }

    /**
     * @param integer $id
     * @param string $fileName
     * @return void
     */
    function update_img($id, $fileName)
    {
        $this->db->where($this->prefix . "id", $id);
        $this->db->set($this->prefix . "img", $fileName);
        $this->db->update($this->table);
    }

    /**
     * @param string $direction
     * @param integer $current
     */
    function sort($direction, $current)
    {
        $this->db->where($this->prefix . "ord", $current);
        $current_ord = $this->db->get($this->table);
        $current_ord = $current_ord->row();
        switch ($direction) {
            case "up":
                $this->db->limit(1, 0);
                $this->db->order_by($this->prefix . "ord", "desc");
                $this->db->where($this->prefix . "ord <", $current);
                $new_ord = $this->db->get($this->table);
                $new_ord = $new_ord->row();
                break;
            default:
                $this->db->limit(1, 0);
                $this->db->order_by($this->prefix . "ord", "asc");
                $this->db->where($this->prefix . "ord >", $current);
                $new_ord = $this->db->get($this->table);
                $new_ord = $new_ord->row();
                // update current
                break;
        }

        if (is_object($new_ord) and is_object($current_ord)) {
            $this->db->set($this->prefix . "ord", $new_ord->user_ord);
            $this->db->where($this->prefix . "id", $current_ord->user_id);
            $this->db->update($this->table);

            $this->db->set($this->prefix . "ord", $current_ord->user_ord);
            $this->db->where($this->prefix . "id", $new_ord->user_id);
            $this->db->update($this->table);
        }
    }

    /** regenerate numericable from 0 . 1 .2 .3 ascending */
    function reset_table_ord()
    {
        $allRecords = $this->db->get($this->table)->result_array();

        $i = 0;
        foreach ($allRecords as $row) {
            $this->db->where($this->prefix . "id", $row[$this->prefix . 'id']);
            $this->db->set($this->prefix . "ord", $i);
            $this->db->update($this->table);
            $i++;
        }
    }

}