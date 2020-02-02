<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Option
{
    var $CI = null;
    var $enabled = false;
    var $data = array();
    var $config = array();

    function Option()
    {
        $this->CI =& get_instance();
        $this->CI->option = $this;

        $this->_is_enable();
        $this->_cache_all();
    }

    function _is_enable()
    {
        if ($this->CI->config->item('option_enable') === true) {
            $this->enabled = true;
        } else {
            $this->enabled = false;
        }
    }

    function _cache_all()
    {
        if ($this->enabled === true) {
            $this->CI->db->select($this->CI->config->item('option_attribute'));
            $this->CI->db->select($this->CI->config->item('option_value'));
            $this->CI->db->from($this->CI->config->item('option_table'));
            $query = $this->CI->db->get();

            foreach ($query->result_array() as $row) {
                $this->data[$row[$this->CI->config->item('option_attribute')]] = $row[$this->CI->config->item('option_value')];
            }
        }
    }

    /**
     *
     * @param string $name
     * @return string if username setted otherwise return false
     *
     */
    function get($name = '')
    {
        if (!isset($this->data[$name])) {
            return false;
        } else {
            return $this->data[$name];
        }
    }

    function update($name = '', $value = '')
    {
        $data = array();

        if ($this->enabled === true && trim($name) !== '') {
            $data[$this->CI->config->item('option_value')] = $value;

            if (!isset($this->data[$name])) {
                $data[$this->CI->config->item('option_attribute')] = $name;
                $this->CI->db->insert($this->CI->config->item('option_table'), $data);
            } else {
                $this->CI->db->where($this->CI->config->item('option_attribute'), $name);
                $this->CI->db->update($this->CI->config->item('option_table'), $data);
            }
            $this->data[$name] = $value;
        }
    }

    function delete($name = '')
    {
        if ($this->enabled === true && trim($name) !== '') {
            $this->CI->db->where($this->CI->config->item('option_attribute'), $name);
            $this->CI->db->delete($this->CI->config->item('option_table'));
            $this->data[$name] = false;
        }
    }
}

