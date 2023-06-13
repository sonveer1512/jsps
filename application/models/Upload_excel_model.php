<?php
if (!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!');

class Upload_excel_model extends CI_Model

{

    public function __construct()

    {

        parent::__construct();
    }


    public function list_common($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('flag', '0');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
  
  public function list_common_where($table,$where, $id)
    {
        $this->db->select('*');
        $this->db->from($table);
    	$this->db->where($where, $id);
        $this->db->where('flag', '0');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function list_common_where3($table, $where, $id)
    {
        $this->db->select('*');
        $this->db->where('LEFT(created_at,10)',$id);
        $this->db->where('flag', '0');
        $this->db->order_by('id', 'desc');
        $this->db->from($table);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
  
  public function list_common_where_edit($table, $where, $id)
    {
        $this->db->select('*');
        $this->db->where($where,$id);
        $this->db->where('flag', '0');
        $this->db->from($table);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function delete_manager($table, $id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
        return true;
    }

    public function check_policy($table,$where, $id)
    {
        $this->db->select('*');
        $this->db->where($where, $id);
        $this->db->where('flag', '0');
        $this->db->order_by('id', 'desc');
        $this->db->from($table);
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
}
